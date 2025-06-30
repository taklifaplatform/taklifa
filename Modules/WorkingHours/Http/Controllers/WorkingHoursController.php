<?php

namespace Modules\WorkingHours\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\WorkingHours\Entities\WorkingHour;
use Modules\WorkingHours\Transformers\WorkingHourTransformer;
use Modules\WorkingHours\Http\Requests\UpdateWorkingHoursRequest;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class WorkingHoursController extends Controller
{
    /**
     * Get Working hours by id
     */
    #[OpenApi\Operation('retrieve', tags: ['Working Hours'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: WorkingHourTransformer::class)]
    public function retrieve(WorkingHour $workingHour)
    {
        return WorkingHourTransformer::make(
            $workingHour
        );
    }

    /**
     * Update working hours
     */
    #[OpenApi\Operation('update', tags: ['Working Hours'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateWorkingHoursRequest::class)]
    #[OpenApi\Response(factory: WorkingHourTransformer::class)]
    public function update(UpdateWorkingHoursRequest $request, WorkingHour $workingHour)
    {
        $user = $request->user();

        // make sure the user is updating their own working hours, or the company working hours
        if ($workingHour->working_hourable_id !== $user->id && ! $user->companies()->find($workingHour->working_hourable_id)) {
            abort(403, 'You are not authorized to update this working hours');
        }

        $workingHour->update($request->validated());

        return WorkingHourTransformer::make(
            $workingHour
        );
    }
}
