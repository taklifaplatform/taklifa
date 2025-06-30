<?php

namespace Modules\Api\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Api\Generator;

class OpenApiController extends Controller
{
    public function __invoke(Generator $generator)
    {
        return response()->json(
            $generator->generate()
        );
    }
}
