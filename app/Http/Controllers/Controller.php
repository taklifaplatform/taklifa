<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Routing\ResponseFactory;
use Laravel\Sanctum\NewAccessToken;
use Modules\Core\Libraries\ValidationMessage;
use Modules\Core\Support\AttemptsRateLimiter;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Controller extends BaseController
{
    use AttemptsRateLimiter;
    use AuthorizesRequests;
    use ValidatesRequests;

    /**
     * Login and generate a new access token for the
     * given user
     *
     * @return NewAccessToken
     */
    public function login(User $user)
    {
        // TODO: log the login activity if needed

        return $user->createToken(request()->ip());
    }

    /**
     * Return success response to user
     *
     * @param  string|null  $message
     * @param  array|null  $data
     * @return ResponseFactory|Response
     */
    protected function success($message = null, $data = null)
    {
        $response = [
            'message' => $message ?: __('general.success'),
        ];

        if ($data) {
            $response['data'] = $data;
        }

        return response($response, 200);
    }

    /**
     * Return data response
     *
     * @param  array  $data
     * @return ResponseFactory|Response
     */
    protected function data($data)
    {
        return response([
            'message' => __('general.success'),
            'data' => $data,
        ], 200);
    }

    /**
     * Return error response to user
     *
     * @param  string|null  $message
     * @param  array|null  $data
     * @param  int  $status
     * @return ResponseFactory|Response
     */
    protected function error($message = null, $data = null, $status = 422)
    {
        $response = [
            'message' => $message ?: __('general.error'),
            'errors' => [
                'message' => $message ?: __('general.error'),
            ],
        ];

        if ($data) {
            $response['data'] = $data;
        }

        return response($response, $status);
    }

    /**
     * Return validation error response
     *
     * @return ResponseFactory|Response
     */
    protected function invalid(ValidationMessage $validationMessage)
    {
        $errors = [];
        $errors[$validationMessage->key] = [$validationMessage->message];

        $response = [
            'message' => __('Invalid data'),
            'errors' => $errors,
        ];

        return response($response, 422);
    }

    public function addSingleMedia($model, $file = null, $collection = null, $shouldRemove = false): void
    {
        if (! $file && $shouldRemove) {
            $model->clearMediaCollection($collection);

            return;
        }

        if ($file && array_key_exists('uuid', $file)) {
            $temporaryUpload = Media::where('uuid', $file['uuid'])->first();
            if ($temporaryUpload) {
                $model->clearMediaCollection($collection);
                $temporaryUpload->move($model, $collection);
            }
        }
    }

    public function addMultipleMedia($model, $files = [], $collection = null, $shouldRemove = false): void
    {
        if (! $files) {
            return;
        }

        if (! count($files) && $shouldRemove) {
            $model->clearMediaCollection($collection);

            return;
        }

        $keepFiles = collect($files)
            ->filter(static fn ($file): bool => is_array($file) && array_key_exists('id', $file) && (bool) $file['id'])
            ->map(static fn ($file) => $file['id'])
            ->toArray();
        $model->media()->where('collection_name', $collection)->whereNotIn('id', $keepFiles)->delete();

        foreach ($files as $file) {
            if (array_key_exists('uuid', $file)) {
                $temporaryUpload = Media::where('uuid', $file['uuid'])->first();
                if (array_key_exists('custom_properties', $file) && $file['custom_properties']) {
                    $temporaryUpload->custom_properties = $file['custom_properties'];
                    $temporaryUpload->save();
                }
                if ($temporaryUpload) {
                    $temporaryUpload->move($model, $collection);
                }
            }
        }
    }
}
