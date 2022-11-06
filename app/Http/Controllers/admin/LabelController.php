<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpParser\Node\Expr\Cast;
use PhpParser\Node\Stmt\Label;

class LabelController extends Controller
{
    public function create(Request $request, $id)
    {
        $posts = [];
    
       
        if ($request->isMethod('get')) {
            if(request()->query('name')) {
                $posts = Post::orderBy('id', 'desc')->paginate(5)->withQueryString();
            } else if($categoryName = request()->query('category')) {
                $category = Category::where('name', $categoryName)->first();
                if($category) {
                  $posts = $category->posts()->paginate(5)->withQueryString();
                } else {
                    return redirect('/admin/posts')->with('message', 'There is no post for this labels');
                }
            } else if ($authorName = request()->query('author')) {
               $user= User::where('name', $authorName)->get();
               $userId = $user[0]->id;
            $posts = Post::where('user_id', $userId)->paginate(5)->withQueryString();
            } else if ($sortBypar = request()->query('sortBy')) {
                if ($sortBypar == 'title') {
                    $posts = Post::orderBy('title')->paginate(5)->withQueryString();
                } else if ($sortBypar == 'created_at') {
                    $posts = Post::orderBy('created_at')->paginate(5)->withQueryString();
                } else if ($sortBypar == 'user_id'){
                    $posts = Post::orderBy('user_id')->paginate(5)->withQueryString();
                }
            } else {
                $posts = Post::where('user_id', auth()->id())->orderBy('id', 'desc')->paginate(5)->withQueryString(); 
            }      
        }
      ;  
       
        $authors = User::whereIn('role_as', [1,2])->get();
        $categories = Category::orderBy('id', 'desc')->get();
        $post = Post::findOrFail($id);
        $oldCategoryId = $post->categories->pluck('id')->toArray();
        return view('admin/label/create', compact('posts', 'categories', 'authors', 'post', 'oldCategoryId'));
    }

    public function store(Request $request, $id)
    {   
        $post= Post::findOrFail($id);
        if($request->add_label == "new_label") {
            Category::updateOrCreate([
                'name' => $request->name,
            ]);
            $categoryId = Category::orderBy('id', 'desc')->limit(1)->pluck('id')->toArray();
            $post->categories()->attach($categoryId);
        } elseif ($request->add_label == 'existing_label') {      
                $post->categories()->sync($request->categoryIds);
        }

        return redirect('/admin/posts')->with('message', 'A label is created successfully');
    }
}
