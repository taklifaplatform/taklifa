<?php

namespace Modules\Api\Builders;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Server;
use GoldSpecDigital\ObjectOrientedOAS\Objects\ServerVariable;
use Illuminate\Support\Arr;

class ServersBuilder
{
    /**
     * @return Server[]
     */
    public function build(array $config): array
    {
        return collect($config)
            ->map(static function (array $server): Server {
                $variables = collect(Arr::get($server, 'variables'))
                    ->map(static function (array $variable, string $key) {
                        $serverVariable = ServerVariable::create($key)
                            ->default(Arr::get($variable, 'default'))
                            ->description(Arr::get($variable, 'description'));
                        if (is_array(Arr::get($variable, 'enum'))) {
                            return $serverVariable->enum(...Arr::get($variable, 'enum'));
                        }

                        return $serverVariable;
                    })
                    ->toArray();

                return Server::create()
                    ->url(Arr::get($server, 'url'))
                    ->description(Arr::get($server, 'description'))
                    ->variables(...$variables);
            })
            ->toArray();
    }
}
