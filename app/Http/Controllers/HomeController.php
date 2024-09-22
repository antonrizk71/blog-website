<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\users\Article;
use App\Models\users\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $categories = Category::all();
        return view('website.index', compact('categories'));
    }


    public function UserArticles($id)
    {
        $user = User::find($id);
        $articles = Article::where('admin_id', $id)->latest()
            // ->where('status', 'approved')
            ->with('admin')
            ->with('likes')->get();
        $categories = Category::all();
        return view('website.user_articles', compact('articles', 'categories','user'));
    }




    public function category_user($id, $cat_id)
    {
        $user = User::find($id);
        $articles = Article::where('admin_id', $id)
            // ->where('status', 'approved')
            ->where('category_id', $cat_id)->latest()
            ->with('admin')
            ->with('likes')->get();
        $categories = Category::all();
        return view('website.user_articles', compact('articles', 'categories','user'));
    }


    public function home()
    {

        $articles = Article::where('status', 'approved')->latest()
            ->with('admin')
            ->with('likes')
            ->paginate(3);
        $categories = Category::all();
        return view('website.home', compact('articles', 'categories'));
    }

    public function category($id)
    {

        $articles = Article::where('category_id', $id)->latest()
            ->where('status', 'approved')
            ->with('admin')
            ->with('likes')
            ->paginate(3);
        $categories = Category::all();
        return view('website.home', compact('articles', 'categories'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $articles = Article::where('title', 'like', '%' . $search . '%')->latest()
            ->with('admin')
            ->with('likes')
            ->paginate(3);
        $categories = Category::all();
        return view('website.home', compact('articles', 'categories'));
    }


    public function UserArticleSearch(Request $request)
    {
        $search = $request->search;
        $articles = Article::where('title', 'like', '%' . $search . '%')->latest()
            ->where('admin_id', Auth::user()->id)
            ->with('admin')
            ->with('likes')
            ->paginate(3);
        $categories = Category::all();
        return view('website.home', compact('articles', 'categories'));
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
    public function show(Request $request)
    {
        // $search = $request->input('search', '');
        // $articles = Article::where('title', 'like', '%' . $search . '%')
        //     ->with('admin')
        //     ->get();
        // $categories = Category::all();
        // return view('website.index', compact('articles', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
