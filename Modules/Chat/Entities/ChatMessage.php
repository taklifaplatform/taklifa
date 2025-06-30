<?php

namespace Modules\Chat\Entities;

use App\Models\User;
use Spatie\MediaLibrary\HasMedia;
use Modules\Core\Entities\BaseModel;
use Spatie\MediaLibrary\InteractsWithMedia;

class ChatMessage extends BaseModel implements HasMedia
{
    use InteractsWithMedia;

    const EAGER_LOADS_WITH_COUNT = [
        'replies',
    ];

    const EAGER_LOADS_WITH = [
        'user',
        'user',
        'reactions',
        'reactions.user',
        'threadParticipants',
        'quotedMessage',
        'mentionedUsers',
        'latestReactions',
        'latestReactions.user',
        'ownReactions',
        'ownReactions.user',
        'quotedMessage',
        'attachments',
    ];

    protected $fillable = [
        'id',
        'channel_id',
        'user_id',
        'text',
        'type',
        'parent_id',
        'quoted_message_id',
        'show_in_channel',
    ];

    protected $casts = [
        'reaction_counts' => 'array',
        'reaction_scores' => 'array',
    ];

    public function channel()
    {
        return $this->belongsTo(ChatChannel::class, 'channel_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reactions()
    {
        return $this->hasMany(ChatMessageReaction::class, 'message_id');
    }

    public function latestReactions()
    {
        return $this->reactions()->latest();
    }

    public function ownReactions()
    {
        return $this->reactions()->where('user_id', auth()->id())->latest();
    }

    public function mentionedUsers()
    {
        return $this->belongsToMany(User::class, 'chat_message_mentioned_users', 'message_id', 'user_id');
    }

    public function quotedMessage()
    {
        return $this->belongsTo(ChatMessage::class, 'quoted_message_id');
    }

    public function replies()
    {
        return $this->hasMany(ChatMessage::class, 'parent_id');
    }

    public function threadParticipants()
    {
        return $this->hasManyThrough(User::class, ChatMessage::class, 'parent_id', 'id', 'id', 'user_id');
    }

    public function parent()
    {
        return $this->belongsTo(ChatMessage::class, 'parent_id');
    }

    public function attachments()
    {
        return $this->media()->where('collection_name', 'attachments');
    }

    /**
     * Extracts UUIDs from a given string.
     *
     * @param  string  $string  The string to extract UUIDs from.
     * @return array An array of extracted UUIDs.
     */
    private static function extractUuids($string)
    {
        preg_match('/\b([a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12})\b(.*)/', $string, $matches);
        if (! empty($matches)) {
            $uuid = $matches[1];
            $rest = isset($matches[2]) ? ltrim($matches[2], '-') : ''; // Remove starting "-" from the rest

            return [$uuid, $rest];
        } else {
            return [null, $string]; // Return input string if no UUID found
        }

        // // Regular expression pattern to match UUIDs
        // $pattern = '/[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}/i';

        // // need to extract the first uuid and the second is a free text

        // // Match UUIDs in the string
        // preg_match_all($pattern, $string, $matches);

        // // Extracted UUIDs will be in $matches[0]
        // return $matches[0];
    }

    /**
     * Extracts the message UUIDs from a given string.
     *
     * @param  string  $string  The string to extract UUIDs from.
     * @return string The extracted UUIDs.
     */
    public static function extractMessageUuids($string)
    {
        return self::extractUuids($string)[1];
    }
}
