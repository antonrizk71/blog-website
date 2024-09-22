<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\users\Article;
use App\Models\users\Category;
use App\Traits\Uploadimage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    use Uploadimage;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.admin_home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.create_admin');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {

        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'role' => 'required',
                'status' => 'required',

            ]);
            $imageName = null;
            if ($request->hasFile('image')) {
                $imageName = $this->uploadImage($request, 'image', 'admins_images');
            }

            // Create a new admin
            $admin = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'image' => $imageName,
                'role' => $request->role,
                'status' => $request->status,
            ]);
            alert()->success('Admin', 'Admin added successfully');
        } catch (\Exception $e) {

            alert()->error('Admin', 'Failed to add admin');
            return redirect()->back()->withInput();
        }
        return redirect()->route('allusers.showall');
    }
    /**
     * Display the specified resource.
     */
    public function show(User $admin)
    {
        //

    }
    public function alladmins()
    {
        $title = 'Admins';
        $admins =   User::where('role', 'admin')->latest()->get();
        return view('admin.admin_table', compact('admins', 'title'));
    }

    public function getusers()
    {
        $title = 'Users';
        $admins =   User::where('role', 'user')->latest()->get();
        return view('admin.admin_table', compact('admins', 'title'));
    }

    public function allusers()
    {
        $title = 'All Users';
        $admins =   User::latest()->get();
        return view('admin.admin_table', compact('admins', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $admin)
    {
        //
        return view('admin.update_admin', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $admin)
    {
        try {
            // Validate the request data
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('users')->ignore($admin->id),
                ],
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                //        'password' => 'nullable|string|min:8',  // Make password nullable
                'role' => 'required',
                'status' => 'required',
            ]);


            // Handle image upload if provided
            $imageName = $admin->image;
            if ($request->hasFile('image')) {
                $path = public_path('upload_images/' . $admin->image);
                if (file_exists($path)) {
                    try {
                        unlink($path);
                    } catch (\Exception $e) {

                        report($e);
                    }
                }
                $imageName = $this->uploadImage($request, 'image', 'admins_images');
            }
            $admin->update([
                'name' => $request->name,
                'email' => $request->email,
                'image' => $imageName,
                //    'password' => Hash::make($request->password),
                'role' => $request->role,
                'status' => $request->status,
            ]);

            // dd($request);
            // $admin->update([$request->all()]);
            alert()->success('Admin', 'Admin updated successfully');
        } catch (\Exception $e) {
            alert()->error('Admin', 'Failed to add admin');
            return redirect()->back();
        }
        return redirect()->route('allusers.showall');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $admin)
    {
        try {
            if ($admin->image) {
                $path = public_path('upload_images/' . $admin->image);
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $admin->delete();
            alert()->success('Admin', 'Deleted successfully');
        } catch (\Exception $e) {
            alert()->error('Admin', 'Failed to delete');
        }
        return redirect()->back();
    }

    public function SearchForUser(Request $request)
    {
        try {
            if ($request->searchterm) {
                $title = 'Search';
                $admins = User::where('name', 'like', '%' . $request->searchterm . '%')
                    ->orWhere('email', 'like', '%' . $request->searchterm . '%')
                    ->latest()
                    ->get();
                return view('admin.admin_table', compact('admins', 'title'));
            }
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function search(Request $request)
    {
        try {
            $categories = Category::all();
            $articles = null;
            // dd($request);
            if ($request->searchby === 'email') {
                $writer = User::where('email', 'LIKE', '%' . $request->searchterm . '%')->first();
                if ($writer) {
                    $articles = Article::where('admin_id', $writer->id)->get();
                } else {
                    return redirect()->back();
                }
            } elseif ($request->searchby === 'title') {
                $articles = Article::where('title', 'LIKE', '%' . $request->searchterm . '%')->get();
                return view('admin.article.index', compact('articles', 'categories'));
            } elseif ($request->searchby === 'category') {
                $categoryid = Category::where('name', $request->categoryname)->first()->id;
                $articles = Article::where('category_id', $categoryid)->get();
            } elseif ($request->searchby === 'date') {
                $query = Article::query();
                if ($request->date1 && $request->date2) {
                    $startDate = Carbon::createFromFormat('Y-m-d', $request->date1)->startOfDay();
                    $endDate = Carbon::createFromFormat('Y-m-d', $request->date2)->endOfDay();
                    $query->whereBetween('created_at', [$startDate, $endDate]);
                }
                $articles = $query->get();
            }
            return view('admin.article.index', compact('articles', 'categories'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
}
