@extends('layouts.layout')
@section('title', 'Galerie')
@section('head')
@endsection
@section('content')


 <!-- Wenn ein ES in der Drop-Down Liste ausgewählt wurde, wird mit samt den Daten des ES auf diese Seite/Blade gewechselt  -->

<body oncontextmenu="return false">  <!-- Rechtsklick auf der Web-Seite nicht möglich --> 

    <div class="dropdowngalerie">
        <button class="dropbtngalerie" style="font-family: 'Hubballi', cursive;  font-size:20px; font-weight:500;">Wählen Sie ein Energiesystem aus</button>  <!-- Drop-Down Menü der ES -->
        <div class="dropdowngalerie-content">
            <!-- Wird der Inhalt gesetzt -->
            @foreach ($data as $d)
                <!-- Jedes ES aus der DB wird einzeln in die Liste gespeichert -->
                <a href="{{ route('EnSys.show', $d->id) }}">{{ $d->designation }}</a>
            @endforeach
        </div>
    </div>



    <!-- Anzeige darunter -->
    <div class="GalerieAnzeige shadow-lg rounded">
        <!-- Überschrift mit dem Namen des ES -->
        <h3 style="font-family: 'Smooch Sans', sans-serif; text-align:center;"> {{ $EnSys->designation }} Energietechnologien</h3> 

             <!--Darstellung jeder ET -->
             @foreach($EnTech as $EnTech)
                    <!-- Card-Format Darstellung -->
                    <div id="card" class="d-flex flex-wrap justify-content-center" style="float:left; padding-left:5%; padding-top:1%;">
                        <div class="card shadow-lg rounded" style="width: 15rem; height:15rem">
                           
                            <!-- Bild einfügen -->
                            <img class="card-img-top" <?php 
                            if(empty($EnTech['picture'])){ //Wenn kein Bild beim Erstellen ausgewählt wurde, dann wird ein Standard Bild angezeigt
                                    echo 'src="/images/gallerie.jpg"';
                            } else{ //Wenn ein Bild ausgewählt wurde, wird dieses angezeigt
                                echo 'src="data:image/jpg;base64,' . $EnTech["picture"] . '"';  
                            } ?>
                                alt="Das Foto dieser Energietechnologie kann nicht angezeigt werden"  style="width: 100%; height:50%">  <!-- Alternativtext, falls das Bild nicht angezeigt werden kann -->
                            <div class="card-body"> <!-- Inhalt des Cards setzen -->
                                <h5 class="card-title"> {{$EnTech['designation']}}</h5> <!-- Als Überschrift wird die Bezeichnung angezeigt -->
                                <p class="card-text">{{$EnTech['description']}}</p>  <!-- Als Text darunter wird die Beschreibung angezeigt -->
                            </div>
                        </div>
                    </div>   
            @endforeach
    </div>

</body>


  






@endsection
@section('foooter')
