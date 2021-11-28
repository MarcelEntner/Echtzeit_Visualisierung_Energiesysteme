@extends('layouts.layout')
@section('title', 'Energiesysteme')
@section('head')
@endsection
@section('content')

    <!-- Zeile 415 API Key eingebunden -->
    <!-- Zeile 335 Map Key eingebunden -->

    <body oncontextmenu="return false">
        

        <div class="Energiesysteme container-fluid p-5">
            <div class="row w-100">


                <div class="col-12 col-lg-7 shadow-lg rounded" id="map">
                </div>

                <div class="Liste col-12 col-lg-5">
                    <div class="shadow-lg rounded p-5">
                        <div class="d-flex flex-column">
                            <div class="d-flex justify-content-between">
                                <h3> <b id="Listuberschrieft">Energiesysteme</b> <img src="/images/es.png" id="Listimage"></h3>
                                <input class="form-control form-control2" placeholder="Suchen" aria-label="Search">
                            </div>

                            
                        </div>
                        <br>




                        <!-- Liste -->
                        <div class="table-responsive" style="max-height: 41vh;" id="table">
                        <table class="table table-borderless table-hover" id="table">
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

                                            <td>{{ $d->id }}</td>
                                            <td>{{ $d->Bezeichnung }}</td>
                                            <td>{{ $d->Katastralgemeinden }}</td>
                                            <td>{{ $d->Postleitzahl }}</td>

                                            @auth
                                                <!-- Wenn man nicht angemeldet ist darf man die ES nicht verwalten-->
                                                <td id="hov"> <a href="/delete/{{ $d->id }}" class="btn btn2"
                                                        style="background-image: url('/images/delete.png')"></a></td>
                                                <td id="hov"> <a href="javascript:GrafanafunctionES()" class="btn btn2"
                                                        style="background-image: url('/images/statistik.png')"></a></td>
                                                <td id="hov"> <a href="javascript:editfunction({{ $d->id }})"
                                                        class="btn btn2"
                                                        style="background-image: url('/images/stift.png')"></a></td>
                                            @endauth

                                            @guest
                                            <td> <a href="javascript:GrafanafunctionES()" class="btn btn2"
                                                style="background-image: url('/images/statistik.png')"></a></td>
                                            <td> <a href="javascript:augefunction({{ $d->id }})"
                                                class="btn btn2"
                                                style="background-image: url('/images/auge.png')"></a></td>
                                            @endguest

                                        </tr>



                                    </tbody>
                                @endforeach
                            </table>
                        </div>

                    </div>





                    <!--Pop Up Fenster -->



                    <!-- Button trigger modal -->
                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"
                    style="margin-top: 6%; margin-left:35%; background-color:#3e8e41"; border:1px solid #3e8e41">
                    Energiesystem hinzufügen
                    </button>-->


                    <!-- Modal ES hinzufügen -->
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
                                            <label for="exampleFormControlInput1"
                                                style="margin-left:40%">Bezeichnung</label>
                                            <input type="text" class="form-control form-control3"
                                                id="exampleFormControlInput1" name="Bezeichnung" placeholder="MicroGridLab">
                                        </div>
                                        <div class="form-group ">
                                            <label for="exampleFormControlInput1"
                                                style="margin-left:40%">Katastalgemeinde</label>
                                            <input type="text" class="form-control form-control3"
                                                id="exampleFormControlInput1" name="Katastralgemeinden"
                                                placeholder="Wieselburg">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1"
                                                style="margin-left:40%">Postleitzahl</label>
                                            <input type="text" class="form-control form-control3"
                                                id="exampleFormControlInput1" name="Postleitzahl" placeholder="3250">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1" style="margin-left:40%">Längengrad</label>
                                            <input type="text" class="form-control form-control3" id="Laengengrad"
                                                name="Laengengrad" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1"
                                                style="margin-left:40%">Breitengrad</label>
                                            <input type="text" class="form-control form-control3" id="Breitengrad"
                                                name="Breitengrad" readonly>
                                        </div>



                                        <br>
                                        <!--  <button type="button" class="btn btn3" data-dismiss="modal">Close</button>-->
                                        <input type="submit" class="btn btn3" id="ESerstellen" value="Energiesystem erstellen">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal aus -->







                <!-- Modal ET hinzufügen -->
                <div class="modal modal2 fade" id="exampleModalCenterET" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal2-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title modal2-title" id="exampleModalLongTitle">Energietechnologie</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">


                                <form action="{{ route('EnTech.store') }}" id="ETerstellen" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1" style="margin-left:40%">ID von ES</label>
                                        <input type="text" class="form-control form-control3" id="IDES"
                                            name="IDES" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1" style="margin-left:40%">Bezeichnung</label>
                                        <input type="text" class="form-control form-control3" id="BezeichnungET"
                                            name="Bezeichnung" placeholder="Bezeichung">
                                    </div>
                                    <div class="form-group ">
                                        <label for="exampleFormControlInput1"
                                            style="margin-left:45%">Typ</label>
                                            <br>
                                            <select name="Typ" id="Typ" style="margin-left:40%">
                                                <option value="pvanlange">PV-Anlage</option>
                                                <option value="x">x1</option>
                                                <option value="x">x2</option>
                                                <option value="x">x3</option>
                                              </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1" style="margin-left:45%">Ort</label>
                                        <input type="text" class="form-control form-control3" id="OrtET"
                                            name="Ort" placeholder="Wieselburg">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1" style="margin-left:40%">Längengrad</label>
                                        <input type="text" class="form-control form-control3" id="LaengengradET"
                                            name="Laengengrad" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1" style="margin-left:40%">Breitengrad</label>
                                        <input type="text" class="form-control form-control3" id="BreitengradET"
                                            name="Breitengrad" readonly>
                                    </div>



                                    <br>
                                    <input type="submit" class="btn btn3" id="ETerstellen"
                                        value="Energietechnologie erstellen">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal aus -->




            <!-- ModalEditES -->
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


                            <form id="editForm" method="GET">
                                <!-- wird nur am Seitenaufruf gemacht und nicht zwischendurch-->
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlInput1" style="margin-left:40%">Bezeichnung</label>
                                    <input type="text" class="form-control form-control3" id="bezeichnung"
                                        name="Bezeichnung" value="">
                                </div>
                                <div class="form-group ">
                                    <label for="exampleFormControlInput1" style="margin-left:40%">Katastralgemeinde</label>
                                    <input type="text" class="form-control form-control3" id="katastralgemeinde"
                                        name="Katastralgemeinden" value="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1" style="margin-left:40%">Postleitzahl</label>
                                    <input type="text" class="form-control form-control3" id="postleitzahl"
                                        name="Postleitzahl" value="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1" style="margin-left:40%">Längengrad</label>
                                    <input type="text" class="form-control form-control3" id="LaengengradEdit"
                                        name="Laengengrad" value="" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1" style="margin-left:40%">Breitengrad</label>
                                    <input type="text" class="form-control form-control3" id="BreitengradEdit"
                                        name="Breitengrad" value="" readonly>
                                </div>



                                <br>
                                <!-- <button type="button" class="btn btn3" data-dismiss="modal">Close</button>-->
                                <input type="submit" class="btn btn3" style="background-color:#3e8e41"
                                    value="Energiesystem aktualisieren">
                            </form>






                        </div>


                    </div>
                </div>
            </div>




            <!-- Grafana ES -->
            <div class="modal modal2 fade" id="exampleModalCenterGrafanaES" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal2-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title modal2-title" id="exampleModalLongTitle">Grafana-Statistiken Energiesysteme</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <iframe
                                src="https://snapshot.raintank.io/dashboard-solo/snapshot/y7zwi2bZ7FcoTlB93WN7yWO4aMiz3pZb?from=1493369923321&to=1493377123321&panelId=4"
                                width="460"
                                height="300"
                                frameborder="0"
                             ></iframe>

                        </div>


                    </div>
                </div>
            </div>




            
            <!-- Grafana ET -->
            <div class="modal modal2 fade" id="exampleModalCenterGrafanaET" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal2-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title modal2-title" id="exampleModalLongTitle">Grafana-Statistiken Energietechnologie</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                           

                        </div>


                    </div>
                </div>
            </div>






              <!-- ModalAuge -->
              <div class="modal modal2 fade" id="exampleModalCenterAuge" tabindex="-1" role="dialog"
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
                          <h3 style="text-align: center;"> Weitere Details </h3>
                          <form id="augeForm" method="GET">
                            <!-- wird nur am Seitenaufruf gemacht und nicht zwischendurch-->
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlInput1" style="margin-left:40%">Bezeichnung</label>
                                <input type="text" class="form-control form-control3" id="bezeichnunga"
                                    name="Bezeichnung" value="" readonly>
                            </div>
                            <div class="form-group ">
                                <label for="exampleFormControlInput1" style="margin-left:40%">Katastralgemeinde</label>
                                <input type="text" class="form-control form-control3" id="katastralgemeindea"
                                    name="Katastralgemeinden" value="" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1" style="margin-left:40%">Postleitzahl</label>
                                <input type="text" class="form-control form-control3" id="postleitzahla"
                                    name="Postleitzahl" value="" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1" style="margin-left:40%">Längengrad</label>
                                <input type="text" class="form-control form-control3" id="LaengengradEdita"
                                    name="Laengengrad" value="" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1" style="margin-left:40%">Breitengrad</label>
                                <input type="text" class="form-control form-control3" id="BreitengradEdita"
                                    name="Breitengrad" value="" readonly>
                            </div>
                        </form>


                      </div>


                  </div>
              </div>
          </div>






              <!-- ModalEdit ET -->
          <div class="modal modal2 fade" id="exampleModalCenterEditET" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal2-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title modal2-title" id="exampleModalLongTitle">Energietechnologie</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">


                            <form id="editFormET" method="GET">
                                <!-- wird nur am Seitenaufruf gemacht und nicht zwischendurch-->
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlInput1" style="margin-left:40%">ID Energiesystem</label>
                                    <input type="text" class="form-control form-control3" id="idEditES"
                                        name="idEditES" value="" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1" style="margin-left:40%">ID Energietechnologie</label>
                                    <input type="text" class="form-control form-control3" id="idEditET"
                                        name="idEditET" value="" readonly>
                                </div>
                                <div class="form-group ">
                                    <label for="exampleFormControlInput1" style="margin-left:40%">Bezeichnung</label>
                                    <input type="text" class="form-control form-control3" id="BezeichnungEditET"
                                        name="BezeichnungEditET" value="">
                                </div>
                                <div class="form-group ">
                                    <label for="exampleFormControlInput1"
                                        style="margin-left:45%">Typ</label>
                                        <br>
                                        <select name="TypEditET" id="TypEditET" style="margin-left:40%">
                                            <option value="pvanlange">PV-Anlage</option>
                                            <option value="x">x1</option>
                                            <option value="x">x2</option>
                                            <option value="x">x3</option>
                                          </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1" style="margin-left:45%">Ort</label>
                                    <input type="text" class="form-control form-control3" id="OrtEditET"
                                        name="OrtEditET" value="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1" style="margin-left:40%">Längengrad</label>
                                    <input type="text" class="form-control form-control3" id="LaengengradEditET"
                                        name="LaengengradEditET" value="" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1" style="margin-left:40%">Breitengrad</label>
                                    <input type="text" class="form-control form-control3" id="BreitengradEditET"
                                        name="BreitengradEditET" value="" readonly>
                                </div>



                                <br>
                                <!-- <button type="button" class="btn btn3" data-dismiss="modal">Close</button>-->
                                <input type="submit" class="btn btn3" style="background-color:#3e8e41"
                                    value="Energietechnologie aktualisieren">
                            </form>






                        </div>


                    </div>
                </div>
            </div>
               <!-- ModalEdit ET  aus-->







        </div>

    </body>



    <script>




        let activeMarker = false;


        function LoadMap() {

            let mapOptions = {

                center: new google.maps.LatLng('48.14078077082782', '15.14955200012205'), //Ausgangspostion der Map
                zoom: 12,
                mapTypeId: "roadmap", //Typ der Map auf Road MAp setzen
                streetViewControl: false, // STreet View Männdchen ausblenden
                // mapTypeControl: false,  // Button um zwischen Satiliet und Roadmap umschalten
                mapId: '23802346582caa31', // MapID von der selbst erstellen Map 
                draggableCursor: 'crosshair',    
                scrollwheel: true, //dass Mausscrollen ohne Probleme funktioniert


                //Enter Map: 23802346582caa31
                //Kronstana Map: 396ac7c2d5bcd46

            }




            let map = new google.maps.Map(document.getElementById('map'), mapOptions);

            
           

            @auth //Gast darf keine ES erstellen
                map.addListener("click", (e) => { //Ausgefürht wenn Map-Klick
                if(!activeMarker){
                breit = e.latLng.toString().substring(1, 16);
                lang = e.latLng.toString().substring(20, 35);
                document.getElementById("Laengengrad").setAttribute('value',breit); //Koordinaten den Input Feldern hinzufügen
                document.getElementById("Breitengrad").setAttribute('value', lang);

                $('#exampleModalCenter').modal('show'); //Pop Up ES erstellen Aufruf
                }
               
                
                });
            @endauth

            google.maps.event.addListenerOnce(map, 'idle', function() { //ausgeführt wenn map geladen
                // do something only the first time the map is loaded
                //DB auslesen und einfügen
                setMarkers(map);

            });





        }
    </script>




    <!-- Hier gehört der API Key eingebunden   -->

    <!-- Kronstana API Key: AIzaSyDiSVawVLzIwn_GksL2Mc6HjoEqWhBfXvs-->
    <!-- Entner API Key: AIzaSyDboUvk9ElphosPEFC-Am9XzHFsmnOZR7I-->

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDboUvk9ElphosPEFC-Am9XzHFsmnOZR7I&callback=LoadMap">
    </script>



    <?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'laravel';
    

    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    } else {
        $sql = 'SELECT id, Bezeichnung, Laengengrad, Breitengrad, Postleitzahl, Katastralgemeinden FROM EnSys';  // ES
        $sql2 = 'SELECT id, idES, Typ, Bezeichnung, Ort, Breitengrad, Laengengrad  FROM EnTech';  // ET

        $result = $conn->query($sql);
        $result2 = $conn->query($sql2);
        $locations = [];
        $locationsET = [];

    

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                // echo "id: " . $row["id"]. " " . $row["Bezeichnung"]." ". $row["Laengengrad"]. " ". $row["Breitengrad"]. "<br>";            
    
                $location = "['{$row['Bezeichnung']}', {$row['Laengengrad']}, {$row['Breitengrad']}, {$row['id']}, {$row['Postleitzahl']}, '{$row['Katastralgemeinden']}']";
                array_push($locations, $location);

            }
        }

        if ($result2->num_rows > 0) {
            // output data of each row
            while ($row = $result2->fetch_assoc()) {         

                $locationET = "['{$row['Bezeichnung']}', {$row['Laengengrad']}, {$row['Breitengrad']}, {$row['idES']}, '{$row['Typ']}', '{$row['Ort']}', '{$row['id']}']";

                array_push($locationsET, $locationET);
    
              
            }
            $conn->close();


        }


      

    
        //ES
        echo '<script>var locations = [';
    
        foreach ($locations as $loc) {
            echo $loc . ',';
        }
    
        echo ']</script>';

        //ET
        echo '<script>var locationsET = [';
            
            foreach ($locationsET as $locET) {
                echo $locET . ',';
            }

            echo ']</script>';




    }
    ?>



    <script>
        function editfunction(id) {
            $('#exampleModalCenterEdit').modal('show');
            locations.forEach(loc => {
                if (loc[3] == id) {
                    $("#bezeichnung").val(loc[0]);
                    $("#katastralgemeinde").val(loc[5]);
                    $("#postleitzahl").val(loc[4]);
                    $("#LaengengradEdit").val(loc[1]);
                    $("#BreitengradEdit").val(loc[2]);
                    $("#editForm").attr("action", "/edit/" + id)
                }
            })

        }



        function GrafanafunctionES() {
            $('#exampleModalCenterGrafanaES').modal('show');

        }


        function augefunction(id) {
            $('#exampleModalCenterAuge').modal('show');
            locations.forEach(loc => {
                if (loc[3] == id) {
                    $("#bezeichnunga").val(loc[0]);
                    $("#katastralgemeindea").val(loc[5]);
                    $("#postleitzahla").val(loc[4]);
                    $("#LaengengradEdita").val(loc[1]);
                    $("#BreitengradEdita").val(loc[2]);
                    $("#augeForm")
                }
            })

        }

        function ETerstellen(id){
            $('#exampleModalCenterET').modal('show');
            locations.forEach(loc => {
                if (loc[3] == id) {
                    $("#IDES").val(loc[3]);     
                    $("#LaengengradEdit").val(loc[1]);
                    $("#BreitengradEdit").val(loc[2]);
                    $("#ETerstellen").attr("action", "/store/" + id)

                }
            })
        }


        function editfunctionET(id) {
         $('#exampleModalCenterEditET').modal('show');
            locationsET.forEach(locEt => {
                if (locEt[6] == id) {
                    $("#idEditES").val(locEt[3]);
                    $("#idEditET").val(locEt[6]);
                    $("#BezeichnungEditET").val(locEt[0]);
                    $("#OrtEditET").val(locEt[5]);
                    $("#TypEditET").val(locEt[4]);
                    $("#LaengengradEditET").val(locEt[1]);
                    $("#BreitengradEditET").val(locEt[2]);
                    $("#editFormET").attr("action", "/editET/" + id)
                }
            })
          

        }


        function GrafanafunctionET() {
            $('#exampleModalCenterGrafanaET').modal('show');

        }




        function setETMarker(map)
        {
            for (let i = 0; i < locationsET.length; i++) {
                const beach2 = locationsET[i];

                const markerET = new google.maps.Marker({
                    position: {
                        lat: beach2[1],
                        lng: beach2[2]
                    },
                    map, // 0 Bezeichnung, 1 Längengrad, 2 Breitengrad, 3 Id
                    icon: '/images/etgrün.png',
                    title: beach2[0], //Hover 
                    //label: beach[0], // Was im Icon steht
                    label: {
                        text: beach2[0],
                        color: 'black',
                        fontSize: '15px',
                        className: 'marker-position',
                    },
                    animation: google.maps.Animation.DROP, //verschiedene Moduse: DROP, BOUNCE
                });


                markerET.addListener("click", () => {
                    alert("ET pressed");
                   

                });
            }

            
        }





        


    
        



        function setMarkers(map) {
            // Adds markers to the map + alle Map-Funktionen

            // ES Marker
            for (let i = 0; i < locations.length; i++) {
                const beach = locations[i];

                const marker = new google.maps.Marker({
                    position: {
                        lat: beach[1],
                        lng: beach[2]
                    },
                    map, // 0 Bezeichnung, 1 Längengrad, 2 Breitengrad, 3 Id
                    icon: '/images/es.png',
                    title: beach[0], //Hover 
                    //label: beach[0], // Was im Icon steht
                    label: {
                        text: beach[0],
                        color: 'black',
                        fontSize: '15px',
                        className: 'marker-position',
                    },
                    animation: google.maps.Animation.DROP, //verschiedene Moduse: DROP, BOUNCE
                });



                //Doppelklick um ES auszuwählen
                marker.addListener("dblclick", (e) => 
                {
                 
                    let latLng = e.latLng.toString();
                    breit = parseFloat(latLng.substring(1, latLng.indexOf(","))).toFixed(9);
                    lang = parseFloat(latLng.substring(latLng.indexOf(",")+1, latLng.length)).toFixed(9);
                    let id;
                    locations.forEach((loc) => {
                        if(loc[1].toFixed(9) == breit && loc[2].toFixed(9) == lang){
                          id = loc[3];  
                        }
                    });

                    map.setZoom(17);
                    map.setCenter(marker.getPosition());
                    marker.setIcon("/images/esgrün.png");
                    marker.setAnimation(google.maps.Animation.BOUNCE);
                    print_List_Energietechnologie(id);
                    map.setOptions({ draggableCursor: 'url(/images/etgrün.png), move' });
                    setETMarker(map);

                    activeMarker = true;

                    
                    map.addListener("click", (e1) => { //Ausgefürht wenn Map-Klick
                     
                    if(activeMarker){
                    let latLng = e.latLng.toString();
                    breit = parseFloat(latLng.substring(1, latLng.indexOf(","))).toFixed(9);
                    lang = parseFloat(latLng.substring(latLng.indexOf(",")+1, latLng.length)).toFixed(9);
                    document.getElementById("LaengengradET").setAttribute('value',breit); //Koordinaten den Input Feldern hinzufügen
                    document.getElementById("BreitengradET").setAttribute('value', lang);
                    document.getElementById("IDES").setAttribute('value', id); //ID von ES einfügen
                    $('#exampleModalCenterET').modal('show'); //Pop Up ET erstellen Aufruf
                    }

                     });

                });


                //Einfacher Klick um ES abzuwählen
                marker.addListener("click", () => {
                    map.setZoom(15);
                    map.setCenter(marker.getPosition());
                    marker.setIcon("/images/es.png");
                    marker.setAnimation(google.maps.Animation.DROP);
                    print_List_Energiesysteme();
                    map.setOptions({ draggableCursor: 'crosshair' });
                    $('#exampleModalCenterET').modal('hide'); //Pop Up ET erstellen Aufruf                  
                    activeMarker = false;

                });



            }


        }




        


        function print_List_Energietechnologie(id){

            var ETListe="";
            ETListe += "<table class=\"table table-borderless table-hover\" id=\"table\">";
            ETListe += "                                <thead>";
            ETListe += "                                    <tr>";
            ETListe += "                                        <th scope=\"col\">ID-ES<\/th>";
                ETListe += "                                    <th scope=\"col\">ID-ET<\/th>";
            ETListe += "                                        <th scope=\"col\">Bezeichnung<\/th>";
            ETListe += "                                        <th scope=\"col\">Typ<\/th>";
            ETListe += "                                        <th scope=\"col\">Ort<\/th>";
            ETListe += "";
            ETListe += "";
            ETListe += "                                    <\/tr>";
            ETListe += "                                <\/thead>";

            ETListe += "                                @foreach ($dataEnTech as $d)";
            ETListe += "                                    <tbody>";
            ETListe += "                                        <tr class='enTechTR-{{$d->idES}}' style='display:none;'>";
            ETListe += "";
            ETListe += "                                            <td>{{ $d->idES }}</td>"; //IDES
            ETListe += "                                            <td>{{ $d->id }}</td>"; //IDET
            ETListe += "                                            <td>{{ $d->Bezeichnung }}</td>"; //Bezeichnung
            ETListe += "                                            <td>{{ $d->Typ }}</td>"; //Typ 
            ETListe += "                                            <td>{{ $d->Ort }}</td>"; //Ort
            ETListe += "";
            ETListe += "                                            @auth";
            ETListe += "                                                <!-- Wenn man nicht angemeldet ist darf man die ES nicht verwalten-->";
            ETListe += "                                                <td> <a href=\"\/deleteET\/{{ $d->id }}\" class=\"btn btn2\"";
            ETListe += "                                                        style=\"background-image: url('\/images\/delete.png')\"><\/a><\/td>";
            ETListe += "                                                <td> <a href=\"javascript:GrafanafunctionET()\" class=\"btn btn2\"";
            ETListe += "                                                        style=\"background-image: url('\/images\/statistik.png')\"><\/a><\/td>";
            ETListe += "                                                <td> <a href=\"javascript:editfunctionET({{ $d->id }})\"";
            ETListe += "                                                        class=\"btn btn2\"";
            ETListe += "                                                        style=\"background-image: url('\/images\/stift.png')\"><\/a><\/td>";
            ETListe += "                                            @endauth";
            ETListe += "";
            ETListe += "                                            @guest";
            ETListe += "                                            <td> <a href=\"javascript:GrafanafunctionET()\" class=\"btn btn2\"";
            ETListe += "                                                style=\"background-image: url('\/images\/statistik.png')\"><\/a><\/td>";
            ETListe += "                                            <td> <a href=\"javascript:augefunction({{ $d->id }})\"";
            ETListe += "                                                class=\"btn btn2\"";
            ETListe += "                                                style=\"background-image: url('\/images\/auge.png')\"><\/a><\/td>";
            ETListe += "                                            @endguest";
            ETListe += "";
            ETListe += "                                        <\/tr>";
            ETListe += "                                    <\/tbody>";
            ETListe += "                                @endforeach";

            
          
            ETListe += "                            <\/table>";

            document.getElementById("table").innerHTML = ETListe;

            $(".enTechTR-" + id).css("display", "table-row");

                document.getElementById("Listuberschrieft").innerHTML = "Energietechnologien";
                document.getElementById("Listimage").src = "/images/etgrün.png";
        }




        function print_List_Energiesysteme(){


            var EnsysListe="";
                        EnsysListe += "<table class=\"table table-borderless table-hover\" id=\"table\">";
                        EnsysListe += "                                <thead>";
                        EnsysListe += "                                    <tr>";
                        EnsysListe += "                                        <th scope=\"col\">ID<\/th>";
                        EnsysListe += "                                        <th scope=\"col\">Bezeichnung<\/th>";
                        EnsysListe += "                                        <th scope=\"col\">Katastralgemeinde<\/th>";
                        EnsysListe += "                                        <th scope=\"col\">Postleitzahl<\/th>";
                        EnsysListe += "";
                        EnsysListe += "";
                        EnsysListe += "                                    <\/tr>";
                        EnsysListe += "                                <\/thead>";
                        EnsysListe += "";
                        EnsysListe += "                                @foreach ($data as $d)";
                        EnsysListe += "                                    <tbody>";
                        EnsysListe += "                                        <tr>";
                        EnsysListe += "";
                        EnsysListe += "                                            <td>{{ $d->id }}<\/td>";
                        EnsysListe += "                                            <td>{{ $d->Bezeichnung }}<\/td>";
                        EnsysListe += "                                            <td>{{ $d->Katastralgemeinden }}<\/td>";
                        EnsysListe += "                                            <td>{{ $d->Postleitzahl }}<\/td>";
                        EnsysListe += "";
                        EnsysListe += "                                            @auth";
                        EnsysListe += "                                                <!-- Wenn man nicht angemeldet ist darf man die ES nicht verwalten-->";
                        EnsysListe += "                                                <td> <a href=\"\/delete\/{{ $d->id }}\" class=\"btn btn2\"";
                        EnsysListe += "                                                        style=\"background-image: url('\/images\/delete.png')\"><\/a><\/td>";
                        EnsysListe += "                                                <td> <a href=\"javascript:GrafanafunctionES()\" class=\"btn btn2\"";
                        EnsysListe += "                                                        style=\"background-image: url('\/images\/statistik.png')\"><\/a><\/td>";
                        EnsysListe += "                                                <td> <a href=\"javascript:editfunction({{ $d->id }})\"";
                        EnsysListe += "                                                        class=\"btn btn2\"";
                        EnsysListe += "                                                        style=\"background-image: url('\/images\/stift.png')\"><\/a><\/td>";
                        EnsysListe += "                                            @endauth";
                        EnsysListe += "";
                        EnsysListe += "                                            @guest";
                        EnsysListe += "                                            <td> <a href=\"javascript:GrafanafunctionES()\" class=\"btn btn2\"";
                        EnsysListe += "                                                style=\"background-image: url('\/images\/statistik.png')\"><\/a><\/td>";
                        EnsysListe += "                                            <td> <a href=\"javascript:augefunction({{ $d->id }})\"";
                        EnsysListe += "                                                class=\"btn btn2\"";
                        EnsysListe += "                                                style=\"background-image: url('\/images\/auge.png')\"><\/a><\/td>";
                        EnsysListe += "                                            @endguest";
                        EnsysListe += "";
                        EnsysListe += "                                        <\/tr>";
                        EnsysListe += "";
                        EnsysListe += "";
                        EnsysListe += "";
                        EnsysListe += "                                    <\/tbody>";
                        EnsysListe += "                                @endforeach";
                        EnsysListe += "                            <\/table>";




            document.getElementById("table").innerHTML = EnsysListe;
            document.getElementById("Listuberschrieft").innerHTML = "Energiesysteme";
            document.getElementById("Listimage").src = "/images/es.png";
        }





    </script>




@endsection
@section('foooter')
