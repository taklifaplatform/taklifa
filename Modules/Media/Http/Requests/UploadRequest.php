<?php

namespace Modules\Media\Http\Requests;

use Modules\Core\Http\Requests\FormDataRequest;
use Modules\Media\Rules\FileExtensionRule;
use Modules\Media\Support\DefaultAllowedExtensions;

class UploadRequest extends FormDataRequest
{
    public function rules(): array
    {
        //
        $configuredAllowedExtensions = config('media-library.temporary_uploads_allowed_extensions');

        $allowedExtensions = $configuredAllowedExtensions ?? DefaultAllowedExtensions::all();

        $allowedExtensionsString = implode(',', $allowedExtensions);

        // 50 MB
        $maxUpload = 1024 * 50;

        return [
            'uuid' => sprintf('unique:%s%s', $this->getDatabaseConnection(), $this->getMediaTableName()),
            'name' => '',
            'custom_properties' => '',
            'file' => [
                'max:'.$maxUpload,
                'mimes:'.$allowedExtensionsString,
                new FileExtensionRule($allowedExtensions),
            ],
        ];
    }

    protected function getDatabaseConnection(): string
    {
        $mediaModelClass = config('media-library.media_model');

        /** @var \Spatie\MediaLibrary\MediaCollections\Models\Media $mediaModel */
        $mediaModel = new $mediaModelClass;

        if ($mediaModel->getConnectionName() === 'default') {
            return '';
        }

        return $mediaModel->getConnectionName().'.';
    }

    protected function getMediaTableName(): string
    {
        $mediaModelClass = config('media-library.media_model');

        /** @var \Spatie\MediaLibrary\MediaCollections\Models\Media $mediaModel */
        $mediaModel = new $mediaModelClass;

        return $mediaModel->getTable();
    }

    public function messages()
    {
        return [
            'uuid.unique' => trans('medialibrary-pro::upload_request.uuid_not_unique'),
        ];
    }
}
