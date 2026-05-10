<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\CategoryGroup;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index(Request $request)
    {
        $query = Product::where('is_active', true);

        if ($request->filled('categories')) {
            $categoryIds = $request->categories;

            $query->whereHas('categories', function ($q) use ($categoryIds) {
                $q->whereIn('categories.id', $categoryIds);
            });
        }
        
        if ($request->filled('travel_price_level')) {
            $query->where('travel_price_level', '<=', $request->travel_price_level);
        }

        $products = $query->get();

        $categoryGroups = CategoryGroup::with('categories')->get();

        return view('products.index', compact('products', 'categoryGroups'));
    }
    
    /*public function index()
    {
        $products = Product::where('is_active', true)->get();

        return view('products.index', compact('products'));
    }*/
    public function home()
    {
        $featuredProducts = Product::where('is_active', true)
            ->take(3)
            ->get();

        return view('home', compact('featuredProducts'));
    }
        

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
