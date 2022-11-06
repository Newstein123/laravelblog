<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Post;
use App\Models\View;
use App\Models\Device;
use App\Models\Slider;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Support\Arr;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class FrontendController extends Controller
{  


   

    public function index(Request $request)
    {   
            
            $categories = Category::orderBy('id', 'desc')->limit(5)->get();
            $second_categories = Category::orderBy('id', 'desc')->offset(5)->limit(10)->get();
            $agent = new Agent();
            $device = $agent->platform();
            $ip_address = $request->ip();
            $location = Location::get('204.156.120.160');
            $countryName = $location->countryName;
            $cityName = $location->cityName;

            if(auth()->user()) {
                Device::updateOrCreate([
                    'device_name' => $device,
                    'ip_address' => $ip_address,
                    'country_name' => $countryName ?? "Myanmar",
                    'city_name' => $cityName ?? 'Yangon',
                    'user_id' => auth()->id(),
                ]);
            } else {
                Device::updateOrCreate([
                    'device_name' => $device,
                    'ip_address' => $ip_address,
                    'city_name' => $cityName ?? 'Yangon',
                    'country_name' => $countryName ?? 'Myanmar',
                    'user_id' => null,
                ]);
            }

            if($search = $request->input('search')) {  
                $posts = Post::latest('id')->where('title', 'like', "%$search%" )->paginate(5)->withQueryString();        
                return view('frontend/posts/search', compact('posts', 'categories', 'second_categories'));
            } else {
                $posts = Post::all();
                $array = [];
                foreach($posts as $post) { 
                    if($post->views->count() != 0) 
                    $array = Arr::add($array, $post->id , $post->views->count());
                }
                
                $trendingNews = [];
                    foreach($array as $postId => $count)  {
                        if($count > 30) {
                            $view_counts = Post::orderBy('id', 'desc')->where('id', $postId)->get();
                          array_push($trendingNews, $view_counts);
                        }
                    }

                $postone = Post::orderBy('id','desc')->limit(1)->get();
                $midposts = Post::orderBy('id','desc')->offset(1)->limit(4)->get();
                $allposts = Post::orderby('id', 'desc')->offset(5)->limit(30)->get();
                return view('frontend/posts/index', compact('trendingNews', 'postone', 'midposts', 'allposts', 'categories', 'second_categories'));
            }
            
           
      
    }

    public function show(Request $request, $id)
    {   
        $categories = Category::orderBy('id', 'desc')->limit(5)->get();
        $second_categories = Category::orderBy('id', 'desc')->offset(5)->limit(10)->get();
        if($search = $request->input('search')) {  
            $posts = Post::latest('id')->where('title', 'like', "%$search%" )->paginate(5)->withQueryString();        
            return view('frontend/posts/search', compact('posts', 'categories', 'second_categories'));
        }
        $posts = Post::all();
        $array = [];
        foreach($posts as $post) { 
            if($post->views->count() != 0) 
            $array = Arr::add($array, $post->id , $post->views->count());
        }

        $trendingNews = [];
            foreach($array as $postId => $count)  {
                if($count > 30) {
                    $view_counts = Post::orderBy('id', 'desc')->where('id', $postId)->get();
                  array_push($trendingNews, $view_counts);
                }
            }
        $post = Post::findOrFail($id);
        // $author_posts = Post::where('user_id', $post->user->id)->pluck('id')->toArray();
        // // dd($author_post);
        // while($author_posts) {
        //     $comment = Comment::where('post_id', $author_posts)->get();
        //     dd($comment);
        //    $comment_count = count($comment);
        //     dd($comment_count);
        // }
       
        $view_count = View::updateOrCreate([
            'post_id' => $post->id,
            'views' => $request->getClientIp()
        ]);

        $article_count = Post::where('user_id', $post->user->id)->count();
        $comments = Comment::where('post_id', $id)->get();
        $comment = Comment::all();
        $midposts = Post::orderBy('id','desc')->offset(1)->limit(4)->get();
        $category = $post->categories[0]->name;
        
        $category = Category::where('name', $category)->first();

        if($category) { 
            $posts = $category->posts()->get();
        }
        

        return view('frontend/posts/show', compact('post','posts', 'comments',  'comment', 'categories', 'second_categories', 'article_count', 'view_count', 'trendingNews', 'midposts'));
    }

    public function label(string $category)
    {   
        
        $categories = Category::orderBy('id', 'desc')->limit(5)->get();
        $second_categories = Category::orderBy('id', 'desc')->offset(5)->limit(10)->get();

        $category = Category::where('name', $category)->first();

        if($category) { 
            $posts = $category->posts()->get();
                return view('frontend/category/label', compact('posts', 'category','categories', 'second_categories')); 
        } else {
            return redirect('/');
        }
    }

   

}
