<html lang="de">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only  Bootstrap-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>@yield('title')</title> <!-- Platzhalter für den Title , Title steht in der Variable title-->
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .nav-item {
            font-size: 25px;
            padding-left: 10px;
            padding-right: 20px;
            overflow: hidden;
            /* background-color:black;  Nav-Liste + Login */
        }
       

        .navbar-brand {
            font-size: 45px;
            color: #21A500;
            /* background-color:black; Logo + MicroGridLab*/

        }

        .navbar-brand:hover {
            color: green;
        }

        #gallog {
            padding-left: 650px;
        }

        .nav-link {
            color: #21A500;

        }


        .nav-link:hover {
            color: green;
            text-decoration: underline;
        }

        .footercontext {
            color: #21A500;
            padding-right: 10%;
        }

        .footercontext:hover {
            color: green;
        }

        .Beitrag {

            /*border: 1px solid #21A500;
            border-radius: 15px;*/
            padding: 1%;
            margin-top: 30px;
            margin-left: 5%;
            margin-right: 5%;
        }

        .text {
            text-align: center;
            padding-top: 20px;
            padding-left: 100px;
            padding-right: 100px;
        }

        .picture {
            height: 300px;
            width: 100%;
            border-radius: 15px;
        }

        #carouselExampleControls {
            /*border: 1px solid black;
            border-radius: 15px;*/
            margin: 30px;
        }




        .carousel-control-prev-icon {

            height: 75px;
            width: 75px;
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23000' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E") !important;

        }

        .carousel-control-next-icon {
            height: 75px;
            width: 75px;
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23000' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E") !important;

        }


        a:hover {
            text-decoration: underline;
        }

        .Impressum {
            font-size: 15px;
            /*border: 1px solid #21A500;
            border-radius: 15px;*/
            width: 50%;
            margin: auto;
            text-align: center;
            padding-top: 3%;
        }

        .ImpressumUberschrieft {
            text-align: center;
            color: #21A500;

        }

        .Dsgvo {
            font-size: 15px;
            /*border: 1px solid #21A500;
            border-radius: 15px;*/
            width: 50%;
            margin: auto;
            text-align: center;
            padding-top: 3%;

        }

        .DsgvoUberschrieft {
            text-align: center;
            color: #21A500;
        }

        .logo {
            padding-top: 5%;
        }


        .Karte {
            /*border: 1px solid green;*/
            height: 100%;
            width: 60%;
            margin-left: 1%;
            border-radius: 50px;
        }

        .GoogleMaps {
            border-radius: 50px;
        }

        #map {
            min-height: 400px;
            height: 64vh;
            /*border: 2px black solid;
          height: 100%;
          width: 60%;
          margin-left:1%;
          border-radius: 50px; */
        }


        .esbutton{
            height: 30px;
            width: 40px;
            background-color: white; 
            border:none;
            background-repeat: no-repeat;

        }
        .Liste {
            /*border: 1px solid green;
          margin-right:2%;
       
          height: 50%;
          width: 35%;
          border-radius: 50px; 
          float:right;
          margin-top: -40%;*/

        }

        table {
            margin-left: 5%;

            
        }
        .table:hover .esbutton {
            
            background-color: rgba(33, 165, 0, 0.0001);  
            
        }


        .Energiesysteme {
            /*height:80%;
          width: 100%;
     */


        }



        .GrafanaBtn {
            height: 50px;
            width: 50px;
            background: url(/images/statistik.png) no-repeat;
            border: none;
        }

        .EditBtn {
            height: 50px;
            width: 50px;
            background: url(/images/delete.png) no-repeat;
            border: none;
        }

        .DeleteBtn {
            height: 50px;
            width: 50px;
            background: url(/images/stift.png) no-repeat;
            border: none;
        }

        .ListeHeader {
            font-size: 20px;

        }


        .dropbtn {
            background-color: #04AA6D;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            width: 100%;
        }

        .dropdown {
            position: relative;
            display: inline-block;
            width: 1000px;
            margin-left: 30%;
            width: 40%;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            width: 100%;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            width: 100%;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }



        .GalerieAnzeige {
            /*border: 3px solid #21A500;
            border-radius: 15px;*/
            padding: 1%;
            margin-top: 30px;
            margin-left: 5%;
            margin-right: 5%;
            min-height: 64vh;
        }

        .card {
            text-align: center;
            float: left;
            margin-top: 2%;
            margin-left: 7%;
            /*border: 1px solid #21A500;
            border-radius: 5px;*/
        }



        * {
            padding: 0px;
            margin: 0px;
        }

        .logoStretch {
            width: 100vw;
        }

        @media screen and (min-width: 990px) {
            .logoStretch {
                width: 160px !important;
                height: 60px !important;
            }
        }


        /* Switch Button */

        .switch {
	position: relative;
	display: block;
	vertical-align: top;
	width: 160px;
	height: 30px;
	padding: 3px;
	margin-right:35px;
	background: linear-gradient(to bottom, #eeeeee, #FFFFFF 25px);
	background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF 25px);
	border-radius: 18px;
	box-shadow: inset 0 -1px white, inset 0 1px 1px rgba(0, 0, 0, 0.05);
	cursor: pointer;
	box-sizing:content-box;
}
.switch-input {
	position: absolute;
	top: 0;
	left: 0;
	opacity: 0;
	box-sizing:content-box;
}
.switch-label {
	position: relative;
	display: block;
	height: inherit;
	font-size: 10px;
	text-transform: uppercase;
	border-radius: inherit;
	box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.12), inset 0 0 2px rgba(0, 0, 0, 0.15);
	box-sizing:content-box;
}
.switch-label:before, .switch-label:after {
	position: absolute;
	top: 50%;
	margin-top: -.5em;
	line-height: 1;
	-webkit-transition: inherit;
	-moz-transition: inherit;
	-o-transition: inherit;
	transition: inherit;
	box-sizing:content-box;
}
.switch-label:before {
	content: attr(data-off);
	right: 11px;
	color: #21A500;;
	text-shadow: 0 1px rgba(255, 255, 255, 0.5);
}
.switch-label:after {
	content: attr(data-on);
	left: 11px;
	color: #21A500;;
	text-shadow: 0 1px rgba(0, 0, 0, 0.2);
	opacity: 0;
}
.switch-input:checked ~ .switch-label {
	
	box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), inset 0 0 3px rgba(0, 0, 0, 0.2);
}
.switch-input:checked ~ .switch-label:before {
	opacity: 0;
}
.switch-input:checked ~ .switch-label:after {
	opacity: 1;
}
.switch-handle {
	position: absolute;
	top: 4px;
	left: 4px;
	width: 28px;
	height: 28px;
	background: linear-gradient(to bottom, #FFFFFF 40%, #f0f0f0);
	background-image: -webkit-linear-gradient(top, #FFFFFF 40%, #f0f0f0);
	border-radius: 100%;
	box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
    
    
}
.switch-handle:before {
	content: "";
	position: absolute;
	top: 50%;
	left: 50%;
	margin: -6px 0 0 -6px;
	width: 12px;
	height: 12px;
	background: linear-gradient(to bottom, #eeeeee, #FFFFFF);
	background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF);
	border-radius: 6px;
	box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
}

.switch-input:checked ~ .switch-handle {
	left: 135px;
	box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
}
 
/* Transition
========================== */
.switch-label, .switch-handle {
	transition: All 0.3s ease;
	-webkit-transition: All 0.3s ease;
	-moz-transition: All 0.3s ease;
	-o-transition: All 0.3s ease;
}


/* Flip Chart */

.flip-card {
  background-color: transparent;
  width: 300px;
  height: 200px;
  border: 1px solid #f1f1f1;
  perspective: 1000px; /* Remove this if you don't want the 3D effect */
}

/* This container is needed to position the front and back side */
.flip-card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.8s;
  transform-style: preserve-3d;
}

/* Do an horizontal flip when you move the mouse over the flip box container */
.flip-card:hover .flip-card-inner {
  transform: rotateY(180deg);
}

/* Position the front and back side */
.flip-card-front, .flip-card-back {
  position: absolute;
  width: 100%;
  height: 100%;
  -webkit-backface-visibility: hidden; /* Safari */
  backface-visibility: hidden;
}

/* Style the front side (fallback if image is missing) */
.flip-card-front {
  background-color: #bbb;
  color: black;
}

/* Style the back side */
.flip-card-back {
  background-color: dodgerblue;
  color: white;
  transform: rotateY(180deg);
}


    </style>
</head>

<body>
    @section('header')
        <header class="p-3 text-black">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-between">
                    <div class="d-flex align-items-center justify-content-center logoStretch">
                        <a class="mb-2 mb-lg-0 text-black text-decoration-none">
                            <img class="logo mr-2" src="{{ URL::to('/images/logo2.png') }}" height="60px"
                                width="160px" alt="Best GmbHLogo" loading="lazy" />
                        </a>
                        <p class="px-2 mt-3 fs-3 lh-lg text-primary">MicroGridLab</p> <!-- public/css/app.css-->
                    </div>


                    <ul class="nav col-lg-auto">
                        @if (\Request::is('/'))
                            <li><b><a href="{{ route('hp') }}" class="nav-link px-2 text-primary fs-4">Home</a></b></li>
                        @else
                            <li><a href="{{ route('hp') }}" class="nav-link px-2 text-primary fs-4">Home</a></li>
                        @endif

                        @if (\Request::is('energiesysteme'))
                            <li><b><a href="{{ route('es') }}" class="nav-link px-2 text-primary fs-4">Energiesysteme</a></b></li>
                        @else
                            <li><a href="{{ route('es') }}" class="nav-link px-2 text-primary fs-4">Energiesysteme</a></li>
                        @endif

                        @if (\Request::is('galerie') or \Request::is('EnSys*') )
                            <li><b><a href="{{ route('gal') }}" class="nav-link px-2 text-primary fs-4">Galerie</a></b></li>
                        @else
                            <li><a href="{{ route('gal') }}" class="nav-link px-2 text-primary fs-4">Galerie</a></li>
                        @endif

                        
                        
                    </ul>

                    <div class="text-end">
                        @guest
                            @if (Route::has('login'))
                                <button type="button" class="btn text-primary fs-4" data-toggle="modal"
                                    data-target="#loginModal">{{ __('Login') }}</button>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                               document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </div>
                </div>
            </div>
        </header>






    @show



    @section('content')


    @show



    @section('footer')


        <div class="footer mt-auto">
            <footer class="mt-5 d-flex flex-wrap justify-content-around align-items-center py-3 border border-success">
                <p class="col-md-4 mb-0 text-primary">&copy; 2021 Best GmbH</p>

                <ul class="nav col-md-4 justify-content-end">
                    <li class="nav-item"><a href="{{ route('impressum') }}"
                            class="nav-link px-2 fs-5 text-primary">Impressum</a></li>
                    <li class="nav-item"><a href="{{ route('dsgvo') }}"
                            class="nav-link px-2 fs-5 text-primary">DSGVO</a></li>
                </ul>
            </footer>
        </div>

    @show



    <!-- JavaScript Bundle with Popper Bootstrap -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    @include('partials.login')



</body>

</html>
