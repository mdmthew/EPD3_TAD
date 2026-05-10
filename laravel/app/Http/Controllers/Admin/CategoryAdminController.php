<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryAdminController extends Controller
{
    public function index()
    {
        $categories = Category::with(['group', 'products'])
            ->latest()
            ->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $groups = CategoryGroup::orderBy('name')->get();

        return view('admin.categories.create', compact('groups'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_group_id' => 'required|exists:category_groups,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
        ]);

        $data['slug'] = Str::slug($data['slug'] ?: $data['name']);

        Category::create($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Categoría creada correctamente');
    }

    public function edit(Category $category)
    {
        $groups = CategoryGroup::orderBy('name')->get();

        return view('admin.categories.edit', compact('category', 'groups'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'category_group_id' => 'required|exists:category_groups,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $category->id,
        ]);

        $data['slug'] = Str::slug($data['slug'] ?: $data['name']);

        $category->update($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Categoría actualizada correctamente');
    }

    public function destroy(Category $category)
    {
        $category->products()->detach();
        $category->delete();

        return back()->with('success', 'Categoría eliminada correctamente');
    }
}