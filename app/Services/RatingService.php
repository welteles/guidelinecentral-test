<?php

namespace App\Services;

use App\Models\Rating;

class RatingService extends JsonService
{
    protected string $modelClass = Rating::class;

    public function getAverage(string $type, string $id): array 
    {
        $ratings = array_filter(
            $this->all(),
            fn($rating) =>
            $rating->contentType === $type &&
            $rating->contentId === $id
        );

        $count = count($ratings);
        $total = array_sum(
            array_map(fn($r) => $r->stars, $ratings)
        );
        $average = $count ? round(($total / $count) * 2) / 2 : 0.0;

        return [
            'total' => $total,
            'average' => $average
        ];
    }

    public function save(object $rating): void
    {
        if (!($rating instanceof Rating)) {
            $rating = new Rating([
                'id' => $rating->id,
                'content_type' => $rating->content_type ?? $rating->contentType,
                'content_id' => $rating->content_id ?? $rating->contentId,
                'stars' => $rating->stars
            ]);
        }

        parent::save($rating);
    }
}