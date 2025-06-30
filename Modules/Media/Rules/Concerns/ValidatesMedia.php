<?php

namespace Modules\Media\Rules\Concerns;

use Modules\Media\Rules\GroupRules\MinItemsRule;
use Modules\Media\Rules\GroupRules\MinTotalSizeInKbRule;
use Modules\Media\Rules\ItemRules\AttributeRule;
use Modules\Media\Rules\UploadedMediaRules;

/** @var $this \Illuminate\Foundation\Http\FormRequest */
trait ValidatesMedia
{
    protected function validateSingleMedia(): UploadedMediaRules
    {
        return (new UploadedMediaRules())->maxItems(1);
    }

    protected function validateMultipleMedia(): UploadedMediaRules
    {
        return new UploadedMediaRules();
    }

    public function validateResolved(): void
    {
        $this->prepareForValidation();

        if (! $this->passesAuthorization()) {
            $this->failedAuthorization();
        }

        $validator = $this->getValidatorInstance();

        $rules = $validator->getRules();

        $this->rewrittenRules = $this->moveItemRulesToMediaItems($rules);

        $validator->setRules($this->rewrittenRules);

        if ($validator->fails()) {
            $this->failedValidation($validator);
        }

        $this->passedValidation();
    }

    public function getRewrittenRules(): array
    {
        return $this->rewrittenRules ?? [];
    }

    public function moveItemRulesToMediaItems(array $rules): array
    {
        [$itemRules, $remainingRules] = $this->filterItemRules($rules);

        return array_merge($remainingRules, $itemRules);
    }

    public function filterItemRules(array $allAttributeRules): array
    {
        $itemRules = [];
        $remainingRules = [];

        foreach ($allAttributeRules as $attribute => $attributeRules) {
            $remainingRules[$attribute] = [];

            if (is_string($attributeRules)) {
                $remainingRules[$attribute] = $allAttributeRules;

                continue;
            }

            foreach ($attributeRules as $attributeRule) {
                if (is_string($attributeRule)) {
                    $remainingRules[$attribute][] = $attributeRule;
                } elseif ($attributeRule instanceof UploadedMediaRules) {
                    foreach ($attributeRule->groupRules as $groupRule) {
                        $remainingRules[$attribute][] = $groupRule;
                    }

                    foreach ($attributeRule->itemRules as $itemRule) {
                        if ($itemRule instanceof AttributeRule) {
                            $ruleAttribute = $itemRule->attribute;

                            $itemRules[sprintf('%s.*.%s', $attribute, $ruleAttribute)][] = $itemRule;
                        } else {
                            $itemRules[$attribute.'.*'][] = $itemRule;
                        }
                    }
                } else {
                    $remainingRules[$attribute][] = $attributeRule;
                }

                $minimumRuleUsed = collect($remainingRules[$attribute])->contains(static function ($attributeRule): bool {
                    if (is_string($attributeRule)) {
                        return false;
                    }

                    if ($attributeRule instanceof MinItemsRule && $attributeRule->getMinItemCount()) {
                        return true;
                    }

                    if ($attributeRule instanceof MinTotalSizeInKbRule && $attributeRule->getMinTotalSizeInKb()) {
                        return true;
                    }

                    return false;
                });

                if ($minimumRuleUsed) {
                    $remainingRules[$attribute][] = 'required';
                }
            }
        }

        return [$itemRules, $remainingRules];
    }
}
