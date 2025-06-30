<?php

namespace Modules\Analytics\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Analytics\Entities\AnnouncementAnalytic;
use Modules\Analytics\Transformers\AnnouncementAnalyticTransformer;
use Modules\Analytics\Http\Requests\ListAnnouncementAnalyticRequest;
use Modules\Analytics\Http\Requests\UpdateAnnouncementAnalyticRequest;
use Modules\Announcements\Entities\Announcement;

#[OpenApi\PathItem]
class AnnouncementAnalyticController extends Controller
{
    /**
     * Store new announcement analytic.
     */
    #[OpenApi\Operation('storeAnnouncementAnalytic', tags: ['Analytics'])]
    #[OpenApi\RequestBody(factory: UpdateAnnouncementAnalyticRequest::class)]
    #[OpenApi\Response(factory: UpdateAnnouncementAnalyticRequest::class, statusCode: 422)]
    #[OpenApi\Response(factory: AnnouncementAnalyticTransformer::class)]
    public function storeAnnouncementAnalytic(UpdateAnnouncementAnalyticRequest $request, Announcement $announcement)
    {
        $validated = $request->validated();
        $viewerId = $request->user()?->id ?? null;

        $announcementAnalytic = AnnouncementAnalytic::create([
            ...$validated,
            'announcement_id' => $announcement->id,
            'viewer_id' => $viewerId,
            'count' => 1,
            'ip_address' => $request->ip(),
        ]);

        return AnnouncementAnalyticTransformer::make($announcementAnalytic);
    }

    /**
     * Get announcement analytics.
     */
    #[OpenApi\Operation('getAnnouncementAnalytics', tags: ['Analytics'])]
    #[OpenApi\Response(factory: AnnouncementAnalyticTransformer::class, isArray: true)]
    #[OpenApi\Parameters(factory: ListAnnouncementAnalyticRequest::class)]
    public function getAnnouncementAnalytics(ListAnnouncementAnalyticRequest $request)
    {
        $announcement = $request->route('announcement');
        $announcementAnalytics = AnnouncementAnalytic::where('announcement_id', $announcement)->get();

        return AnnouncementAnalyticTransformer::collection($announcementAnalytics);
    }
}
