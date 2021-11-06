<html lang="de">
<head>
    <meta charset="UTF-8">
 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only  Bootstrape-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>@yield('title')</title> <!-- Platzhalter für den Title , Title steht in der Variable title-->
    <style>
        .nav-item
        {
          font-size: 25px;
          padding-left: 10px;
          padding-right: 20px;
        }

        .navbar-brand
        {
            font-size: 45px;
            color:#21A500;
            
        }

        .navbar-brand:hover
        {
          color:green;
        }

        #gallog
        {
            padding-left: 650px;
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
          padding: 1%;
          margin-top: 30px;
          margin-left: 5%;
          margin-right:5%;
          height:35%;
        }

        .text
        {
          text-align:center;
          padding-top:20px;
          padding-left:100px;
          padding-right:100px;
        }

        .picture
        {
          height: 300px;
          width: 100%;
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
            padding-top:3%;
        }

        .ImpressumUberschrieft
        {
            text-align: center;
            color:#21A500;
            
        }
        .Dsgvo{
            font-size: 15px;
            border: 1px solid #21A500;
            border-radius: 15px; 
            height:70%;
            width: 50%;
            margin:auto;
            text-align: center;
            padding-top:3%;

        }
        .DsgvoUberschrieft
        {
            text-align: center;
            color:#21A500;
        }

        .logo
        {
          padding-top:5%;
        }


        .Karte
        {
          /*border: 1px solid green;*/
          height: 100%;
          width: 60%;
          margin-left:1%;
          border-radius: 50px; 
        }

        .GoogleMaps
        {
          border-radius: 50px;
        }

        
        .Liste
        {
          border: 1px solid green;
          margin-right:2%;
       
          height: 50%;
          width: 35%;
          border-radius: 50px; 
          float:right;
          margin-top: -40%;
    
        }

        table
        {
          margin-left:5%;
        }


        .Energiesysteme
        {
          height:80%;
          width: 100%;
     


        }
      

     

        #suche
        {
          border: 2px solid #999;
          border-radius: 0.5em;;
          font-size: 1.3em;
          width: 10em;
          transition: width 0.5s ease-in-out;
          margin-top: -11.5%;
          margin-right: 5%;
          float: right;
        }
 
        #suche:focus
        {
          width: 50%;
        }

        .GrafanaBtn
        {
         height: 50px;
         width: 50px; 
         background: url(/images/statistik.png) no-repeat;
         border: none;
        }

        .EditBtn
        {
         height: 50px;
         width: 50px; 
         background: url(/images/delete.png) no-repeat;
         border: none;
        }

        .DeleteBtn
        {
         height: 50px;
         width: 50px; 
         background: url(/images/stift.png) no-repeat;
         border: none;
        }

        .ListeHeader
        {
          font-size: 20px;
         
        }
      

        .dropbtn 
        {
          background-color: #04AA6D;
          color: white;
          padding: 16px;
          font-size: 16px;
          border: none;
          width: 100%;
        }

        .dropdown
        {
          position: relative;
          display: inline-block;
          width: 1000px;
          margin-left: 30%;
          width: 40%;
        }

        .dropdown-content
        {
          display: none;
          position: absolute;
          background-color: #f1f1f1;
          min-width: 160px;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 1;
          width: 100%;
        }

        .dropdown-content a
        {
          color: black;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
          width: 100%;
        }

        .dropdown-content a:hover {background-color: #ddd;}

        .dropdown:hover .dropdown-content {display: block;}

        .dropdown:hover .dropbtn {background-color: #3e8e41;}

        

        .GalerieAnzeige
        {
          border: 3px solid #21A500;
          border-radius: 15px;
          padding: 1%;
          margin-top: 30px;
          margin-left: 5%;
          margin-right:5%;
          height:65%;
          
        }

        .card
        {
            text-align:center;        
            float:left;
            margin-top:2%;
            margin-left: 7%;
            border: 1px solid #21A500;
            border-radius: 5px;
        }

        
      

      /*


      **/

        </style>
</head>
<body>
    @section('header')
<header>
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
                <a class="navbar-brand mt-2 mt-lg-0">
              <img class="logo"
                src="{{ URL::to('/images/logo2.png') }}"
                height="100px"
                width="300px"
                alt="Best GmbHLogo"
                loading="lazy"
              />
            </a>
    
            <a class="navbar-brand">MicroGridLab</a> <!-- Könnte umgeändert werden -> laut Meeting 03.11.2021 -->
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
                    <a id="gallog"class="nav-link" 
    style="cursor: pointer" 
    data-toggle="modal" 
    data-target="#loginModal">{{ __('Login') }}</a>
                  </li>
              @endif


              @else
              <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      {{ Auth::user()->name }}
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>
                  </div>
              </li>




              @endguest

            </ul>
            
            

 




            


          </div>
        </div>
      </nav>
    </header>



       
    
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

    @include('partials.login')
</body>
</html>