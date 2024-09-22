<?php

namespace App\Http\Controllers;

use App\Models\users\Article;
use App\Traits\Uploadimage;
use App\Models\users\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    use Uploadimage;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
        $articles = Article::latest()->get();
        $categories = Category::all();
        return view('admin.article.index', compact('articles', 'categories'));
    }

    public function pending_articles()
    {
        $articles = Article::where('status', 'pending')->latest()->get();
        $categories = Category::all();
        return view('admin.article.index', compact('articles', 'categories'));
    }
    public function approved_articles()
    {
        $articles = Article::where('status', 'approved')->latest()->get();
        $categories = Category::all();
        return view('admin.article.index', compact('articles', 'categories'));
    }

    public function rejected_articles()
    {
        $articles = Article::where('status', 'rejected')->latest()->get();
        $categories = Category::all();
        return view('admin.article.index', compact('articles', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add()
    {
        //
        $categories = Category::all();
        return view('website.new_article', compact('categories'));
    }
    public function create()
    {
        //
        $categories = Category::all();
        return view('admin.article.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'type' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            // dd($request['image']);

            $imagpath = null;
            if ($request->hasFile('image')) {
                $imagpath = $this->uploadimage($request, 'image', 'articles_images');
            }
            $status = 'pending';
            if ($request->status) {
                $status = $request->status;
            }
            Article::create([
                'title' => $request->title,
                'content' => $request->content,
                'category_id' => $request->type,
                'admin_id' => Auth::user()->id,
                'image' => $imagpath,
                'status' => $status,
            ]);
            alert()->success('Article', 'Article added successfully');
        } catch (\Exception $e) {
            alert()->error('Article', 'Failed to add article');
            return redirect()->back()->withInput();
        }
        if (Auth::user()->role == 'admin') {
            return redirect()->route('articles.index');
        }

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $art = Article::with('admin', 'likes', 'comments.user')->find($id);
        $categories = Category::all();
        return view('admin.article.show', compact('art', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
        $categories = Category::all();
        return view('admin.article.update', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'type' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif'
            ]);
            // dd($request['image']);

            $imagpath = $article->image;
            if ($request->hasFile('image')) {
                //delete old image
                $path = public_path('upload_images/' . $article->image);
                if (file_exists($path)) {
                    try {
                        unlink($path);
                    } catch (\Exception $e) {
                        report($e);
                    }
                }
                $imagpath = $this->uploadimage($request, 'image', 'articles_images');
            }
            $status = 'pending';
            if ($request->status) {
                $status = $request->status;
            }
            $article->update([
                'title' => $request->title,
                'content' => $request->content,
                'category_id' => $request->type,
                'image' => $imagpath,
                'status' => $status,
            ]);
            alert()->success('Article', 'Article updated successfully');
        } catch (\Exception $e) {
            alert()->error('Article', 'Failed to update article');
        }
        if(Auth::user()->role==='user')
        {
            return redirect()->back();
        }
        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        try {
            if ($article->image) {
                $path = public_path('upload_images/' . $article->image);
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $article->delete();
            alert()->success('Article', 'Article deleted successfully');
        } catch (\Exception $e) {
            alert()->error('Article', 'Failed to delete article');
        }
        return redirect()->back();
    }
}
