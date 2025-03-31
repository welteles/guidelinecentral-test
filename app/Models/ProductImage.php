<?php

namespace App\Models;

class ProductImage
{
    public static string $table = 'product_images';
    public string $id;
    public string $productId;
    public string $filename;


    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? '';
        $this->productId = $data['productId'];
        $this->filename = $data['filename'];
    }
}