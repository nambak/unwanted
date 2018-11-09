<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Category;
use App\Tag;
use App\Http\Requests\StoreArticleRequest;


class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::getList();
        $all_categories = Category::all();
        $all_tags = Tag::all();

        return view('articles.index', compact('articles', 'all_categories', 'all_tags'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('articles.create', compact('categories'));
    }

    public function store(StoreArticleRequest $request)
    {
        $article = Article::create($request->all() + ['user_id' => auth()->id()]);

        if (isset($request->categories)) {
            $article->categories()->attach($request->categories);
        }

        if ($request->tags != '') {
            $tags = explode(',', $request->tags);
            foreach ($tags as $tag_name) {
                $tag = Tag::firstOrCreate(['name' => $tag_name]);
                $article->tags()->attach($tag);
            }
        }

        if ($request->hasFile('main_image')) {
            $article->addMediaFromRequest('main_image')->toMediaCollection('main_images');
        }

        return redirect()->route('articles.index');
    }

    public function show(Article $article)
    {
        $article->load(['categories', 'tags', 'author']);
        $all_categories = Category::all();
        $all_tags = Tag::all();
        return view('articles.show', compact('article', 'all_categories', 'all_tags'));
    }
}
