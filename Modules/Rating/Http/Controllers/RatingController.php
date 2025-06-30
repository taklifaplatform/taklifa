<?php

namespace Modules\Rating\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Company\Entities\Company;
use Modules\Rating\Entities\RatingType;
use Modules\Rating\Http\Requests\UpdateRatingRequest;
use Modules\Rating\Transformers\ItemRatingTransformer;
use Modules\Rating\Transformers\RatingTypeTransformer;
use Modules\Rating\Http\Requests\ListItemRatingsQueryRequest;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class RatingController extends Controller
{
    /**
     * Fetch All Ratings.
     */
    #[OpenApi\Operation('fetchRatings', tags: ['Rating'])]
    #[OpenApi\Parameters(ListItemRatingsQueryRequest::class)]
    #[OpenApi\Response(ItemRatingTransformer::class, isPagination: true)]
    public function fetchRatings(ListItemRatingsQueryRequest $request, string $id)
    {
        if ($request->get('type') == 'company') {
            $entity = Company::findOrFail($id);
        }

        if ($request->get('type') == 'driver') {
            $entity = User::findOrFail($id);
        }

        return ItemRatingTransformer::collection(
            $entity->ratings()
                ->latest()
                ->with([
                    'user',
                    'scores',
                    'scores.type',
                ])
                ->paginate($request->per_page ?? 10)
        );
    }

    /**
     * Fetch Ratings Types.
     */
    #[OpenApi\Operation('fetchRatingTypes', tags: ['Rating'])]
    #[OpenApi\Response(RatingTypeTransformer::class, isArray: true)]
    public function fetchRatingTypes(Request $request)
    {
        return RatingTypeTransformer::collection(RatingType::all());
    }

    /**
     * Store Rating.
     */
    #[OpenApi\Operation('storeRating', tags: ['Rating'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(UpdateRatingRequest::class)]
    #[OpenApi\Response(UpdateRatingRequest::class, statusCode: 422)]
    public function storeRating(UpdateRatingRequest $request)
    {
        if ($request->entity_type == 'driver') {
            $entity = User::findOrFail($request->entity_id);
        } else {
            $entity = Company::findOrFail($request->entity_id);
        }

        $rating = $entity->ratings()->firstOrCreate(
            [
                'user_id' => $request->user()->id,
            ],
        );

        $rating->update([
            'comment' => $request->comment,
        ]);

        $score = 0;
        foreach ($request->get('rates') as $rate) {
            $savedScore = $rating->scores()->updateOrCreate(
                [
                    'rating_type_id' => $rate['rating_type_id'],
                ],
                [
                    'score' => $rate['score'],
                ]
            );
            $score += $savedScore->score;
        }

        $rating->score = $score / count($request->get('rates'));
        $rating->created_at = now();
        $rating->save();

        return $this->success(__('Your rating has been saved successfully'));
    }
}
