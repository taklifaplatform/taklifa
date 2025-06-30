<?php

namespace Modules\Rating\Entities\Traits;

use Modules\Rating\Entities\Rating;
use Modules\Rating\Entities\RatingType;

trait HasRating
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function ratings()
    {
        return $this->morphMany(Rating::class, 'rateable');
    }

    public function getRatingsScoreAndCount(): array
    {
        return [
            'name' => 'All',
            'count' => $this->ratings->count(),
            'score' => round($this->ratings->avg('score'), 1),
        ];
    }

    /**
     * @return array<mixed, array<'count'|'name'|'score', mixed>>
     */
    public function getRatingScoreFromTypes(): array
    {
        $scores = [];

        foreach (RatingType::all() as $type) {
            $query = $this->ratings->pluck('scores')->flatten()->where('rating_type_id', $type->id);
            $scores[] = [
                'name' => $type->name,
                'score' => round($query->avg('score'), 1),
                'count' => $query->count(),
            ];
        }

        return $scores;
    }
}
