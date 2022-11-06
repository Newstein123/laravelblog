<style>
    ul {
        list-style: none;
    }

    ul li {
        text-transform: uppercase
    }

</style>
<div class="f-nav">
    <div class="d-flex justify-content-around">
        <div class="toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="f-toggle text-dark vh-100 shadow-sm">
            <h5 class="my-3"> Label List </h5>
            <div class="row f-category">
                <div class="col">
                    <ul>
                        @foreach ($categories as $category)
                            <li> <a href="/category/{{$category->name}}">{{$category->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col">
                    <ul>
                        @foreach ($second_categories as $category)
                            <li> <a href="/category/{{$category->name}}"> {{$category->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="about-us">
                <h5 class="my-2"> Follow Us </h5>
                <div class="d-flex justify-content-between mt-3">
                    <img src="/images/facebook.png" alt="">
                    <img src="/images/instagram.png" alt="">
                    <img src="/images/linkin.png" alt="">
                    <img src="/images/telegram.png" alt="">
                </div>
            </div>
           
                @if (auth()->user())
                <a class="btn btn-danger text-center btn-sm" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-right-from-bracket me-2"></i>Logout 
                </a>
                <small class="text-muted text-center d-block mt-4"> @2022Newstein</small>

             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                 @csrf
             </form>
                @else
            <div class="d-flex justify-content-between">
                <a href="/login" class="btn btn-primary btn-sm"> Login </a>
                <a href="/register" class="btn btn-primary btn-sm"> Register </a>
            </div>
            @endif
        </div>
        <div>
            <img src="/images/logo.png" alt="" width="70px"> <p class="d-inline"> ewstein</p>
        </div>
        <div class="mt-2">
            <form action="">
                <div class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search"  value="search" name="search" id="search_bar">
                    <button type="submit" class="btn btn-primary" id="search_button"> <i class="bi bi-search" ></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
   // toggle 
let menutoggle = document.querySelector('.toggle');
    menutoggle.onclick = function() {
    menutoggle.classList.toggle('active')
    document.querySelector(".f-toggle").classList.toggle("active");
}
</script>