@extends('layouts.layout')
@section('title', 'Home')
@section('head')
@endsection
@section('content')


    <body oncontextmenu="return false">
        <!-- Rechtsklick auf der Web-Seite nicht möglich -->

        <!-- Bilder-Show oben auf der Seite -->
        <div id="carouselExampleControls" class="carousel slide">
            <div class="carousel-inner">
                <!-- 1.Bild -->
                <div class="carousel-item active">
                    <img class="picture" src="/images/homepage/PV-Anlage.jpg" alt="First slide">
                </div>
                <!-- 2.Bild -->
                <div class="carousel-item">
                    <img class="picture" src="/images/homepage/Luftaufnahme.jpg" alt="Second slide">
                </div>
                <!-- 3.Bild -->
                <div class="carousel-item">
                    <img class="picture" src="/images/homepage/Smartheating.jpg" alt="Third slide">
                </div>
                <!-- n.Bild .... -->
                <div class="carousel-item">
                    <img class="picture" src="/images/homepage/Smartheating2.jpg" alt="Fourth slide">
                </div>
                <div class="carousel-item">
                    <img class="picture" src="/images/homepage/HomePage.png" alt="Fifth slide">
                </div>
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

            <h3 style="font-family: 'Smooch Sans', sans-serif; text-align:center; font-size:40px;" > Intelligente Strom- und Mikronetze</h3> <!-- Überschrift -->

            <!-- Text -->
            <p class="text" style="font-family: 'Hubballi', cursive;  font-size:20px; font-weight:500;" >
           

        Die 2017 neu gegründete Area „Smart- und Microgrids“ beschäftigt sich mit der konzeptionellen Planung und Steuerung von dezentralen Energieversorgungsprojekten und Microgrids. Dazu werden theoretische, physikalische und wissenschaftliche Zusammenhänge im Bereich der Planung und Steuerung von Smart- und Microgrids erforscht und experimentell entwickelt. Die angewandten Methoden inkludieren Mixed Integer Linear Programming (MILP) oder linearisierte MILP sowie Model-Predictive-Control(MPC)-Methoden. Eine ganzheitliche Betrachtung (Konzeptionierung und Betrieb) von Multi-Energiesystemen (Strom, Wärme, Kälte für Gebäude sowie für kommunale und industrielle Anwendungen) stellt eine komplexe Herausforderung dar, die nur durch den Einsatz der genannten Methoden nachhaltig lösbar ist.

        Das Hauptziel besteht darin, den Grad der Autonomie der Systeme auf allen hierarchischen Ebenen (einzelne Gebäude, Siedlungen, Energiegemeinschaften, Subnetze, Regionen) und in allen Sektoren des Energiesystems zu erhöhen. Dadurch steigert sich die Gesamteffizienz nachhaltig und die überregionale Infrastruktur wird entlastet. Die Arbeiten dienen als Grundlage für die Entwicklung von Werkzeugen, von welchen das gesamte Energiesystem langfristig profitieren soll.
            </p>

            <h3 style="font-family: 'Smooch Sans', sans-serif; text-align:center; font-size:40px;" > Entwicklungsfelder und Anwendungsgebiete </h3> <!-- Überschrift -->

            <!-- Text -->
            <p class="text" style="font-family: 'Hubballi', cursive;  font-size:20px; font-weight:500;">
                » Entwicklung von Methoden und Tools für die Energiesystemplanung und die sektorenübergreifende Energieinfrastruktur sowie die Identifizierung von Schwachstellen

                » Schaffung einer prädiktiven Steuerung via MPC, die die Wechselwirkungen zwischen den Sektoren berücksichtigt und durch den Einsatz von Speichern und Lastverschiebungen mehr Flexibilität und Stabilität im Energiesystem bietet
            </p>


            <h3 style="font-family: 'Smooch Sans', sans-serif; text-align:center; font-size:40px;" >  Forschungsprojekt Microgrid Lab </h3> <!-- Überschrift -->

            <!-- Text -->
            <p class="text" style="font-family: 'Hubballi', cursive;  font-size:20px; font-weight:500;">
                In dem Forschungsprojekt Microgrid Lab wird ein Microgrid für kommunale Energiekonzepte in einem realen Umfeld geplant, errichtet, evaluiert und auf wissenschaftlicher Ebene weiterentwickelt. Ziel ist die Etablierung des Forschungslabors für verschiedene Wirtschaftszweige, um Planungs-, Steuerungs-, Integrations- und Kommunikationskonzepte zu entwickeln und für den Markt zu testen. Das betrifft auch sektorenübergreifende Energienetze (Wärme, Strom, Gas, Wasserstoff). Projektinhalte sind die wissenschaftliche Planung, die Inbetriebnahme, ein standardisiertes Monitoring der Verbraucher/Erzeuger (u.a. Biomasse, PV, Batterie, E-Ladestationen, Absorptionskälte), die Entwicklung von Testzyklen, die Weiterentwicklung der Optimierungsalgorithmen und ein Wissenstransfer zu verschiedenen Stakeholdergruppen. Mithilfe entwickelter mathematischer Methoden wurde bereits ein optimales Energieplanungskonzept entwickelt, welches auf Gemeinden übertragen werden kann. Die innovativen Planungs- und Steuerungskonzepte ermöglichen CO2- und Kosteneinsparungen von bis zu 90% bzw. 40%.


            </p>
        </div>
    </body>
    

  







@endsection
@section('footer')
