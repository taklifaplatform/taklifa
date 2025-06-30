<?php

namespace Modules\Media\Http\Controllers;

use Aws\S3\S3Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Modules\Media\Entities\TemporaryUpload;

class S3UploadUrlController
{
    /**
     * Create a new signed URL for S3 upload.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $this->ensureEnvironmentVariablesAreAvailable();

        $client = $this->storageClient();
        $bucket = $_ENV['AWS_BUCKET'];
        $key = $request->input('filename');

        $signedRequest = $client->createPresignedRequest(
            $this->createCommand($request, $client, $bucket, $key),
            sprintf('+%s minutes', 5)
        );

        $uri = $signedRequest->getUri();

        return response()->json([
            'url' => $uri->getScheme() . '://' . $uri->getAuthority() . $uri->getPath() . '?' . $uri->getQuery(),
            'key' => $key,
            'headers' => $this->headers($request, $signedRequest),
        ]);
    }

    public function convertToTemporaryUpload(Request $request)
    {
        $temporaryUpload = TemporaryUpload::createForFileFromS3Key(
            $request->input('key'),
            session()->getId(),
            $request->input('uuid'),
            $request->input('filename'),
        );
        $media = $temporaryUpload->getFirstMedia();


        return response()->json([
            'uuid' => $media->uuid,
            'name' => $media->name,
            'url' => $media->getUrl(),
            'preview_url' => config('media-library.generate_thumbnails_for_temporary_uploads')
                ? $temporaryUpload->getFirstMediaUrl('default', 'preview')
                : '',
            'size' => $media->size,
            'mime_type' => $media->mime_type,
            'extension' => $media->extension,
        ]);
    }

    /**
     * Create a command for the PUT operation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Aws\S3\S3Client  $client
     * @param  string  $bucket
     * @param  string  $key
     * @return \Aws\Command
     */
    protected function createCommand(Request $request, S3Client $client, $bucket, $key)
    {
        return $client->getCommand('putObject', array_filter([
            'Bucket' => $bucket,
            'Key' => $key,
            'ACL' => 'private',
            'ContentType' => $request->input('content_type', 'application/octet-stream'),
        ]));
    }

    /**
     * Get the headers that should be used when making the signed request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \GuzzleHttp\Psr7\Request  $signedRequest
     * @return array
     */
    protected function headers(Request $request, $signedRequest)
    {
        return array_merge(
            $signedRequest->getHeaders(),
            [
                'Content-Type' => $request->input('content_type', 'application/octet-stream'),
            ]
        );
    }

    /**
     * Ensure the required environment variables are available.
     *
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    protected function ensureEnvironmentVariablesAreAvailable()
    {
        $missing = array_diff_key(array_flip([
            'AWS_BUCKET',
            'AWS_DEFAULT_REGION',
            'AWS_ACCESS_KEY_ID',
            'AWS_SECRET_ACCESS_KEY',
        ]), $_ENV);

        if (empty($missing)) {
            return;
        }

        throw new InvalidArgumentException(
            'Unable to issue signed URL. Missing environment variables: ' . implode(', ', array_keys($missing))
        );
    }

    /**
     * Get the S3 storage client instance.
     *
     * @return \Aws\S3\S3Client
     */
    protected function storageClient()
    {
        $config = [
            'region' => config('filesystems.disks.s3.region', $_ENV['AWS_DEFAULT_REGION']),
            'version' => 'latest',
            'signature_version' => 'v4',
            'use_path_style_endpoint' => config('filesystems.disks.s3.use_path_style_endpoint', false),
        ];

        if (! isset($_ENV['AWS_LAMBDA_FUNCTION_VERSION'])) {
            $config['credentials'] = array_filter([
                'key' => $_ENV['AWS_ACCESS_KEY_ID'] ?? null,
                'secret' => $_ENV['AWS_SECRET_ACCESS_KEY'] ?? null,
                'token' => $_ENV['AWS_SESSION_TOKEN'] ?? null,
            ]);

            if (array_key_exists('AWS_URL', $_ENV) && ! is_null($_ENV['AWS_URL'])) {
                $config['url'] = $_ENV['AWS_URL'];
                $config['endpoint'] = $_ENV['AWS_URL'];
            }
        }

        return new S3Client($config);
    }
}
