<div class="trending">
    <h3 class="mt-2"> Trending News </h3>
        @foreach ($trendingNews as $posts)
        @foreach ($posts as $post)
            
        <hr>
        <p> <a href="/post/{{$post->id}}" class="btn-link"> {{$post->title}}</a></p>
      
        <div class="d-flex justify-content-between">
            @foreach ($post->categories as $category)
                {{$category->name}}                  
            @endforeach
            <small> {{$post->created_at->diffForHumans()}}</small>
        </div>
        <hr>
        @endforeach
        @endforeach
</div>