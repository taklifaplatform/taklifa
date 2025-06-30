<?php

namespace Modules\Media\Rules\ItemRules;

class WidthBetweenRule extends MediaItemRule
{
    public function __construct(
        protected int $minWidth = 0,
        protected int $maxWidth = 0
    ) {
    }

    public function validateMediaItem(): bool
    {
        if (($media = $this->getTemporaryUploadMedia()) === null) {
            return true;
        }

        $size = getimagesize($media->getPath());
        $actualWidth = $size[0];

        return $actualWidth >= $this->minWidth && $actualWidth <= $this->maxWidth;
    }

    public function message()
    {
        return __('media-library::validation.width_not_between', [
            'min' => $this->minWidth,
            'max' => $this->maxWidth,
        ]);
    }
}
