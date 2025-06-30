<?php

namespace Modules\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Modules\Api\Generator;

class ApiDocsController extends Controller
{
    public function __invoke(Generator $generator)
    {
        $openApi = $generator->generate();
        File::put(public_path('api-schema.json'), $openApi->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return response()->json(
            $openApi
        );
    }
}
