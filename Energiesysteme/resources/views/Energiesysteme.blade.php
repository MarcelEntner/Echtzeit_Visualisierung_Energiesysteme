@extends('layouts.layout')
@section('title', 'Energiesysteme')
@section('head')
@endsection
@section('content')

<main>

    <div class="Energiesysteme container-fluid p-5">
        <div class="row w-100">

            <!--    <div class="Karte" >       
              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d21297.206605903528!2d15.1610548!3d48.145897399999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sde!2sat!4v1635412680266!5m2!1sde!2sat" 
              width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" class="GoogleMaps"></iframe>
            </div>
          -->

            <div class="col-12 col-lg-7 shadow-lg rounded" id="map">
            </div>

            <!--test upload git -->

            <div class="Liste col-12 col-lg-5">
                <div class="shadow-lg rounded p-5">
                <h3 style="padding:5%"> <b>Energiesysteme</b></h3>
                <input type="search" id="suche" placeholder="Suche...">

             

                <table class="table table-borderless table-hover ">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Bezeichnung</th>
                        <th scope="col">Katastralgemeinde</th>
                        <th scope="col">Postleitzahl</th>
                       
                        
                      </tr>
                    </thead>
                    
                    @foreach ($data as $d)
                    <tbody>
                      <tr>
                        
                        <td >{{ $d->id }}</td>
                        <td >{{ $d->Bezeichnung }}</td>
                        <td>{{ $d->Katastralgemeinden }}</td>
                        <td>{{ $d->Postleitzahl }}</td>
                        <td> <button  style="background-image: url('/images/delete.png')" class="esbutton"></button></td>
                        <td > <button style="background-image: url('/images/statistik.png')" class="esbutton"></button></td>
                        <td > <button style="background-image: url('/images/stift.png')" class="esbutton"></button></td>
                      </tr>
                    
                    </tbody>
                    @endforeach    
                  </table>





                <!--Pop Up Fenster -->



                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"
                    style="margin-top: 15%; margin-left:35%; background-color:#3e8e41; border:1px solid #3e8e41">
                    Energiesystem hinzufügen
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Energiesystem</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">



                                <h2> ADD ES </h2>


                                <form action="{{ route('EnSys.store') }}" method="POST">
                                    @csrf
                                    <label for="Bezeichnung">Bezeichnung</label>
                                    <input name="Bezeichnung">
                                    <br>
                                    <label for="Katastralgemeinden">Katastralgemeinden</label>
                                    <input name="Katastralgemeinden">
                                    <br>
                                    <label for="Postleitzahl">Postleitzahl</label>
                                    <input name="Postleitzahl">






                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" value="ES erstellen">

                                </form>
                            </div>
                        </div>
                    </div>
                </div>





              </div>
            </div>


        </div>
    </div>
    </main>


    <script>
        function LoadMap() {

            let mapOptions = {

                center: new google.maps.LatLng('48.13333', '15.13333'),
                zoom: 15,


            }

            let map = new google.maps.Map(document.getElementById('map'), mapOptions);

            map.addListener("click", (e) => {
                placeMarkerAndPanTo(e.latLng, map);
            });
        }


        
        function placeMarkerAndPanTo(latLng, map) {
            new google.maps.Marker({
                position: latLng,
                map: map,
            });
            map.panTo(latLng);


        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiSVawVLzIwn_GksL2Mc6HjoEqWhBfXvs&callback=LoadMap">
    </script>









@endsection
@section('foooter')
