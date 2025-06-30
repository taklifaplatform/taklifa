<?php

namespace Modules\Announcements\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Announcements\Entities\AnnouncementCategory;
use Modules\Announcements\Transformers\AnnouncementCategoryTransformer;
use Modules\Announcements\Http\Requests\ListAnnouncementCategoriesRequest;

#[OpenApi\PathItem]
class AnnouncementCategoriesController extends Controller
{
    /**
     * Display the list of announcement categories
     */
    #[OpenApi\Operation('listAnnouncementCategories', tags: ['Announcement'])]
    #[OpenApi\Response(factory: AnnouncementCategoryTransformer::class, isArray: true)]
    #[OpenApi\Parameters(factory: ListAnnouncementCategoriesRequest::class)]
    public function listAnnouncementCategories(ListAnnouncementCategoriesRequest $request)
    {
        return AnnouncementCategoryTransformer::collection(
            AnnouncementCategory::query()
                ->when($request->search, static function ($query, $search): void {
                    $query->where('name', 'like', sprintf('%%%s%%', $search));
                })
                ->when($request->category_id, static function ($query, $categoryId): void {
                    $query->where('parent_id', $categoryId);
                })
                ->when(!$request->category_id, static function ($query): void {
                    $query->where('parent_id', null);
                })
                ->where('enabled', true)
                ->orderBy('order', 'asc')
                ->with('enabledSubCategories')
                ->get()
        );
    }
}
