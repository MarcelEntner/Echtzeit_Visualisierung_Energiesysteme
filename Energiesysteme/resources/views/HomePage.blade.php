@extends('layouts.layout')
@section('title', 'MicroGridLab')
@section('head')
@endsection
@section('content')


    <body oncontextmenu="return false">
        <!-- Rechtsklick auf der Web-Seite nicht möglich -->

        <!-- Bilder-Show oben auf der Seite -->
        <div id="carouselExampleControls" class="carousel slide shadow-lg rounded">
            <div class="carousel-inner">
                <!-- 1.Bild -->
                <div class="carousel-item active">
                    <img class="picture" src="/images/homepage/HomePage2 - Kopie.jpg" alt="First slide">
                </div>
                <!-- 2.Bild -->
                <div class="carousel-item">
                    <img class="picture" src="/images/homepage/HomePage4 - Kopie.jpg" alt="Second slide">
                </div>
                <!-- 3.Bild -->
                <div class="carousel-item">
                    <img class="picture" src="/images/homepage/HomePage5 - Kopie.jpg" alt="Third slide">
                </div>
                <!-- n.Bild .... -->
            </div>

            <!-- Controll-Pfeil Zurück links -->
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon " aria-hidden="true"></span>
                <span class="sr-only">
                    <!--Previous-->
                </span>
            </a>

            <!-- Controll-Pfeil Weiter rechts -->
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">
                    <!--Next-->
                </span>
            </a>
        </div>


        <!-- Beitrag -->
        <div class="Beitrag shadow-lg rounded-3">

            <h3 style="padding:10px" class="text-center"> <b> Über uns</b></h3> <!-- Überschrift -->

            <!-- Text -->
            <p class="text">
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore
                et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
                Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit
                amet,
                consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
                sed
                diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea
                takimata
                sanctus est Lorem ipsum dolor sit amet.
                et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
                Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit
                amet,
                consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
                sed
                diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea
                takimata
                sanctus est Lorem ipsum dolor sit amet.
                et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
                Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit
                amet,
                consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
                sed
                diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea
                takimata
                sanctus est Lorem ipsum dolor sit amet.
            </p>
        </div>
    </body>
    



@endsection
@section('foooter')
