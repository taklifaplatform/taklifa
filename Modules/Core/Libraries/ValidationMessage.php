<?php

namespace Modules\Core\Libraries;

class ValidationMessage
{
    /**
     * The key of the validated parameter
     *
     * @var string
     */
    public $key;

    /**
     * The validation message to return for the parameter
     *
     * @var string
     */
    public $message;

    /**
     * Create a new validation message object
     */
    public function __construct(string $key, ?string $message = null)
    {
        $this->key = $key;
        $this->message = $message ?: __('validation.invalid', [
            'attribute' => str_replace(
                '_',
                ' ',
                strtolower($key)
            ),
        ]);
    }

    /**
     * Convert the object into an array
     */
    public function toArray(): array
    {
        return [
            'key' => $this->key,
            'message' => $this->message,
        ];
    }
}
