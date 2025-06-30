<?php

namespace Modules\Chat\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;

#[OpenApi\PathItem]
class ChatAppController extends Controller
{
    /**
     * Chat App Configuration.
     */
    #[OpenApi\Operation('chatApp', tags: ['Chat'])]
    public function chatApp()
    {
        return response()->json([
            'app' => [
                'name' => config('app.name'),
                'file_upload_config' => [
                    'allowed_file_extensions' => [],
                    'blocked_file_extensions' => [],
                    'allowed_mime_types' => [],
                    'blocked_mime_types' => [],
                ],
                'image_upload_config' => [
                    'allowed_file_extensions' => [],
                    'blocked_file_extensions' => [],
                    'allowed_mime_types' => [],
                    'blocked_mime_types' => [],
                ],
                'video_provider' => '',
                'auto_translation_enabled' => false,
                'async_url_enrich_enabled' => false,
            ],
        ]);
    }
}
