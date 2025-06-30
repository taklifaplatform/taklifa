<?php

namespace Modules\Announcements\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Announcements\Entities\Announcement;
use Modules\Announcements\Transformers\AnnouncementTransformer;
use Modules\Announcements\Http\Requests\UpdateAnnouncementRequest;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class ManageAnnouncementController extends Controller
{
    /**
     * Store new Service.
     */
    #[OpenApi\Operation('createAnnouncement', tags: ['Announcement'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateAnnouncementRequest::class)]
    #[OpenApi\Response(factory: UpdateAnnouncementRequest::class, statusCode: 422)]
    #[OpenApi\Response(factory: AnnouncementTransformer::class)]
    public function createAnnouncement(UpdateAnnouncementRequest $updateServiceRequest)
    {
        $user = $updateServiceRequest->user();
        $announcementData = $updateServiceRequest->validated();
        $announcementData['user_id'] = $user->id;
        $announcement = Announcement::create($announcementData);

        if (isset($announcementData['images'])) {
            $this->addMultipleMedia($announcement, $announcementData['images'], 'images', true);
        }

        return AnnouncementTransformer::make($announcement);
    }

    /**
     * Update the specified Service.
     */
    #[OpenApi\Operation('updateAnnouncement', tags: ['Announcement'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateAnnouncementRequest::class)]
    #[OpenApi\Response(factory: UpdateAnnouncementRequest::class, statusCode: 422)]
    #[OpenApi\Response(factory: AnnouncementTransformer::class)]
    public function updateAnnouncement(UpdateAnnouncementRequest $updateServiceRequest, Announcement $announcement)
    {
        $user = $updateServiceRequest->user();

        if ($announcement->user_id !== $user->id) {
            abort(403, 'You are not allowed to perform this action on this announcement');
        }

        $announcementData = $updateServiceRequest->validated();
        $announcement->update($announcementData);

        if (isset($announcementData['images'])) {
            $this->addMultipleMedia($announcement, $announcementData['images'], 'images', true);
        }


        return AnnouncementTransformer::make($announcement->refresh());
    }

    /**
     * Remove the specified Service.
     */
    #[OpenApi\Operation('deleteAnnouncement', tags: ['Announcement'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: AnnouncementTransformer::class)]
    public function deleteAnnouncement(Request $request, Announcement $announcement)
    {
        $user = $request->user();

        if ($announcement->user_id !== $user->id) {
            abort(403, 'You are not allowed to perform this action on this announcement');
        }

        $announcement->delete();

        return $this->success('Announcement deleted successfully');
    }
}
