<?php

namespace Modules\Announcements\Http\Controllers;

use Modules\Api\Attributes as OpenApi;
use App\Http\Controllers\Controller;
use Modules\Announcements\Entities\Announcement;
use Modules\Announcements\Transformers\AnnouncementTransformer;
use Modules\Announcements\Http\Requests\ListAnnouncementRequest;

#[OpenApi\PathItem]
class AnnouncementsController extends Controller
{
    /**
     * Display the list of announcements
     */
    #[OpenApi\Operation('listAnnouncements', tags: ['Announcement'])]
    #[OpenApi\Response(factory: AnnouncementTransformer::class, isPagination: true)]
    #[OpenApi\Parameters(factory: ListAnnouncementRequest::class)]
    public function listAnnouncements(ListAnnouncementRequest $request)
    {
        return AnnouncementTransformer::collection(
            Announcement::query()
                ->when($request->search, static function ($query, $search): void {
                    $query->where('title', 'like', sprintf('%%%s%%', $search));
                })
                ->when($request->category_id, static function ($query, $categoryId): void {
                    $query->where('category_id', $categoryId);
                })
                ->when($request->sub_category_id, static function ($query, $subCategoryId): void {
                    $query->where('sub_category_id', $subCategoryId);
                })
                ->when($request->years, static function ($query, $years): void {
                    $years = explode(',', $years);
                    $query->whereIn('metadata->model_year', $years);
                })
                ->orderBy($request->sort_by ?? 'created_at', $request->sort_direction ?? 'desc')
                ->with('category')
                ->withCount('views')
                ->paginate($request->per_page ?? 10)
        );
    }

    /**
     * Retrieve a service
     */
    #[OpenApi\Operation('retrieveAnnouncement', tags: ['Announcement'])]
    #[OpenApi\Response(factory: AnnouncementTransformer::class)]
    public function retrieveAnnouncement(Announcement $announcement): AnnouncementTransformer
    {
        $announcement->loadCount('views');

        return new AnnouncementTransformer($announcement);
    }
}
