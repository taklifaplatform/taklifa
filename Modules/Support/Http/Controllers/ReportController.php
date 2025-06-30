<?php

namespace Modules\Support\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Modules\Vehicle\Entities\Vehicle;
use Modules\Company\Entities\Company;
use Modules\Api\Attributes as OpenApi;
use Modules\Support\Entities\ReportReason;
use Modules\Support\Transformers\ReportTransformer;
use Modules\Support\Http\Requests\StoreReportRequest;
use Modules\Support\Http\Requests\ListReportQueryRequest;
use Modules\Support\Transformers\ReportReasonTransformer;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class ReportController extends Controller
{
    /**
     * Display a listing of the Report Reasons.
     */
    #[OpenApi\Operation('fetchReportReason', tags: ['Support'])]
    #[OpenApi\Response(factory: ReportReasonTransformer::class)]
    #[OpenApi\Parameters(factory: ListReportQueryRequest::class)]
    public function fetchReportReason(ListReportQueryRequest $request)
    {
        $reasons = ReportReason::query()
            ->where('name', 'like', "%{$request->name}%")
            ->get();

        return ReportReasonTransformer::collection($reasons);
    }

    /**
     * Create new report.
     */
    #[OpenApi\Operation('storeReport', tags: ['Support'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: StoreReportRequest::class)]
    #[OpenApi\Response(factory: StoreReportRequest::class, statusCode: 422)]
    #[OpenApi\Response(factory: ReportTransformer::class)]
    public function storeReport(StoreReportRequest $request)
    {
        if ($request->reportable_type == 'company') {
            $reportable = Company::find($request->reportable_id);
        } elseif ($request->reportable_type == 'vehicle') {
            $reportable = Vehicle::find($request->reportable_id);
        } elseif ($request->reportable_type == 'user') {
            $reportable = User::find($request->reportable_id);
        }

        $reports = $reportable->reports()->updateOrCreate(
            [
                'user_id' => $request->user()->id,
                'reason_id' => $request->reason_id,
            ],
            [
                'message' => $request->message,
                'status' => 'pending',
            ]
        );

        return new ReportTransformer($reports);
    }
}
