<?php

namespace App\Http\Controllers;

use App\Http\Resources\V1\ProductResource;
use App\Models\Product;
use App\Traits\ApiResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    use ApiResponses;

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $products = Product::with('category')->paginate(10);

        return $this->ok('Products retrieved successfully', ProductResource::collection($products));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): JsonResponse
    {
        $product->load('category');

        return $this->ok('Product retrieved successfully', new ProductResource($product));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): void
    {
        //
    }

    public function queries(): JsonResponse
    {
        $nameAndPrice = Product::select('name', 'price')->get();
        $productsWithCategory = Product::with('category')->get();
        $productsOrderedByPrice = Product::select('id', 'name')->orderBy('price')->get();
        $firstFiveProducts = Product::limit(5)->get();
        $priceGreaterThanOrEqual = Product::where('price', '>=', 3)->get();
        $totalPrice = Product::sum('price');
        $averagePrice = number_format(Product::avg('price'), 2, '.', '');
        $highestPrice = Product::max('price');
        $lowestPrice = Product::min('price');

        $categoryTotals = Product::join('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.name', DB::raw('SUM(products.price) as total_price'))
            ->groupBy('categories.name')
            ->get();

        return $this->ok('Query results retrieved successfully', [
            'name_and_price' => $nameAndPrice,
            'products_with_category' => $productsWithCategory,
            'products_ordered_by_price' => $productsOrderedByPrice,
            'first_five_products' => $firstFiveProducts,
            'price_greater_than_or_equal' => $priceGreaterThanOrEqual,
            'total_price' => $totalPrice,
            'average_price' => $averagePrice,
            'highest_price' => $highestPrice,
            'lowest_price' => $lowestPrice,
            'category_totals' => $categoryTotals,
        ]);
    }
}
