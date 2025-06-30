<?php

namespace Modules\Chat;

use App\Models\User;
use Modules\Chat\Entities\ChatChannel;
use Modules\Chat\Entities\ChatMessage;
use Modules\Chat\Events\ChatMessageCreatedEvent;
use Modules\Chat\Events\ChatMessageUpdatedEvent;
use Modules\Company\Entities\Company;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Chat
{
    public $authUser;

    public static function startChat($users): Chat
    {
        $userIds = $users->pluck('id');
        $channel = ChatChannel::query()
            ->whereHas(
                'members',
                fn($query) => $query->distinct()->whereIn('user_id', $userIds),
                '=',
                $userIds->count()
            )
            ->first();

        if ($channel) {
            return Chat::channel($channel);
        }

        return Chat::createChat($users);
    }

    public static function startCompanyChat(User $creator, Company $company): Chat
    {
        $channel = ChatChannel::query()
            ->where(
                'creator_id',
                $creator->id
            )
            ->where(
                'company_id',
                $company->id
            )
            ->first();

        if ($channel) {
            return Chat::channel($channel);
        }

        return Chat::createCompanyChat(creator: $creator, company: $company);
    }

    public static function createChat($users): Chat
    {
        $channel = ChatChannel::create([
            'creator_id' => $users[0]->id,
            'is_public' => false,
        ]);

        foreach ($users as $user) {
            $channel->members()->create([
                'user_id' => $user->id,
            ]);
        }

        return Chat::channel($channel);
    }

    public static function createCompanyChat(User $creator, Company $company): Chat
    {
        $channel = ChatChannel::create([
            'creator_id' => $creator->id,
            'company_id' => $company->id,
            'is_public' => false,
        ]);
        $channel->members()->create([
            'user_id' => $creator->id,
        ]);

        foreach ($company->managers as $manager) {
            $channel->members()->create([
                'user_id' => $manager->id,
            ]);
        }

        return Chat::channel($channel);
    }

    public static function channel(ChatChannel $chatChannel)
    {
        return new Chat($chatChannel);
    }

    public function __construct(
        public ChatChannel $channel
    ) {}

    public function forUser(User $user): Chat
    {
        $this->authUser = $user;

        return $this;
    }

    public function sendMessage($messageData): ChatMessage
    {
        if (!$this->channel->members()->where('user_id', $this->authUser->id)->exists()) {
            abort(403, 'You are not a member of this channel');
        }

        $message = $this->channel->messages()->create([
            'id' => ChatMessage::extractMessageUuids($messageData['id']),
            'user_id' => $this->authUser->id,
        ]);

        // broadcast the message

        $chatMessage = $this->updateOrCreateMessage($message, $messageData);

        event(
            new ChatMessageCreatedEvent($chatMessage->id)
        );

        if ($chatMessage->parent_id) {
            event(
                new ChatMessageUpdatedEvent($chatMessage->parent_id)
            );
        }

        return $chatMessage;
    }

    public function updateMessage(ChatMessage $message, $messageData): ChatMessage
    {
        if ($message->user_id !== $this->authUser->id) {
            abort(403, 'You are not the owner of this message');
        }

        $chatMessage = $this->updateOrCreateMessage($message, $messageData);

        event(
            new ChatMessageUpdatedEvent($chatMessage->id)
        );

        if ($chatMessage->parent_id) {
            event(
                new ChatMessageUpdatedEvent($chatMessage->parent_id)
            );
        }

        return $chatMessage;
    }

    public function deleteMessage(ChatMessage $message): ChatMessage
    {
        if ($message->user_id !== $this->authUser->id) {
            abort(403, 'You are not the owner of this message');
        }

        $message->type = 'deleted';
        $message->save();

        event(
            new ChatMessageUpdatedEvent($message->id)
        );

        return $message;
    }

    /**
     * Update or create a chat message with the given data.
     *
     * @param  ChatMessage  $chatMessage  The chat message instance.
     * @param  array  $newMessageData  The new message data.
     * @return ChatMessage The transformed chat message.
     */
    private function updateOrCreateMessage(ChatMessage $chatMessage, $newMessageData)
    {
        if (isset($newMessageData['text'])) {
            $chatMessage->text = $newMessageData['text'];
        }

        if (isset($newMessageData['show_in_channel'])) {
            $chatMessage->show_in_channel = $newMessageData['show_in_channel'];
        }

        if (isset($newMessageData['parent_id'])) {
            $chatMessage->parent_id = ChatMessage::extractMessageUuids($newMessageData['parent_id']);
            $chatMessage->type = 'reply';
        }

        if (isset($newMessageData['quoted_message_id'])) {
            $chatMessage->quoted_message_id = ChatMessage::extractMessageUuids($newMessageData['quoted_message_id']);
        }

        if (isset($newMessageData['mentioned_users'])) {
            $chatMessage->mentionedUsers()->sync($newMessageData['mentioned_users']);
        }

        // attachments
        if (isset($newMessageData['attachments'])) {
            $files = [];
            foreach ($newMessageData['attachments'] as $attachment) {
                $imageUrl = $attachment['image_url'];
                $uuid = explode('=', explode('?', $imageUrl)[1])[1];
                $files[] = [
                    'uuid' => $uuid,
                    'custom_properties' => $attachment,
                ];
            }
            $this->addMultipleMedia($chatMessage, $files, 'attachments');
        }

        $chatMessage->save();

        return $chatMessage;
    }






    public function addMultipleMedia($model, $files = [], $collection = null, $shouldRemove = false): void
    {
        if (!$files) {
            return;
        }

        if (!count($files) && $shouldRemove) {
            $model->clearMediaCollection($collection);

            return;
        }

        $keepFiles = collect($files)
            ->filter(static fn($file): bool => is_array($file) && array_key_exists('id', $file) && (bool) $file['id'])
            ->map(static fn($file) => $file['id'])
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
