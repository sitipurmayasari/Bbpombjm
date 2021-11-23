<!DOCTYPE html>
<html lang="en">
<head>
    <title>BBPOM Banjarmasin</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	  <meta charset="utf-8" />
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="{{asset('assets/css/material.css')}}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
      .container .carousel{
          height: 100vh;
          width: 100%;
          overflow:hidden;
      }
      .carousel .carousel-inner {
          height:100%;    
      }

      .carousel .carousel-inner img {
          display:block;
          object-fit: cover;
      }
    </style>
</head>
<body>

<div class="container">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    {{-- <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol> --}}

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        @include('carousel.partials.perjadin')
      </div>
      <div class="item">
        @include('carousel.partials.peminjamankendaraan')
      </div>
      @if ($annc != null)
        <div class="item">
          @include('carousel.partials.announcement')
        </div>
      @endif
      
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>


<script>
    $(document).ready(function() {
        $('.carousel').carousel({
            interval: 1500
        })


    });
</script>

</body>
</html>