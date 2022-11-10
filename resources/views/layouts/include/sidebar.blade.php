<style>
   .sidebar ul {
      list-style: none;
      line-height: 40px;
      font-size: 14px
   }
   .sidebar ul li:hover {
      color: white;
   }
</style>
<div class="author-img d-flex my-3 justify-content-around">
  @if(auth()->user()->images()->exists())
  <img src="/images/{{auth()->user()->images()->first()->path}}" alt="" id ="profile" class="ms-3"  >
  @else 
      @if (auth()->user()->gender == 'M') 
        <img src="/images/male.png" alt="" class="me-3" id ="profile"> 
      @else 
        <img src="/images/female.png" alt="" class="me-3" id ="profile"> 
      @endif
  @endif
    <small class="mt-3 text-white">
      <b> <a href="/admin/profile" class="text-decoration-none text-white" style="text-transform: capitalize"> {{auth()->user()->name}}</a></b>
    </small>
    <span><i class="fa-solid fa-magnifying-glass ms-3 mt-4"></i></span>
</div>

<div class="sidebar">
  <ul>
    <li> <a href="/dashboard"class="text-decoration-none text-white text-muted"><i class="fa-solid fa-house-chimney me-3"></i></i> Dashboard</a> </li>
    <li><a href="/"class="text-decoration-none text-white text-muted"> <i class="fa-solid fa-dumpster me-3"></i> View Site </a> </li>
    <li class="ms-3 mt-2 my-2"> <a href="/admin/posts/create" class="btn btn-outline-light rounded"> <i class="fa-solid fa-plus me-3"></i> New Post </a> </li>
    <li><a href="/admin/posts"class="text-decoration-none text-white text-muted"> <i class="fa-regular fa-newspaper me-3"></i> Post </a> </li>
    <li> <i class="fa-solid fa-hourglass-half me-3"></i> Drafts </li>
    @if (auth()->user()->role_as != 2)
    <li> <a href="/admin/user"class="text-decoration-none text-white text-muted"> <i class="fa-solid fa-user me-3"></i> Add User  </a> </li>
    @endif
    <li><a href="/admin/comment"class="text-decoration-none text-white text-muted"> <i class="fa-regular fa-comments me-3"></i> Comments </a> </li>
    <li><a href="/admin/slider" class="text-decoration-none text-white text-muted"> <i class="fa-solid fa-image me-3"></i> Slider </a> </li> 
    <li> <a href="/admin/message" class="text-decoration-none text-white text-muted"><i class="fa-solid fa-message me-3"></i> Messages </a> </li>
    <br>
    

    <li> <i class="fa-regular fa-hard-drive me-3"></i> Themes </li>
    <li> <a href="/admin/profile"class="text-decoration-none text-white text-muted"> <i class="fa-solid fa-gear me-3"></i> Setting </a>  </li>
    <li> 
      <a class="text-decoration-none text-white text-muted" href="{{ route('logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        <i class="fa-solid fa-right-from-bracket me-3"></i> Logout     
       </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
    </li>
  </ul>
</div>