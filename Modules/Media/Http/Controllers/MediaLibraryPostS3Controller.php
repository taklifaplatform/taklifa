<?php

namespace Modules\Media\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Modules\Media\Entities\TemporaryUpload;
use Spatie\MediaLibrary\Conversions\FileManipulator;
use Spatie\MediaLibrary\Support\PathGenerator\PathGeneratorFactory;
use Modules\Media\Http\Requests\CreateTemporaryUploadFromDirectS3UploadRequest;

class MediaLibraryPostS3Controller
{
    public function __invoke(
        CreateTemporaryUploadFromDirectS3UploadRequest $createTemporaryUploadFromDirectS3UploadRequest,
        FileManipulator $fileManipulator
    ) {
        $diskName = config('media-library.disk_name');

        $temporaryUpload = TemporaryUpload::create([
            'session_id' => session()->getId(),
        ]);

        /** @var \Spatie\MediaLibrary\MediaCollections\Models\Media $media */
        $media = $temporaryUpload->media()->create([
            'name' => $createTemporaryUploadFromDirectS3UploadRequest->name,
            'uuid' => $createTemporaryUploadFromDirectS3UploadRequest->uuid,
            'collection_name' => 'default',
            'file_name' => $createTemporaryUploadFromDirectS3UploadRequest->name,
            'mime_type' => $createTemporaryUploadFromDirectS3UploadRequest->content_type,
            'disk' => $diskName,
            'conversions_disk' => $diskName,
            'manipulations' => [],
            'custom_properties' => [],
            'responsive_images' => [],
            'generated_conversions' => [],
            'size' => $createTemporaryUploadFromDirectS3UploadRequest->size,
        ]);

        /** @var \Spatie\MediaLibrary\Support\PathGenerator\PathGenerator $pathGenerator */
        $pathGenerator = PathGeneratorFactory::create($media);

        Storage::disk($diskName)->copy(
            $createTemporaryUploadFromDirectS3UploadRequest->key,
            $pathGenerator->getPath($media).$createTemporaryUploadFromDirectS3UploadRequest->name,
        );

        $fileManipulator->createDerivedFiles($media);

        return response()->json([
            'name' => $media->name,
            'file_name' => $media->file_name,
            'uuid' => $media->uuid,
            'preview_url' => $media->hasGeneratedConversion('preview') ? $media->getUrl('preview') : '',
            'original_url' => $media->getUrl(),
            'order' => $media->order_column,
            'custom_properties' => $media->custom_properties,
            'extension' => $media->extension,
            'size' => $media->size,
        ]);
    }
}
