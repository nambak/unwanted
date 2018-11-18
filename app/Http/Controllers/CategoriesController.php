<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        if (! auth()->check()) {
            abort(401, 'Unauthorized');
        }

        return view('categories.create');
    }

    public function store(Request $request)
    {
        if (! auth()->check()) {
            abort(401, 'Unauthorized');
        }

        $category = new Category;
        $category->name = $request->name;
        $category->save();

        return redirect('/categories');
    }

    public function destroy(Category $category)
    {
        if (! auth()->check()) {
            abort(401, 'Unauthorized');
        }

        return $category->delete() ? 'success' : response('error', 500);
    }
}
