<?php

namespace App\Services;

use App\Models\Product;

class ProductService extends JsonService
{
    protected string $modelClass = Product::class;

    public function all(): array 
    {
        $products = parent::all();
        foreach ($products as $product) {
            $this->loadRelations($product);
        }
        return $products;
    }

    public function find(string $id): ?object
    {
        $product = parent::find($id);
        if ($product) {
            $this->loadRelations($product);
        }
        return $product;
    }

    private function loadRelations(Product $product): void
    {
        $imageService = new ProductImageService();
        $images = array_filter(
            $imageService->all(),
            fn($img) => $img->productId == $product->id
        );

        $product->images = array_values($images);

        $ratingService = new RatingService();

        $averageRating = $ratingService->getAverage('product', $product->id);
        $product->averageRating = $averageRating['average'];
        $product->totalRating = $averageRating['total'];

        $typeService = new ProductTypeService();
        $product->type = $typeService->find($product->productType);

    }
}