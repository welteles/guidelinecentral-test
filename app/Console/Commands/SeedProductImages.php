<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Services\ProductService;
use App\Services\ProductImageService;
use App\Models\ProductImage;

class SeedProductImages extends Command
{
    protected $signature = 'seed:product-images';
    protected $description = 'Download and attach random product images from Picsum to existing products';

    public function handle(): void
    {
        $productService = new ProductService();
        $productImageService = new ProductImageService();
        $products = $productService->all();

        if (count($products) === 0) {
            $this->error('No products found. Run seed:products first.');
            return;
        }

        $imageBase = "https://picsum.photos/seed/";

        for ($i = 1; $i <= 40; $i++) {
            $imageSeeds[] = "clothing{$i}";
        }

        foreach ($products as $product) {
            $selectedSeeds = array_rand($imageSeeds, rand(2, max: 5));
            $selectedSeeds = is_array($selectedSeeds) ? $selectedSeeds : [$selectedSeeds];

            foreach ($selectedSeeds as $seedIndex) {
                $seed = $imageSeeds[$seedIndex];

                // Medium
                $mediumUrl = "https://picsum.photos/seed/{$seed}/600/600";
                $mediumResponse = Http::get($mediumUrl);
                if (!$mediumResponse->successful()) {
                    $this->warn("Failed to download medium image: $mediumUrl");
                    continue;
                }

                // Thumb
                $thumbUrl = "https://picsum.photos/seed/{$seed}_thumb/300/200";
                $thumbResponse = Http::get($thumbUrl);
                if (!$thumbResponse->successful()) {
                    $this->warn("Failed to download thumb image: $thumbUrl");
                    continue;
                }

                // Filenames
                $uuid = (string) Str::uuid();
                $mediumFilename = "uploads/medium/{$uuid}.jpg";
                $thumbFilename = "uploads/thumbnail/{$uuid}.jpg";

                // Save to disk
                Storage::disk('public')->put($mediumFilename, $mediumResponse->body());
                Storage::disk('public')->put($thumbFilename, $thumbResponse->body());

                // Save record
                $image = new ProductImage([
                    'id' => $uuid,
                    'productId' => $product->id,
                    'filename' => "{$uuid}.jpg",
                ]);

                $productImageService->save($image);
            }
        }

        $this->info('Product images downloaded, resized and linked successfully!');
    }
}
