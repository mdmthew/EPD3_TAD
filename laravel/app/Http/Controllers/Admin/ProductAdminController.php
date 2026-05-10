<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductAdminController extends Controller
{
    public function index()
    {
        $products = Product::with('categories')->latest()->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::with('group')->get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'travel_price_level' => 'required|integer|min:1|max:3',
            'image' => 'nullable|image|max:2048',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img'), $fileName);
            $data['image'] = 'img/' . $fileName;
        }

        $data['is_active'] = $request->has('is_active');

        $product = Product::create($data);

        $product->categories()->sync($request->categories ?? []);

        return redirect()->route('admin.products.index')
            ->with('success', 'Producto creado correctamente');
    }

    public function edit(Product $product)
    {
        $categories = Category::with('group')->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'travel_price_level' => 'required|integer|min:1|max:3',
            'image' => 'nullable|image|max:2048',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img'), $fileName);
            $data['image'] = 'img/' . $fileName;
        }

        $data['is_active'] = $request->has('is_active');

        $product->update($data);

        $product->categories()->sync($request->categories ?? []);

        return redirect()->route('admin.products.index')
            ->with('success', 'Producto actualizado correctamente');
    }

    public function toggle(Product $product)
    {
        $product->update([
            'is_active' => !$product->is_active,
        ]);

        return back()->with('success', 'Visibilidad actualizada');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return back()->with('success', 'Producto eliminado');
    }
}