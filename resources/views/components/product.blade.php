<div class="product">
    <div class="product-image-container">
        @php
            $thumb = $product->images && count($product->images) > 0
                ? $product->images[array_rand($product->images)]
                : null;
        @endphp

        @if($thumb)
            <img src="{{ asset('storage/uploads/thumbnail/' . $thumb->filename) }}" alt="Thumbnail" class="product-thumbnail">
        @else
            <div class="no-image">No image</div>
        @endif
    </div>
    <div class="product-content">
        <a href="{{ route('products.show', $product->id) }}" class="product-title">{{ $product->name }}</a>
        <div class="product-price">${{ number_format($product->price, 2, '.', ',') }}</div>
        <div>
            <span class="product-type">{{ $product->type->name ?? 'Uncategorized' }}</span>
        </div>
        @include('components.rating-stars', ['averageRating' => $product->averageRating, 'totalRating' => $product->totalRating])
        <a href="{{ route('products.show', $product->id) }}" class="details">View Details</a>
    </div>
</div>

@vite('resources/css/product.css')
