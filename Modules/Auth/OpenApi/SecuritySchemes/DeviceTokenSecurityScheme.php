<?php

namespace Modules\Auth\OpenApi\SecuritySchemes;

use GoldSpecDigital\ObjectOrientedOAS\Objects\SecurityScheme;
use Modules\Api\Factories\SecuritySchemeFactory;

class DeviceTokenSecurityScheme extends SecuritySchemeFactory
{
    public function build(): SecurityScheme
    {
        return SecurityScheme::create('DeviceTokenSecurityScheme')
            ->type(SecurityScheme::TYPE_API_KEY)
            ->in(SecurityScheme::IN_HEADER)
            ->name('x-device-uuid');
    }
}
