<?php

namespace Modules\Media\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;
use Modules\Media\Rules\GroupRules\MaxItemsRule;
use Modules\Media\Rules\GroupRules\MaxTotalSizeInKbRule;
use Modules\Media\Rules\GroupRules\MinItemsRule;
use Modules\Media\Rules\GroupRules\MinTotalSizeInKbRule;
use Modules\Media\Rules\ItemRules\AttributeRule;
use Modules\Media\Rules\ItemRules\DimensionsRule;
use Modules\Media\Rules\ItemRules\ExtensionRule;
use Modules\Media\Rules\ItemRules\HeightBetweenRule;
use Modules\Media\Rules\ItemRules\MaxItemSizeInKbRule;
use Modules\Media\Rules\ItemRules\MimeTypeRule;
use Modules\Media\Rules\ItemRules\MinItemSizeInKbRule;
use Modules\Media\Rules\ItemRules\WidthBetweenRule;

class UploadedMediaRules implements Rule
{
    public array $groupRules = [];

    public array $itemRules = [];

    public function minItems(int $numberOfItems): self
    {
        $this->groupRules[] = new MinItemsRule($numberOfItems);

        return $this;
    }

    public function maxItems(int $numberOfItems): self
    {
        $this->groupRules[] = new MaxItemsRule($numberOfItems);

        return $this;
    }

    public function maxTotalSizeInKb(int $maxTotalSizeInKb): self
    {
        $this->groupRules[] = new MaxTotalSizeInKbRule($maxTotalSizeInKb);

        return $this;
    }

    public function minTotalSizeInKb(int $minTotalSizeInKb): self
    {
        $this->groupRules[] = new MinTotalSizeInKbRule($minTotalSizeInKb);

        return $this;
    }

    public function maxItemSizeInKb(int $maxSizeInKb): self
    {
        $this->itemRules[] = new MaxItemSizeInKbRule($maxSizeInKb);

        return $this;
    }

    public function minSizeInKb(int $minSizeInKb): self
    {
        $this->itemRules[] = new MinItemSizeInKbRule($minSizeInKb);

        return $this;
    }

    /** @var string|array */
    public function mime($mimes): self
    {
        $this->itemRules[] = new MimeTypeRule($mimes);

        return $this;
    }

    /**
     * @var string|array
     */
    public function extension($extensions): self
    {
        $this->itemRules[] = new ExtensionRule($extensions);

        return $this;
    }

    public function itemName(array|string $rules): self
    {
        return $this->attribute('name', $rules);
    }

    public function attribute(string $attribute, array|string $rules): self
    {
        $this->itemRules[] = new AttributeRule($attribute, $rules);

        return $this;
    }

    public function customProperty(string $customPropertyName, $rules): self
    {
        $customPropertyName = 'custom_properties.'.$customPropertyName;

        $this->itemRules[] = new AttributeRule($customPropertyName, $rules);

        return $this;
    }

    public function dimensions(int $width, int $height): self
    {
        $this->itemRules[] = new DimensionsRule($width, $height);

        return $this;
    }

    public function width(int $width): self
    {
        $this->itemRules[] = new DimensionsRule($width, 0);

        return $this;
    }

    public function height(int $height): self
    {
        $this->itemRules[] = new DimensionsRule(0, $height);

        return $this;
    }

    public function widthBetween(int $minWidth, int $maxWidth): self
    {
        $this->itemRules[] = new WidthBetweenRule($minWidth, $maxWidth);

        return $this;
    }

    public function heightBetween(int $minHeight, int $maxHeight): self
    {
        $this->itemRules[] = new HeightBetweenRule($minHeight, $maxHeight);

        return $this;
    }

    public function customItemRules($rules): static
    {
        $this->itemRules = array_merge($this->itemRules, Arr::wrap($rules));

        return $this;
    }

    public function customGroupRules($rules): static
    {
        $this->groupRules = array_merge($this->groupRules, Arr::wrap($rules));

        return $this;
    }

    public function passes($attribute, $value): void
    {
        // this page has been left intentionally blank
    }

    public function message(): void
    {
        // this page has been left intentionally blank
    }
}
