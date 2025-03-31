<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use App\Models\Product;
use App\Services\ProductService;
use App\Services\ProductTypeService;

/**
 * Seeds 20 fake products using Faker and ProductService.
 */
class SeedProducts extends Command
{
    protected $signature = 'seed:products';
    protected $description = 'Generate and save 20 sample products using ProductService and Faker';

    public function handle(): void
    {
        $faker = Faker::create();
        $productService = new ProductService();
        $typeService = new ProductTypeService();
        $types = $typeService->all();

        if (count($types) === 0) {
            $this->error('No product types found. Run seed:product-types first.');
            return;
        }

        for ($i = 1; $i <= 20; $i++) {
            $type = $types[array_rand($types)];

            $product = new Product([
                'productType' => $type->id,
                'name' => $faker->words(3, true), // ex: "Wireless Noise Cancelling Headphones"
                'description' => $faker->sentence(10),
                'price' => $faker->randomFloat(2, 30, 300), // 2 casas, de R$30 a R$300
            ]);

            $productService->save($product);
        }

        $this->info('20 fake products seeded successfully using ProductService and Faker!');
    }
}
