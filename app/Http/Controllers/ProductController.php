<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\RatingService;

class ProductController extends Controller
{
    protected ProductService $productService;

    protected RatingService $ratingService;

    public function __construct()
    {
        $this->productService = new ProductService();
        $this->ratingService = new RatingService();
    }

    public function index()
    {
        $products = $this->productService->all();
        return view('products.index', compact('products'));
    }

    public function show(string $id)
    {
        $product = $this->productService->find($id);
        abort_if(!$product, 404);
        return view('products.show', compact('product'));
    }

    public function rate(Request $request, string $id)
    {
        $request->validate([
            'stars' => 'required|integer|min:1|max:5',
        ]);

        $rating = new Rating([
            'contentType' => 'product',
            'contentId' => $id,
            'stars' => $request->stars,
        ]);

        $this->ratingService->save($rating );

        return redirect()->route('products.show', $id)->with('success', 'Thanks for rating!');
    }
}
