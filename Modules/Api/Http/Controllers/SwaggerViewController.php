<?php

namespace Modules\Api\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\ItemNotFoundException;

class SwaggerViewController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            $file = collect(config('swagger-ui.files'))->filter(function ($values) use ($request) {
                return ltrim($values['path'], '/') === $request->path();
            })->firstOrFail();
        } catch (ItemNotFoundException) {
            return abort(404);
        }

        return view('api::index', ['data' => collect($file)]);
    }
}
