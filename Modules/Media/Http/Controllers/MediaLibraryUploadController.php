<?php

namespace Modules\Media\Http\Controllers;

use Throwable;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Media\Entities\TemporaryUpload;
use Modules\Media\Http\Requests\UploadRequest;
use Illuminate\Validation\ValidationException;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Modules\Media\Http\Requests\DeleteTemporaryRequest;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class MediaLibraryUploadController extends Controller
{
    public function __invoke(UploadRequest $uploadRequest)
    {
        try {
            $temporaryUpload = TemporaryUpload::createForFile(
                $uploadRequest->file,
                session()->getId(),
                $uploadRequest->uuid,
                $uploadRequest->name ?? '',
            );
        } catch (Throwable $throwable) {
            TemporaryUpload::query()
                ->where('session_id', session()->getId())
                ->get()->each->delete();

            report($throwable);

            throw ValidationException::withMessages([
                'file' => 'Could not handle upload. Make sure you are uploading a valid file.',
                'error' => $throwable->getMessage(),
            ]);
        }

        /** @var \Spatie\MediaLibrary\MediaCollections\Models\Media $media */
        $media = $temporaryUpload->getFirstMedia();

        return response()->json($this->responseFields($media, $temporaryUpload));
    }

    /**
     * Delete a temporary media.
     */
    #[OpenApi\Operation('deleteMedia', tags: ['Media'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: DeleteTemporaryRequest::class)]
    public function deleteMedia(DeleteTemporaryRequest $uploadRequest)
    {
        $temporaryUpload = TemporaryUpload::findOrFail(
            $uploadRequest->uuid
        );

        /** @var \Spatie\MediaLibrary\MediaCollections\Models\Media $media */
        $media = $temporaryUpload->getFirstMedia();

        if ($media) {
            $media->delete();
        }
        $temporaryUpload->delete();

        return $this->success('Media deleted successfully');
    }

    protected function responseFields(Media $media, TemporaryUpload $temporaryUpload): array
    {
        return [
            'uuid' => $media->uuid,
            'name' => $media->name,
            'url' => $media->getUrl(),
            'preview_url' => config('media-library.generate_thumbnails_for_temporary_uploads')
                ? $temporaryUpload->getFirstMediaUrl('default', 'preview')
                : '',
            'size' => $media->size,
            'mime_type' => $media->mime_type,
            'extension' => $media->extension,
        ];
    }
}
