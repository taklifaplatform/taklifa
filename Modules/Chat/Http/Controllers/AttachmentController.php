<?php

namespace Modules\Chat\Http\Controllers;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Chat\Entities\ChatChannel;
use Modules\Media\Entities\TemporaryUpload;
use Modules\Chat\Http\Requests\UploadAttachmentRequest;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class AttachmentController extends Controller
{
    /**
     * Upload an image to the chat channel.
     */
    #[OpenApi\Operation('uploadImage', tags: ['Chat'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UploadAttachmentRequest::class)]
    public function uploadImage(UploadAttachmentRequest $request, ChatChannel $channel)
    {
        if (! $channel->members()->where('user_id', $request->user()->id)->exists()) {
            abort(403, 'You are not a member of this channel');
        }

        $uuid = Str::uuid();

        $temporaryUpload = TemporaryUpload::createForFile(
            $request->file,
            session()->getId(),
            $uuid,
            $request->name ?? '',
        );

        $media = $temporaryUpload->getFirstMedia();

        return response()->json([
            'file' => $media->getUrl().'?uuid='.$uuid,
        ]);
    }
}
