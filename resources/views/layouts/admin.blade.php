<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield('title')</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" ></script>
	{{-- custom css  --}}
	<link rel="stylesheet" href="{{asset('css/custom.css')}}">
	<link rel="stylesheet" href="{{asset('js/script.js')}}">

	{{-- text editor  --}}

	<link rel="stylesheet" href="{{asset('css/jquery.cleditor.css')}}" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  	<script type="text/javascript" src="{{asset('js/jquery.cleditor.js')}}"></script>
  	<script>
      $(document).ready(function () { $("#body").cleditor({
		width: 680, 
        height: 300,
		margin: 5,
	  }); });
  	</script>
</head>
<body>
	<div class="container-fluid">
		<div class="row g-0">
			<div class="col-md-2 bg-dark text-white text-muted border border-end-white">
				@include('layouts.include.sidebar')
			</div>	<!-- Wrapper -->	
			<main class="col-10 bg-dark text-white"> <!-- Main (Top Nav & Content) -->
				<div class="container-fluid mt-0  bg-dark"> <!-- Content -->
       				 @yield('content')
      			</div> <!-- Content -->
    		<!-- Wrapper ends -->
			</main>
			<footer class="text-center py-4 text-muted">
				&copy; Copyright <span> <img src="/images/blog-logo.png" alt="" width="70px"></span> ewstein2020
			</footer>
		</div>
	</div>
	
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
</body>
</html>
