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
}
