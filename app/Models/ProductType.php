<?php

namespace App\Models;

class ProductType 
{
    public static string $table = 'product_types';
    public string $id;
    public string $name;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
    }
}