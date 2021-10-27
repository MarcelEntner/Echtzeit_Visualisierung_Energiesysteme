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

            .footercontext
            {
              color:#21A500;
              padding-right: 10%;
            }

            .footercontext:hover
            {
              color:green;
            }

            .nav-link
            {
                color:#21A500;
            }
            .nav-link:hover
            {
                color:green;
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
            <a class="nav-link" href="{{ route('lp') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('kd') }}">Energiesysteme</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('gal') }}"><b><u> Galerie</b></u></a>
          </li>
          @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a id="gallog"class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @endguest

        </ul>
        <!-- Left links -->
      </div>
      <!-- Collapsible wrapper -->
  
      <!-- Right elements -->
      <div class="d-flex align-items-center">
        <!-- Icon -->
        <a class="text-reset me-3" href="#">
          <i class="fas fa-shopping-cart"></i>
        </a>
      </div>
      <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
  </nav>
 

<h1>This is the galerie</h1>


<div class="card" style="width: 18rem;">
  <img src="/images/pv.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
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