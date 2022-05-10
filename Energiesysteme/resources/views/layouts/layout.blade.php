<html lang="de">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only  Bootstrap-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


    <!-- Schriftart -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Smooch+Sans:wght@700&display=swap" rel="stylesheet">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hubballi&display=swap" rel="stylesheet">


    <title>MicroGridLab | @yield('title')</title> <!-- Platzhalter für den Title , Title steht in der Variable title-->
    <style>
        * {
            padding: 0px;
            margin: 0px;
            font-family: Hubballi, cursive;
            font-weight: 500;
            font-size: 20px;
        }


        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: Hubballi, cursive;

        }

        /* Footer */
        .footercontext {
            color: #1b8836;
            padding-right: 10%;
        }

        .footercontext:hover {
            color: lightgreen;
        }

        /* Div auf HomePage mit Text */
        .Beitrag {
            padding: 1%;
            margin-top: 30px;
            margin-left: 5%;
            margin-right: 5%;
        }

        /*  Text des Div Beitrag auf HomePage  */
        .text {
            text-align: center;
            padding-top: 20px;
            padding-left: 100px;
            padding-right: 100px;
        }

        /*  Bilder auf HomePage der Bilder-Show  */
        .picture {
            height: 100%;
            width: 100%;
            border-radius: 30px;
        }

        /*  Bilder-Show  */
        #carouselExampleControls {
            height: 50%;
            width: 85%;
            margin-left: 7%;
            border-radius: 40px;

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

        /*  Header */
        a:hover {
            text-decoration: underline;
        }

        /*  Für die Icons in der Liste */
        .table:hover a {
            background-color: rgba(33, 165, 0, 0.0001);
        }


        .Impressum {
            font-size: 15px;
            width: 50%;
            margin: auto;
            text-align: center;
            padding-top: 3%;

        }

        .ImpressumUberschrieft {
            text-align: center;
            color: #1b8836;
        }

        .Dsgvo {
            font-size: 15px;
            width: 50%;
            margin: auto;
            text-align: center;
            padding-top: 3%;
        }

        .DsgvoUberschrieft {
            text-align: center;
            color: #1b8836;
        }

    

        /*  Google-Map auf der Energiesysteme Seite  */
        #map {
            min-height: 400px;
            height: 64vh;
        }

        /*  Drop-Down Liste Button bei der Galerie  */
        .dropbtngalerie {
            background-color: #1b8836;
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

        .dropdowngalerie:hover .dropbtngalerie {
            background-color: #1b8836;
        }

        /*  Div wo die Bilder angezeigt werden  */
        .GalerieAnzeige {
            padding: 1%;
            margin-top: 30px;
            margin-left: 5%;
            margin-right: 5%;
            min-height: 64vh;
        }

        /*  Rahmen/Card-Aufbau der Bildergalerie  */
        .card {
            text-align: center;
            float: left;
        }

        /* Überschreibung des Bootstrap CSS */
        .btn2 {
            display: inline-block;
            font-weight: 400;
            line-height: 1.5;
            color: #1b8836;
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
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out;
            border-color 0.15s ease-in-out,
            box-shadow 0.15s ease-in-out;

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
            color: #1b8836;
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
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out;
            border-color 0.15s ease-in-out,
            box-shadow 0.15s ease-in-out;

            /* Selbst eingefügt */
            margin-left: 27%;
            height: 40px;
            width: 220px;
            background-color: #1b8836;
            border: none;
            background-repeat: no-repeat;
        }


        /* Pop-Ups */
        .modal2 {
            position: fixed;
            z-index: 1055;
            display: none;
            height: 100%;
            overflow-x: hidden;
            overflow-y: auto;
            outline: 0;
        }

        .modal2-dialog {
            position: relative;
            margin: auto;
            pointer-events: none;
        }

        .modal2-title {
            margin-bottom: 0;
            line-height: 1.5;
            margin-left: 170px;
        }

        /* Input-Felder bei den Pop-Ups */
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

        /* Label/Text unter den Icons */
        .marker-position {
            bottom: -30px;
            left: 0;
            position: relative;
        }

        /* Addresssuchfeld */
        #find {
            width: 20%;
            margin-bottom: 1%;
            height: 40px;
            text-align: center;
        }

        /* Addresssuchfeld */
        #address {
            width: 50%;
            margin-bottom: 3%;
            height: 40px;
        }

        /* Falls Scrollbalken hier sind, sind sie nicht zu sehen */
        body::-webkit-scrollbar {
            display: none;
        }

        .modal2::-webkit-scrollbar {
            display: none;
        }

        /* Bildergalerie: Hover beim Bild */
        #card {
            transition: transform 0.7s;
        }

        #card:hover {
            transform: scale(1.1, 1.1);
        }

        #tableUsers {

            width: 70%;
            height: 500px;
            margin: auto;
        }

    </style>
</head>

<body>
    @section('header')
        <header class="p-3 text-black">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-around">
                    <div class="d-flex align-items-center justify-content-center logoStretch">
                        <a class="mb-2 mb-lg-0 text-black text-decoration-none">
                            <img class="logo mr-2" src="{{ URL::to('/images/logo2.png') }}" height="60px"
                                width="160px" alt="Best GmbHLogo" loading="lazy" />
                        </a>
                        <p class="px-2 mt-3 fs-3 lh-lg text-primary">MicroGridLab</p> <!-- public/css/app.css-->
                    </div>

                    <ul class="nav col-lg-auto text-center">
                        @if (\Request::is('/'))
                            <li><a href="{{ route('hp') }}" class="nav-linkused px-2 text-primary fs-4 ">Home</a></li>
                        @else
                            <li><a href="{{ route('hp') }}" class="nav-link px-2 text-primary fs-4">Home</a></li>
                        @endif

                        @if (\Request::is('energiesysteme') or \Request::is('EnSys'))
                            <li><a href="{{ route('es') }}" class="nav-linkused px-2 text-primary fs-4">Energiesysteme</a>
                            </li>
                        @else
                            <li><a href="{{ route('es') }}" class="nav-link px-2 text-primary fs-4">Energiesysteme</a>
                            </li>
                        @endif

                        @if (\Request::is('galerie') or \Request::is('EnSys/*'))
                            <li class="me-lg-5 me-md-0"><a href="{{ route('gal') }}" class="nav-linkused px-2 text-primary fs-4">Galerie</a></li>
                        @else
                            <li class="me-lg-5 me-md-0"><a href="{{ route('gal') }}" class="nav-link px-2 text-primary fs-4">Galerie</a></li>
                        @endif

                        <li class="ms-lg-5 ms-md-0">
                        
                            @guest
                                @if (Route::has('login'))
                                    <button type="button" class="btn text-primary fs-4" data-toggle="modal"
                                        data-target="#loginModal">{{ __('Login') }}</button>
                                        <!-- Automatisch öffnen bei fehlgeschlagen -->
                                        @if (count($errors) > 0)
                                        <script>
                                            $( document ).ready(function() {
                                                $('#loginModal').modal('show');
                                            });
                                        </script>
                                    @endif
                                @endif
                            @else
                                <div class="nav-item dropdown text-primary">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-primary fs-4" href="#"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                                                                                       document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>

                                        <?php
                                        $userID = Auth::user();
                                        ?>
                                        @if ($userID->role == 'Admin')
                                            <a class="dropdown-item" href="{{ route('Registerpage') }}">Register </a>
                                        @endif



                                    </div>



                                </div>
                            @endguest
                        </li>
                    </ul>



                </div>






        </header>






    @show



    @section('content')


    @show



    @section('footer')


        <div class="footer mt-auto">
            <footer class="mt-5 d-flex flex-wrap justify-content-around align-items-center py-3 border border-success">
                <!-- Sponsoren -->
                <div id="FooterBilder" style="margin-left:1%;">
                    <p class="col-md-4 mb-0 text-primary"> Sponsoren und Förderer</p>
                    <a href="https://www.ffg.at/" target="_blank"><img class=" mr-2"
                            src="{{ URL::to('/images/Sponsoren/ffg.png') }}" alt="FFG" /></a>
                    <a href="https://www.bmdw.gv.at/" target="_blank"><img class=" mr-2"
                            src="{{ URL::to('/images/Sponsoren/BM.png') }}" alt="Bundesministerium" /></a>
                    <a href="https://www.bmk.gv.at/" target="_blank"><img class=" mr-2"
                            src="{{ URL::to('/images/Sponsoren/BM2.png') }}" alt="Bundesministerium2" /></a>
                    <a href="https://wirtschaftsagentur.at/" target="_blank"><img
                            class=" mr-2" src="{{ URL::to('/images/Sponsoren/WAW.png') }}"
                            alt="Wirtschaftsagentur Wien" /></a>
                    <a href="https://www.noe.gv.at/noe/index.html" target="_blank"><img
                            class=" mr-2" src="{{ URL::to('/images/Sponsoren/Noe.png') }}"
                            alt="Land Niederösterreich" /></a>
                    <a href="https://www.verwaltung.steiermark.at/cms/ziel/74835381/DE" target="_blank"><img
                             class=" mr-2"
                            src="{{ URL::to('/images/Sponsoren/Stk.jpg') }}" alt="Land Steiermark" /></a>
                    <a href="https://www.sfg.at/" target="_blank"><img class=" mr-2"
                            src="{{ URL::to('/images/Sponsoren/SFG.jpg') }}" alt="SFG" /></a>
                </div>
                <!-- Forschungspartner -->
                <div id="FooterBilder" style="margin-left:1%;">
                    <p class="col-md-4 mb-0 text-primary">Forschungspartner</p>
                    <a href="https://www.fhwn.ac.at/" target="_blank"><img  class=" mr-2"
                            src="{{ URL::to('/images/Sponsoren/WN.jpg') }}" alt="Wiener Neustadt" /></a>
                    <a href="https://www.efre.gv.at/allgemeines/iwbefre_oesterreich" target="_blank"><img
                             class=" mr-2"
                            src="{{ URL::to('/images/Sponsoren/EFRE.jpg') }}" alt="EFRE" /></a>
                    <a href="https://www.wieselburg-land.gv.at/" target="_blank"><img 
                            class=" mr-2" src="{{ URL::to('/images/Sponsoren/GWBG.jpg') }}"
                            alt="Gemeinde Wieselburg" /></a>
                    <a href="https://www.wieselburg.gv.at/home" target="_blank"><img
                            class=" mr-2" src="{{ URL::to('/images/Sponsoren/SGWBG.jpg') }}"
                            alt="Stadtgemeinde Wieselburg" /></a>
                    <a href="https://www.noe.gv.at/noe/Wissenschaft-Forschung/Wissenschaft_Forschung.html"
                        target="_blank"><img  class=" mr-2"
                            src="{{ URL::to('/images/Sponsoren/NOEWK2.png') }}" alt="NOEK" /></a>
                </div>


                <!-- Unterhalb der Bilder -->
                <div
                    style="width: 100%; display: flex; justify-content: space-around; align-items: center; flex-wrap: wrap;">
                    <p class="text-primary" style="margin-bottom: 0;">&copy; 2022 Best GmbH
                        <a style="color:#1b8836; text-decoration: none;"
                            href="//www.best-research.eu/de/kompetenzbereiche/microgrids/allgemeine_informationen"> Area 5.2
                        </a>
                    </p>


                    <ul class="nav">
                        <li class="nav-item"><a href="{{ route('impressum') }}"
                                class="nav-link px-2 fs-5 text-primary">Impressum</a></li>
                        <li class="nav-item"><a href="{{ route('dsgvo') }}"
                                class="nav-link px-2 fs-5 text-primary">Datenschutz</a></li>
                    </ul>
                </div>
            </footer>
        </div>

    @show



    <!-- JavaScript Bundle with Popper Bootstrap -->
    <!--<script src="{{ asset('js/app.js') }}" defer></script>-->

    @include('partials.login')



</body>

</html>
