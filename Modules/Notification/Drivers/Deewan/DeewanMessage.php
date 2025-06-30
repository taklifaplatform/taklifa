<?php

namespace Modules\Notification\Drivers\Deewan;

class DeewanMessage
{
    /**
     * The message text.
     *
     * @var string
     */
    protected $text;

    public static function create($text = ''): DeewanMessage
    {
        return new static($text);
    }

    /**
     * DeewanMessage constructor.
     */
    public function __construct(string $text = '')
    {
        $this->text = $text;
    }

    /**
     * Set the message title.
     *
     * @return $this
     */
    public function text(string $value): DeewanMessage
    {
        $this->text = $value;

        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Get an array representation of the message.
     */
    public function toArray(): array
    {
        return [
            'text' => $this->text,
        ];
    }
}
