<div class="product-detail-container">
    {{-- Left Column (Image + Thumbnails) --}}
    <div class="product-images">
        @php
            $mainImage = $product->images[0] ?? null;
        @endphp

        <div class="main-image">
            @if($mainImage)
                <img src="{{ asset('storage/uploads/medium/' . $mainImage->filename) }}" alt="Main Product Image">
            @else
                <div class="image-placeholder">Main Product Image</div>
            @endif
        </div>

        <div class="thumbnails">
            @foreach($product->images as $img)
                <img src="{{ asset('storage/uploads/thumbnail/' . $img->filename) }}" alt="Thumbnail">
            @endforeach
        </div>
    </div>

    <div class="product-info">
        <h2>{{ $product->name }}</h2>
        @include('components.rating-stars', ['averageRating' => $product->averageRating, 'totalRating' => $product->totalRating])
        <div class="product-price">${{ number_format($product->price, 2, '.', ',') }}</div>
        <h5>Description</h5>
        <p>{{ $product->description }}</p>
        <h5>Rate this product</h5>
        <div class="rating-stars-interactive">
            @for ($i = 1; $i <= 5; $i++)
                <button type="button" class="star-button" data-star="{{ $i }}">&#9733;</button>
            @endfor
        </div>

        <form id="rating-form" method="POST" action="{{ route('products.rate', $product->id) }}" style="display: none;">
            @csrf
            <input type="hidden" name="stars" id="rating-stars-input">
        </form>
        <a href="{{ route('products.index') }}" class="details">Back to list</a>
    </div>
</div>

@vite('resources/css/product.css')
@vite('resources/css/product-detail.css')
@push('scripts')
<script>
    document.querySelectorAll('.star-button').forEach(button => {
        button.addEventListener('click', function () {
            const stars = this.getAttribute('data-star');

            if (confirm(`Are you sure you want to rate this product ${stars} star${stars > 1 ? 's' : ''}?`)) {
                document.getElementById('rating-stars-input').value = stars;
                document.getElementById('rating-form').submit();
            }
        });
    });
</script>
@endpush
