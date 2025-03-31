<?php

namespace App\Services;

use App\Models\ProductType;

class ProductTypeService extends JsonService
{
    protected string $modelClass = ProductType::class;
}