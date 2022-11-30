<?php

namespace App\Http\Controllers\admin;

use App\Models\Post;
use App\Models\User;
use App\Models\Slider;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Requests\PostStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Author;
use Laravel\Ui\Presets\React;
use Mockery\Generator\StringManipulation\Pass\Pass;

// use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
        return view('admin.posts.index', compact('posts', 'categories', 'authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $sliders = Slider::orderBy('id', 'desc')->get();
        $categories = Category::orderBy('id', 'desc')->get();
        $user = User::orderBy('id', 'desc')->where('role_as', '1')->get();
        return view('admin.posts.create', compact('user', 'categories', 'sliders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
       $post =  Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'slider_id' => $request->slider_id,
            'user_id' => $request->user_id,
            'author_id' => auth()->user()->author->id,
        ]);

        $categoryIds = $request->categoryIds;
        $post->categories()->attach($categoryIds);

        if($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time(). '_'. $file->getClientOriginalName();
            $dir = public_path('images');
            $file->move($dir,$filename);
          // Image upload to images table 
           
          $post->images()->create([
            'path' =>  $filename,
           ]);
           }

        return redirect('/admin/posts', )->with('message', 'A post is created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   

        $posts = Post::findOrFail($id);
        return view('admin.posts.show', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $post = Post::findOrFail($id);
        $oldcategory = $post->categories->pluck('id')->toArray();
        $categories = Category::orderBy('id', 'desc')->get();
        $user = User::orderBy('id', 'desc')->where('role_as', '1')->get();
        return view('admin.posts.edit', compact('post', 'user', 'categories', 'oldcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time(). '_'. $file->getClientOriginalName();
            $dir = public_path('images');
            $file->move($dir,$filename);

              
                $post->images()->delete();

        //   unlink(public_path($post->path));
           
          $post->images()->create([
            'path' => $filename,
           ]);
           }
       
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        $categoryId = $request->categoryIds;
        $post->categories()->sync($categoryId);

        return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect('/admin/posts');
    }
}
