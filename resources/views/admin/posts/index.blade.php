
@extends('layouts.admin')
@section('content')
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                           <h2>  {{ session('message') }} </h2>
                        </div>
                    @endif

              <div class="container">
                <h3 class="mt-3 ms-2"> Manage Your Posts Here </h3>
                <div class="row">
                
                 <div class="col-md-12">
                     <nav class="float-end">
                         <ul class="ms-3 me-3 text-muted"> 
                          <li> All Posts  <i class="fa-solid fa-chevron-down ms-1" id="allPost"></i>
                        <div class="allPost">
                           <a href="/admin/posts?name=name" class="text-decoration-none text-white"> All Posts </a> <br>
                           <a href="/admin/posts" class="text-decoration-none text-white"> Your Posts </a>
                        </div>
                        </li>
                          <li> All Labels <i class="fa-solid fa-chevron-down ms-1" id= "labels"></i>
                                <div class="labels">
                                    <ul> 
                                        <li> <a href="/admin/posts"> All Labels </a> </li>
                                    @foreach ($categories as $category)
                                        <li> <a href="/admin/posts?category={{$category->name}}"> {{$category->name}}</a> </li>
                                    @endforeach
                                    </ul>
                                </div>
                            </li>
                            <li> All Authors
                             <i class="fa-solid fa-chevron-down ms-1" id="authors"></i> 
                            <div class="authors">
                                <ul>
                                    @foreach ($authors as $author)
                                    <li> <a href="/admin/posts?author={{$author->name}}"> {{$author->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            </li>
                          <li> Sort By Name 
                            <i class="fa-solid fa-chevron-down ms-1" id="sortBy"></i> 
                            <div class="sortBy">
                                <ul>
                                    <li> <a href="/admin/posts?sortBy=title"> Sort By Title </a>
                                    </li>
                                    <li> <a href="/admin/posts?sortBy=created_at"> Sort By Time  </a> </li>
                                    <li><a href="/admin/posts?sortBy=user_id"> Sort By Author </a> </li>
                                </ul>
                            </div>
                            </li>
                          <li> <a href="/admin/posts/create" class="btn btn-secondary btn-sm"> Add Post </a> </li>
                         </ul>
                     </nav>
                 </div>
                @if (count($posts) > 0)
                <div class="col-md-12">
                    @foreach ($posts as $post)
                        <div class="card mb-3 bg-secondary m-2">
                            <div class="row g-0">
                              <div class="col-md-2">
                               @if ($post->images()->exists())
                               <a href="/admin/posts/{{$post->id}}/edit" class="text-decoration-none text-white"> <img src="/images/{{$post->images()->first()->path}}" class="rounded-start m-2" alt="..." width="100px" height="100px"></a>
                               @else
                                   <img src="/images/1663000522_1612562486_Tom-Holland-Uncharted-Movie-Has-The-Greatest-Action-Scenes-Of-1024x576.jpg" alt="" width="100px" height="100px" class="rounded-start m-2">
                               @endif
                              </div>
                              <div class="col-md-4">
                                <div class="card-body">
                                  <p class="card-title"> {{$post->title}}</p>
                                  <small class="card-text"> published: {{$post->created_at->diffForHumans()}}</small>
                                </div>
                              </div>
                              <div class="col-md-6">
                                    <div class="float-end nav-bar"> 
                                      <div class="top-icon">
                                        <ul>
                                            <li> <i class="fa-sharp fa-solid fa-upload"></i> </li>
                                            <li> 
                                                <a href="/admin/label/{{$post->id}}/create" class ="text-decoration-none text-white"> 
                                                <i class="fa-solid fa-tag"></i>  </a>
                                            <span class="tag"> Add Labels </span>
                                            </li> 
                                            <li>
                                                <form action="/admin/posts/{{$post->id}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure to delete')" class="btn btn-secondary"> <i class="fa-solid fa-trash"></i></button>
                                                </form> 
                                            </li>
                                            <li> <div class="d-flex">
                                                 <span>{{$post->views->count()}} </span> 
                                                 <i class="fa-regular fa-eye ms-2 mt-2"></i>   
                                            </div></li>
                                            <li> <small> {{$post->user->name}}</small> <img src="/images/avatar.png" alt="" width="30px" height="30px" style="border-radius: 30px"></li>
                                        </ul>
                                      </div>
                                        <div class="share">
                                            <ul>
                                                <li> <i class="fa-solid fa-share"></i> </li>
                                                <li> <span>
                                                     <i class="fa-regular fa-comment"></i> 
                                                    {{$post->comments->count()}}
                                                </span></li>
                                                <li> <i class="fa-solid fa-chart-simple"></i> </li>
                                            </ul>
                                        </div>
                                    </div>
                              </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @else
                    <div class="d-flex justify-content-center">
                        <h3 class="text-danger"> No Post had been made </h3>
                    </div>
                @endif
                </div>
              </div>
              {{$posts->links()}}

              <script>  
              const arrowClick = document.getElementById("allPost");
              allPost.onclick = () => {
                allPost.classList.toggle('active')
                document.querySelector(".allPost").classList.toggle("active");
              }

              const labels = document.getElementById('labels');
              labels.onclick = () => {
                labels.classList.toggle('active')
                document.querySelector(".labels").classList.toggle("active");
              }

              const authors = document.getElementById('authors');
              authors.onclick = () => {
                authors.classList.toggle('active')
                document.querySelector(".authors").classList.toggle("active");
              }
              
              const sortBy = document.getElementById('sortBy');
              sortBy.onclick = () => {
                sortBy.classList.toggle('active')
                document.querySelector(".sortBy").classList.toggle("active");
              }
              </script>
@endsection

