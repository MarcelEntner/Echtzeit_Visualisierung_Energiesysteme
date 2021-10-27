<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Energiesysteme - Home</title>
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            .nav-item
            {
              font-size: 25px;
              padding-left: 20px;
              padding-right: 20px;
            }

            .navbar-brand
            {
                font-size: 30px;
                color:#21A500;
            }

            .navbar-brand:hover
            {
              color:green;
            }

            #gallog
            {
                padding-left: 900px;
            }

            .nav-link
            {
                color:#21A500;
            }
            .nav-link:hover
            {
                color:green;
            }

            .footercontext
            {
              color:#21A500;
              padding-right: 10%;
            }

            .footercontext:hover
            {
              color:green;
            }

            .Beitrag
            {
              
              border: 1px solid #21A500;
              border-radius: 15px;
              padding: 20px;
              margin: 70px;
              height:200px;
            }

            .picture
            {
              height: 300px;
              width: 1800px;
              border-radius: 15px;
            }

            #carouselExampleControls
            {
              border: 1px solid black;
              border-radius: 15px;
              margin: 30px;
            }


            .carousel-control-prev-icon, .carousel-control-next-icon 
            {
               height: 75px;
               width: 75px;
               color: black;
            }

            </style>

    </head>
    <body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <!-- Container wrapper -->
    <div class="container-fluid">
      <!-- Toggle button -->
      <button
        class="navbar-toggler"
        type="button"
        data-mdb-toggle="collapse"
        data-mdb-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <i class="fas fa-bars"></i>
      </button>
  
      <!-- Collapsible wrapper -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Navbar brand -->
        <a class="navbar-brand mt-2 mt-lg-0" href="{{ route('lp') }}">
          <img
            src="{{ URL::to('/images/logo.jpg') }}"
            height="40"
            alt=""
            loading="lazy"
          />
        </a>

        <a class="navbar-brand" href="{{ route('lp') }}">MicroGridLab</a>
        <!-- Left links -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('lp') }}"><b><u> Home</b></u></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('kd') }}">Energiesysteme</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('gal') }}">Galerie</a>
          </li>
         
          @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a id="gallog"class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @endguest
        </ul>
        
      </div>
    </div>
  </nav>

<!-- Content -->


<!-- Carousel -->


<div id="carouselExampleControls" class="carousel slide" >
  <div class="carousel-inner">

    <div class="carousel-item active">
      <img class="picture" src="/images/windrad.jpg" alt="First slide">
    </div>

    <div class="carousel-item">
      <img class="picture" src="/images/pv.jpg" alt="Second slide">
    </div>

    <div class="carousel-item">
      <img class="picture" src="/images/logo.jpg" alt="Third slide">
    </div>

  </div>

  
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon " aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


<!-- Beitrag/Text -->



<div class="Beitrag">

  <h3 style="padding:10px">  Über uns </h3>

  <p style="text-align:center"> 
    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore 
    et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. 
    Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, 
    consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed 
    diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata 
    sanctus est Lorem ipsum dolor sit amet.

  </p>

</div>





<!--Footer-->
<footer class="bg-light text-right text-lg-start pull-right">
   
    <!-- Copyright -->
    <div class="p-3 text-right border border-success fixed-bottom">
      
   
      <a class="footercontext" href="{{ route('impressum') }}">Impressum</a>
      <a class="footercontext" href="{{ route('dsgvo') }}">DSGVO</a>
  
    
  </div>
    <!-- Copyright -->
  </footer>
    </body>
</html>