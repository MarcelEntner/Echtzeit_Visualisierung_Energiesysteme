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


        .esbutton {
            height: 30px;
            width: 40px;
            background-color: white;
            border: none;
            background-repeat: no-repeat;

        }

        .table:hover a {
            background-color: rgba(33, 165, 0, 0.0001);
        }




        .Searchbutton {
            display: inline-block;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
                border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
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


        .dropbtngalerie {
            background-color: #04AA6D;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            width: 100%;
        }



        .dropdowngalerie {
            position: relative;
            display: inline-block;
            width: 1000px;
            margin-left: 30%;
            width: 40%;
        }

        .dropdowngalerie-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            width: 100%;
        }

        .dropdowngalerie-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            width: 100%;
        }

        .dropdowngalerie-content a:hover {
            background-color: #ddd;
        }

        .dropdowngalerie:hover .dropdowngalerie-content {
            display: block;
        }

        .dropdowngalerie:hover .dropbtngalerie
         {
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
        body{
         overflow:hidden;
        }

     


        /* Flip Chart */

        /* Überschreibung des Bootstrap CSS */
        .btn2 {
            display: inline-block;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
                border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;

            /* Selbst eingefügt */
            height: 30px;
            width: 40px;
            background-color: white;
            border: none;
            background-repeat: no-repeat;
        }

        .btn3 {
            display: inline-block;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
                border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;

            /* Selbst eingefügt */
            margin-left: 27%;
            height: 40px;
            width: 220px;
            background-color: #21A500;
            border: none;
            background-repeat: no-repeat;
        }

        .form-control2 {
            width: 27%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #21A500;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #21A500;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }





        .modal2 {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1055;
            display: none;
            width: 60%;
            height: 100%;
            overflow-x: hidden;
            overflow-y: auto;
            outline: 0;
            margin-left: 350px;
        }

        .modal2-dialog {
            position: relative;
            width: auto;
            margin: auto;
            pointer-events: none;

        }

        .modal2-title {
            margin-bottom: 0;
            line-height: 1.5;
            margin-left: 170px;

        }


        .form-control3 {
            display: block;
            width: 250px;
            padding: 0.375rem 0.75rem;
            text-align: center;
            margin: auto;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: black;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid black;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .marker-position {
            bottom: -30px;
            left: 0;
            position: relative;
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

                        @if (\Request::is('energiesysteme') or \Request::is('EnSys'))
                            <li><b><a href="{{ route('es') }}"
                                        class="nav-link px-2 text-primary fs-4">Energiesysteme</a></b></li>
                        @else
                            <li><a href="{{ route('es') }}" class="nav-link px-2 text-primary fs-4">Energiesysteme</a>
                            </li>
                        @endif

                        @if (\Request::is('galerie') or \Request::is('EnSys/*'))
                            <li><b><a href="{{ route('gal') }}" class="nav-link px-2 text-primary fs-4">Galerie</a></b>
                            </li>
                        @else
                            <li><a href="{{ route('gal') }}" class="nav-link px-2 text-primary fs-4">Galerie</a></li>
                        @endif


                    </ul>


                    <div class="nav-link px-2 text-primary fs-4">
                        @guest
                            @if (Route::has('login'))
                                <button type="button" class="btn text-primary fs-4" data-toggle="modal"
                                    data-target="#loginModal">{{ __('Login') }}</button>
                            @endif
                        @else
                            <div class="nav-item dropdown text-primary">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-primary" href="#" role="button"
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
                            </div>
                        @endguest
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
