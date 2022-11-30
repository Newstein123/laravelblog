
@extends('layouts.admin')
@section('title', 'Label')
@section('content')
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                           <h2>  {{ session('message') }} </h2>
                        </div>
                    @endif

              <div class="container">
                <h3 class="mt-3 ms-2"> Manage Your Posts Here </h3>
                <div class="row justify-content-center align-items-center">
                
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
                 <div class="col-md-6 mt-3 shadow-lg p-4">
                    <h5> Add label on:</h5>
                    <p> {{$post->title}}</p> 
                    <form action="/admin/label/{{$post->id}}" method="POST" class="mt-3">
                      @csrf
                      <input type="hidden" name="post_id">
                      <input  onchange="newLabel(true)" type="radio" name="add_label" id="" value="new_label">

                      <small> <b> Add New Label </b> </small> <br>
                        <input type="text" name="name" placeholder="Add new label" style="display: none" id="new_label" class="form-control my-3" >

                        <input onchange="newLabel(false)" type="radio" name="add_label" value="existing_label"  checked id="">

                        <small> <b> Select From Existing Label </b></small>
                        <select id="category_ids" class="form-control selectpicker my-3 d-block" name="categoryIds[]" multiple data-live-search= 'true'> 
                          @foreach ($categories as $category)        
                            <option value="{{$category->id}}"
                              @if(in_array($category->id, old('categoryIds', $oldCategoryId)))
                              selected 
                              @endif
                              > {{$category->name}}
                            </option>
                            @endforeach
                          </select> 
                          <button type="submit" class="btn btn-outline-light btn-sm"> Add Now </button>
                        
                    </form>

                 </div>
                </div>
              </div>
          

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

              const show_me = document.getElementById('new_label');
              const hide_me = document.querySelector('#category_ids');
 
              newLabel = (e) => { 
                show_me.style.display = e? 'block': 'none';
                hide_me.style.display = 'none'
              }

              </script>
@endsection

