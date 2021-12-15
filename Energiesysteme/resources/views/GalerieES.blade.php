@extends('layouts.layout')
@section('title', 'Galerie')
@section('head')
@endsection
@section('content')




    <div class="dropdowngalerie">
        <button class="dropbtngalerie">Wählen Sie ein Energiesystem aus</button>
        <div class="dropdowngalerie-content">
            @foreach ($data as $d)
                <a href="{{ route('EnSys.show', $d->id) }}">{{ $d->Bezeichnung }}</a>
            @endforeach

            <!-- <a href="#">MicroGridLab</a>
                <a href="#">Feuerwehr</a>-->
        </div>
    </div>




    <div class="GalerieAnzeige shadow-lg rounded">

        <h3 style="padding:10px;margin-left:39%"> <b> {{ $EnSys->Bezeichnung }} Energietechnologien</b></h3>





      
            @foreach($EnTech as $EnTech)
        

        <div class="d-flex flex-wrap justify-content-center" style="float:left;">
            <div class="card shadow-lg rounded" style="width: 25rem; height:25rem">
                <img class="card-img-top" src="/images/gallerie.jpg" alt="Card image cap" style="width: 100%; height:50%">
                <div class="card-body">
                    <h5 class="card-title"> {{$EnTech['Bezeichnung']}}</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>

      
          
        </div>
      
        @endforeach

        

     


    </div>


  






@endsection
@section('foooter')
