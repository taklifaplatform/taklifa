<?php

use Illuminate\Support\Facades\Route;
use Modules\Chat\Http\Controllers\AttachmentController;
use Modules\Chat\Http\Controllers\ChannelController;
use Modules\Chat\Http\Controllers\ChannelEventController;
use Modules\Chat\Http\Controllers\ChatAppController;
use Modules\Chat\Http\Controllers\ExploreUserController;
use Modules\Chat\Http\Controllers\MessageController;
use Modules\Chat\Http\Controllers\ModerationController;
use Modules\Chat\Http\Controllers\ReactionController;
use Modules\Chat\Http\Controllers\ReplyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->prefix('chat')->group(function () {
    Route::get('app', [ChatAppController::class, 'chatApp']);

    Route::post('channels', [ChannelController::class, 'channels']);
    Route::post('channels/start-chat/{model}', [ChannelController::class, 'startChat']);
    Route::post('channels/messaging/{channel}/query', [ChannelController::class, 'channelMessages']);

    Route::post('channels/messaging/{channel}/message', [MessageController::class, 'createMessage']);
    Route::put('messages/{messageId}', [MessageController::class, 'updateMessage']);
    Route::delete('messages/{messageId}', [MessageController::class, 'deleteMessage']);

    /**
     * Message Reactions
     */
    Route::post('messages/{messageId}/reaction', [ReactionController::class, 'createReaction']);

    /**
     * Message Replies
     */
    Route::get('messages/{messageId}/replies', [ReplyController::class, 'listReplies']);

    /**
     * Attachments
     */
    Route::post('channels/messaging/{channel}/image', [AttachmentController::class, 'uploadImage']);

    /**
     * Channel Moderation
     */
    Route::post('channels/messaging/{channel}', [ModerationController::class, 'moderateChannel']);
    Route::post('moderation/mute/channel', [ModerationController::class, 'muteChannel']);
    Route::post('moderation/unmute/channel', [ModerationController::class, 'unmuteChannel']);

    /**
     * Explore users
     */
    Route::get('users', [ExploreUserController::class, 'listUsers']);

    /**
     * Channel Events
     */
    Route::post('channels/messaging/{channel}/event', [ChannelEventController::class, 'sendEvent']);

});
