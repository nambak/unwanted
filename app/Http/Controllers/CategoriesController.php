<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name']
        ]);

        try {
            $category = Category::create([
                'name' => $request->name
            ]);

            return response()->json([
                'success'  => true,
                'category' => $category,
                'message'  => '카테고리가 성공적으로 추가되었습니다.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '카테고리 추가 중 오류가 발생했습니다: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Category $category)
    {
        return $category->delete() ? 'success' : response('error', 500);
    }
}
