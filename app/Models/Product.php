<?php

namespace App\Models;

class Product 
{
    public static string $table = 'products';
    public string $id;
    public string $productType;
    public string $name;
    public string $description;
    public float $price;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? '';
        $this->productType = $data['productType'];
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->price = $data['price'];
    }
}