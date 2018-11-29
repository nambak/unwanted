<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Category;
use App\Tag;
use App\Http\Requests\StoreArticleRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\Models\Media;


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
        if (! Auth::check()) {
            abort(401, 'Unauthorized');
        }

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

    public function edit(Article $article)
    {
        if (! Auth::check()) {
            abort(401, 'Unauthorized');
        }

        $categories = Category::all();
        $selectedCategories = $article->categories->pluck('name')->toArray();
        $tags = implode(',', $article->tags->pluck('name')->toArray());

        return view('articles.edit', compact('article', 'categories', 'tags', 'selectedCategories'));
    }

    public function update(Article $article, StoreArticleRequest $request)
    {
        $article->title = $request->title;
        $article->article_text = $request->article_text;
        $article->save();

        if (isset($request->categories)) {
            $article->with(['categories'])->find($article->id)->categories()->sync($request->categories);
        }

        if ($request->tags != '') {
            $tags = explode(',', $request->tags);
            foreach ($tags as $tag_name) {
                $tag = Tag::firstOrCreate(['name' => trim($tag_name)]);
                $tagsIds[] = $tag['id'];
            }
            $article->with(['tags'])->find($article->id)->tags()->sync($tagsIds);
        }

        if ($request->hasFile('main_image')) {
            $media = Media::where('model_id', $article->id)->first();

            $article->deleteMedia($media->id);

            $article->addMediaFromRequest('main_image')->toMediaCollection('main_images');
        }

        return redirect()->route('articles.show', ['article' => $article->id]);
    }

    public function destroy(Article $article)
    {
        if (! Auth::check()) {
            abort(401, 'Unauthorized');
        }

        $article->delete();

        return redirect()->route('articles.index');
    }
}
