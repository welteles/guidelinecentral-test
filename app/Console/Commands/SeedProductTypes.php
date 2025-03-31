<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use App\Services\ProductTypeService;
use App\Models\ProductType;

/**
 * Seed initial product types using ProductTypeService.
 */
class SeedProductTypes extends Command
{
    protected $signature = 'seed:product-types';
    protected $description = 'Generate and save initial product types using ProductTypeService';

    public function handle(): void
    {
        $service = new ProductTypeService();

        $types = [
            'Shoes', 'Shirts', 'Pants', 'Accessories', 'Electronics',
            'Books', 'Sports', 'Toys', 'Beauty', 'Home & Kitchen'
        ];

        foreach ($types as $name) {
            $type = new ProductType([
                'id' => (string) Str::uuid(),
                'name' => $name
            ]);

            $service->save($type);
        }

        $this->info('Product types seeded successfully using ProductTypeService!');
    }
}
