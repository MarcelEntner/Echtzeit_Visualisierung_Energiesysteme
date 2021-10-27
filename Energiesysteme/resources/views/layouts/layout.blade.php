<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only  Bootstrape-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>@yield('title')</title> <!-- Platzhalter für den Title , Title steht in der Variable title-->
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
            text-decoration: underline ;
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
          width: 1860px;
          border-radius: 15px;
        }

        #carouselExampleControls
        {
          border: 1px solid black;
          border-radius: 15px;
          margin: 30px;
        }


        

        .carousel-control-prev-icon{

            height:75px;
            width: 75px;
           background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23000' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E") !important;

        }

        .carousel-control-next-icon{
            height:75px;
            width: 75px;
           background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23000' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E") !important;

        }

    
        a:hover
        {
            text-decoration: underline;
        }
        .Impressum
        {
            font-size: 15px;
            border: 1px solid #21A500;
            border-radius: 15px; 
            height:70%;
            width: 50%;
            margin:auto;
            text-align: center;
        }

        .ImpressumUberschrieft
        {
            text-align: center;
            color:#21A500;
            
        }
      

        </style>
</head>
<body>
    @section('header')

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
            <!-- <a class="navbar-brand mt-2 mt-lg-0" href=""> -->
                <a class="navbar-brand mt-2 mt-lg-0" href="{{ route('hp') }}">
              <img
                src="{{ URL::to('/images/logo.jpg') }}"
                height="100%"
                width="100%"
                alt=""
                loading="lazy"
              />
            </a>
    
            <a class="navbar-brand" href="{{ route('hp') }}">MicroGridLab</a>
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="{{ route('hp') }}"> Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('es') }}">Energiesysteme</a>
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



       
    
    @show
    

    
    @section('content')
  

    @show



   @section('footer')

   <footer class="bg-light text-right text-lg-start pull-right">
    <div class="p-3 text-right border border-success fixed-bottom">
      
   
      <a class="footercontext" href="{{ route('impressum') }}">Impressum</a>
      <a class="footercontext" href="{{ route('dsgvo') }}">DSGVO</a>
  
    
  </div>
  </footer>

   @show


    
    <!-- JavaScript Bundle with Popper Bootstrap -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>