<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Nwidart\Modules\Facades\Module;

/**
 * Modules\Core\Entities\Modules
 *
 * @property int $id
 * @property string|null $identifier
 * @property string|null $name
 * @property int|null $priority
 * @property string|null $version
 * @property string|null $description
 * @property string|null $path
 * @property string|null $enabled
 * @property string|null $status
 * @property string|null $can_disabled
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Modules newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Modules newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Modules query()
 * @method static \Illuminate\Database\Eloquent\Builder|Modules whereCanDisabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modules whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modules whereEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modules whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modules whereIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modules whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modules wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modules wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modules whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modules whereVersion($value)
 *
 * @mixin \Eloquent
 */
class Modules extends Model
{
    use \Sushi\Sushi;

    /**
     * @return array<mixed, array<'can_disabled'|'description'|'enabled'|'id'|'identifier'|'name'|'path'|'priority'|'status'|'version', mixed>>
     */
    public function getRows(): array
    {
        $modules = [];

        $index = 1;
        foreach (Module::all() as $module) {
            $modules[] = [
                'id' => $index,
                'identifier' => $module->getLowerName(),
                'name' => $module->getName(),
                'priority' => $module->get('priority'),
                'version' => $module->get('version', '1.0.0'),
                'description' => $module->get('description', $module->getName().' Description'),
                'path' => $module->getPath(),
                'enabled' => $module->isEnabled(),
                'status' => $module->isEnabled() ? 'enabled' : 'disabled',

                'can_disabled' => ! in_array($module->getLowerName(), ['core', 'admin', 'api']),
            ];

            $index++;
        }

        // modules sort by priority
        usort($modules, static function (array $a, array $b): int {
            return $a['priority'] <=> $b['priority'];
        });

        return $modules;
    }

    protected function sushiShouldCache(): bool
    {
        return false;
    }
}
