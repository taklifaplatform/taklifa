<?php

namespace App\CoreLogic\Enums;

use App\CoreLogic\Interfaces\HasColor;

enum StatusEnum: string implements HasColor
{
    case Pending = 'pending';
    case Completed = 'completed';
    case Failed = 'failed';
    case Progress = 'progress';
    case Canceled = 'canceled';
    case Reversed = 'reversed';
    case Rejected = 'rejected';
    case Active = 'active';
    case InActive = 'Inactive';
    case Closed = 'closed';
    case Blocked = 'blocked';
    case Locked = 'locked';
    case Normal = 'normal';

    public function label($language = null): string
    {
        return match ($this) {
            self::Pending => trans(self::Pending->name, [], $language ?? 'en'),
            self::Completed => trans(self::Completed->name, [], $language ?? 'en'),
            self::Failed => trans(self::Failed->name, [], $language ?? 'en'),
            self::Progress => trans(self::Progress->name, [], $language ?? 'en'),
            self::Reversed => trans(self::Reversed->name, [], $language ?? 'en'),
            self::Canceled => trans(self::Canceled->name, [], $language ?? 'en'),
            self::Rejected => trans(self::Rejected->name, [], $language ?? 'en'),
            self::Closed => trans(self::Active->name, [], $language ?? 'en'),
            self::Blocked => trans(self::Blocked->name, [], $language ?? 'en'),
            self::Active => trans(self::Active->name, [], $language ?? 'en'),
            self::InActive => trans(self::InActive->name, [], $language ?? 'en'),
            self::Locked => trans(self::Locked->name, [], $language ?? 'en'),
            self::Normal => trans(self::Normal->name, [], $language ?? 'en'),
            default => trans(self::Pending->name, [], $language ?? 'en')
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Pending => ColorEnum::Gray->value,
            self::Completed => ColorEnum::Green->value,
            self::Failed => ColorEnum::Red->value,
            self::Progress => ColorEnum::Gray->value,
            self::Reversed => ColorEnum::Red->value,
            self::Canceled => ColorEnum::Red->value,
            self::Rejected => ColorEnum::Red->value,
            self::Active => ColorEnum::Green->value,
            self::InActive => ColorEnum::Red->value,
            self::Closed => ColorEnum::Red->value,
            self::Blocked => ColorEnum::Yellow->value,
            self::Locked => ColorEnum::Red->value,
            self::Normal => ColorEnum::Gray->value,
            default => ColorEnum::Gray->value
        };
    }

    public static function forUser(): array
    {
        return [
            self::Pending,
            self::Active,
            self::Blocked,
            self::Closed,
        ];
    }

    /**
     * @return mixed[]
     */
    public static function forUserToArray(): array
    {
        $statuses = [];

        foreach (self::forUser() as $status) {
            $statuses[$status->value] = $status->name;
        }

        return $statuses;
    }

    public static function forAccount(): array
    {
        return [
            self::Pending,
            self::Active,
            self::Blocked,
            self::Closed,
            self::Locked,
        ];
    }

    /**
     * @return mixed[]
     */
    public static function forAccountToArray(): array
    {
        $statuses = [];

        foreach (self::forAccount() as $status) {
            $statuses[$status->value] = $status->name;
        }

        return $statuses;
    }

    public static function forBoolean(): array
    {
        return [
            self::Active,
            self::InActive,
        ];
    }

    /**
     * @return mixed[]
     */
    public static function forBooleanToArray(): array
    {
        $statuses = [];

        foreach (self::forBoolean() as $status) {
            $statuses[$status->value] = $status->name;
        }

        return $statuses;
    }

    public static function toArray(): array
    {
        $statuses = [];

        foreach (self::cases() as $status) {
            $statuses[$status->value] = $status->name;
        }

        return $statuses;
    }
}
