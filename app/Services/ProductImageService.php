<?php

namespace App\Services;

use App\Models\ProductImage;

class ProductImageService extends JsonService
{
    protected string $modelClass = ProductImage::class;
}