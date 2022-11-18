@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<style>
  .viewer {
    border: 2px solid gray;
    width: 300px;
    height: 300px;
    border-radius: 10px
}

.post-show {
  border: 2px solid gray;
  border-radius: 10px
}
.post-show td {
  padding: 10px;
}

.comment {
  border: 2px solid gray;
  border-radius: 10px;
  height: 400px;
}

.platform {
  border: 2px solid gray;
  border-radius: 10px;
  height: 400px;
}

.comment p {
  font-size: 12px;
}

.platform i {
  font-size: 30px;
  border: 1px solid gray;
  border-radius: 5px;
  padding: 10px;
}
</style>

  <h3 class="text-white ms-3 mt-3"> Dashboard </h3>
        
                      @if (session('status'))
                        <div class="alert alert-success ms-3 me-3" role="alert">
                           <h2>  {{ session('status') }} {{auth()->user()->name}}</h2>
                        </div>
                    @endif
   <div class="row">
    <div class="col-md-7">
      <small class="ms-3"> Total Viewer </small>
      <div>
        <canvas id="myChart"></canvas>
      </div>
    </div>
    <div class="col-md-5 mt-2">
        <div class="viewer">
          <p class="text-center my-3"> Your Current Stats </p>
          <div class="row">
            <div class="col-md-6">
             <div class="ms-3 mb-2 border-end border-light">
              <small> Total Views </small>
            <h3> {{$views}}</h3> 
             </div>
             <div class="ms-3 mt-4 border-end border-light">
              <small> Posts Made </small>
              <h3>{{$post_count}}</h3>
             </div>
             <div class="ms-3 mt-4">
              <small> Total Comments  </small>
              <h3> {{count($comments)}} </h3>
             </div>
            </div>
            <div class="col-md-6">
              <div class="ms-3">
                <small> Monthly Increase  </small>
                <div class="d-flex">
                  <h3> 244 </h3> 
                <span class="text-success ms-2 mt-2"> <small>  <i class="fa-solid fa-arrow-up"></i> 2.3%</small></span>
                </div>
               </div>
               <div class="ms-3 mt-3">
              <small>  Average Post View  </small>
              <h3> 
                @if ($post_count > 0) 
                {{$post_count / count($posts)}} 
                @endif
              </h3>
             </div>
            </div>
          </div>
        </div>
    </div>
   </div>
   <div class="row my-4">
    <div class="col-md-5 ms-3 me-2">
      <div class="post-show">
       <div class="mx-2 my-2">
        <h5> Post Ranking </h5>
        @if ($posts->count() > 0)
        <table class="text-white ms-5 mt-3 me-2">
          <thead>
            <tr>
              <th> Rank </th>
              <th> Post Title </th>
              <th> View </th>
            </tr>
          </thead>
          <tbody>
            @forelse ($posts as $post)
            <tr>
              <td> {{$post->id}}</td>
              <td> 
                <div class="d-flex">
                  @if(!$post->images()->exists()) 
                  <img src="/images/login.png" alt="" width="50px" height="50px">
                  @else 
                  <img src="/images/{{$post->images[0]->path}}"  width="50px" height="50px" alt="">
                  @endif
                  <p class="ms-3">{{$post->title}}</p>
                </div>
              </td>
              <td>
                {{$post->views->count()}}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @else
        <h3 class="text-danger"> No Post have been made </h3>
        @endif
       </div>
      </div>
    </div>
    <div class="col-md-3 comment">
      <div class="mx-2 my-2">
        <h5> Latest Comments </h5>     
          @if ($comments->count() > 0)
          @foreach ($comments as $comment)
          <div class="my-3">
            <small> </small>
            <p> {{$comment->body}} </p>
            <div class="d-flex justify-content-between">
                <p> {{$comment->name}} </p>
                <small> {{$comment->created_at}} </small>
            </div>
          </div>
          <hr> 
       @endforeach 
          @endif        
      </div>     
    </div>

    <div class="col-md-3 platform ms-3">
      <div class="mx-2 my-2">
        <div class="d-flex justify-content-between">
          <h5> Platforms </h5>
          <small> Last 7 days <span><i class="fa-solid fa-sort-down ms-2" style="font-size: 10px; border:none; padding:0px"></i></span></small>
        </div>
        <div class="my-3">
          <div class="d-flex">
            <span><i class="fa-solid fa-desktop my-3"></i></span> 
            <small class="ms-2 mt-3"> Desktop </small>
            <span> {{$window}}</span>
          </div>
          <hr>
          <div class="d-flex">
            <span><i class="fa-solid fa-mobile-screen-button my-3"></i></span> 
            <small class="ms-2 mt-3"> Mobile  
            </small>
            <span> {{$mobile}}</span>
          </div> <hr>
          <div class="d-flex">
            <span><i class="fa-solid fa-tablet my-3"></i></span>
            <small class="ms-2 mt-3">  Tablet  </small>
          </div>
        </div>
      </div>
    </div>
   </div>

   <script>

const myChart = document.getElementById('myChart').getContext('2d')
const labels = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
  ];

const chart = new Chart(myChart, {
    type : 'bar',
    data : {
        labels: labels,
        datasets: [{
            label : 'Viewer',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [0, 10, 5, 2, 20, 30, 45],
        }]
    },
})
  
  </script>
@endsection