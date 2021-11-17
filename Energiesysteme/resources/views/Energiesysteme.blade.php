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

            <div class="Liste col-12 col-lg-5" style="height:615px;">
                <div class="shadow-lg rounded p-5" style="height:615px;">
                    <form class="d-flex" style="margin-left:300px;" >
                        <input class="form-control form-control2 me-2" type="search" placeholder="Suchen" aria-label="Search">
                       
                        </form>
                  

                <h3 style="margin-left:200px;"> <b>Energiesysteme</b></h3>
                <br>
                
                    <label class="switch" >
                        <input class="switch-input " type="checkbox" />
                        <span class="switch-label" data-on="Energiesysteme" data-off="Energietechnologien"></span> 
                        <span class="switch-handle"></span> 
                        </label>
                    <br>

                
              
             

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
                        <td > <a href="/delete/{{ $d->id}}"  class="btn btn2" style="background-image: url('/images/delete.png')"></a></td>
                        <td > <a href="javascript:Grafanafunction()"   class="btn btn2" style="background-image: url('/images/statistik.png')"></a></td>
                        <td > <a href="javascript:editfunction({{ $d->id}})"  class="btn btn2" style="background-image: url('/images/stift.png')"></a></td>
                        
                      </tr>
                    

                      
                    </tbody>
                    @endforeach    
                  </table>





                <!--Pop Up Fenster -->



                <!-- Button trigger modal -->
               <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"
                    style="margin-top: 6%; margin-left:35%; background-color:#3e8e41"; border:1px solid #3e8e41">
                    Energiesystem hinzufügen
                </button>-->

                <!-- Modal -->
                <div class="modal modal2 fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal2-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title modal2-title" id="exampleModalLongTitle">Energiesystem</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                              

                                 <form action="{{ route('EnSys.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                      <label for="exampleFormControlInput1">Bezeichnung</label>
                                      <input type="text" class="form-control form-control3" id="exampleFormControlInput1"  name="Bezeichnung" placeholder="MicroGridLab">
                                    </div>
                                    <div class="form-group ">
                                        <label for="exampleFormControlInput1">Katastalgemeinde</label>
                                        <input type="text" class="form-control form-control3" id="exampleFormControlInput1"  name="Katastralgemeinden" placeholder="Wieselburg">
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleFormControlInput1">Postleitzahl</label>
                                        <input type="text" class="form-control form-control3" id="exampleFormControlInput1"  name="Postleitzahl" placeholder="3250">
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleFormControlInput1">Längengrad</label>
                                        <input type="text" class="form-control form-control3" id="exampleFormControlInput1"  name="Längengrad" placeholder="91.22222" readonly>
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleFormControlInput1">Breitengrad</label>
                                        <input type="text" class="form-control form-control3" id="exampleFormControlInput1"  name="Breitengrad" placeholder="10.11212" readonly>
                                      </div>


                                  
                                    <br>
                                    <button type="button" class="btn btn3" data-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn3" value="Energiesystem erstellen">                                        
                                  </form>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>





                           <!-- ModalEdit -->
                     <div class="modal modal2 fade" id="exampleModalCenterEdit" tabindex="-1" role="dialog"
                           aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                           <div class="modal-dialog modal2-dialog modal-dialog-centered" role="document">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <h5 class="modal-title modal2-title" id="exampleModalLongTitle">Energiesystem</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                           <span aria-hidden="true">&times;</span>
                                       </button>
                                   </div>
                                   <div class="modal-body">
                                     
       
                                    <form action="/edit/{{ $d->id }}" method="">
                                           @csrf
                                           <div class="form-group">
                                             <label for="exampleFormControlInput1">Bezeichnung</label>
                                             <input type="text" class="form-control form-control3" id="exampleFormControlInput1"  name="Bezeichnung" value="{{ $d->Bezeichnung }}">
                                           </div>
                                           <div class="form-group ">
                                               <label for="exampleFormControlInput1">Katastalgemeinde</label>
                                               <input type="text" class="form-control form-control3" id="exampleFormControlInput1"  name="Katastralgemeinden" value="{{ $d->Katastralgemeinden }}">
                                             </div>
                                             <div class="form-group">
                                               <label for="exampleFormControlInput1">Postleitzahl</label>
                                               <input type="text" class="form-control form-control3" id="exampleFormControlInput1"  name="Postleitzahl" value="{{ $d->Postleitzahl }}">
                                             </div>
                                             <div class="form-group">
                                               <label for="exampleFormControlInput1">Längengrad</label>
                                               <input type="text" class="form-control form-control3" id="exampleFormControlInput1"  name="Längengrad" placeholder="91.22222" readonly>
                                             </div>
                                             <div class="form-group">
                                               <label for="exampleFormControlInput1">Breitengrad</label>
                                               <input type="text" class="form-control form-control3" id="exampleFormControlInput1"  name="Breitengrad" placeholder="10.11212" readonly>
                                             </div>
       
       
                                         
                                           <br>
                                           <button type="button" class="btn btn3" data-dismiss="modal">Close</button>
                                           <input type="submit" class="btn btn3" value="Energiesystem aktualisieren">                                        
                                         </form>
       
       
                                    
       
       
                                      
                                   </div>
                                 
       
                                   </div>
                               </div>
                           </div>
                       </div>





     <!-- ModalGrafana -->
     <div class="modal modal2 fade" id="exampleModalCenterGrafana" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
     <div class="modal-dialog modal2-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title modal2-title" id="exampleModalLongTitle">Energiesystem</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>

             <div class="modal-body">
                <h1> Grafana </h1>

                
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
                mapTypeId: "roadmap",
                

            }

            let map = new google.maps.Map(document.getElementById('map'), mapOptions);

            map.addListener("click", (e) => { //Ausgefürht wenn Map-Klick
                placeMarkerAndPanTo(e.latLng, map); //Aufruf Function Place Marker
                $('#exampleModalCenter').modal('show'); //Pop Up ES erstellen Aufruf


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





    <script>


      function editfunction($id)
      {
        $('#exampleModalCenterEdit').modal('show');

      }



      function Grafanafunction()
      {
        $('#exampleModalCenterGrafana').modal('show');

      }
      
    </script>




@endsection
@section('foooter')
