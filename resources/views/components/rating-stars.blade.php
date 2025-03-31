<div class="product-rating">

    <div class="rating-stars" title="{{ $averageRating }} / 5">
        @php
            $rating = $averageRating ?? 0;
            $fullStars = floor($rating);
            $halfStar = $rating - $fullStars >= 0.5;
            $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
        @endphp

        @for ($i = 0; $i < $fullStars; $i++)
            <i class="fas fa-star"></i>
        @endfor

        @if ($halfStar)
            <i class="fas fa-star-half-alt"></i>
        @endif

        @for ($i = 0; $i < $emptyStars; $i++)
            <i class="far fa-star"></i>
        @endfor
    </div>

    <div class="rating-info">
        <small>{{ $averageRating ?? 0 }} ({{ $totalRating ?? 0 }} Reviews)</small>
    </div>
</div>