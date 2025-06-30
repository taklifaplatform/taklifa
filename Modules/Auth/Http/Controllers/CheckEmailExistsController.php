<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Auth\Http\Requests\CheckEmailExistRequest;

#[OpenApi\PathItem]
class CheckEmailExistsController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    #[OpenApi\Operation('checkEmailExists', tags: ['Auth'])]
    #[OpenApi\RequestBody(factory: CheckEmailExistRequest::class)]
    #[OpenApi\Response(factory: CheckEmailExistRequest::class, statusCode: 422)]
    public function checkEmailExists(CheckEmailExistRequest $request)
    {
        return $this->success('Email exists ::'.$request->email);
    }
}
