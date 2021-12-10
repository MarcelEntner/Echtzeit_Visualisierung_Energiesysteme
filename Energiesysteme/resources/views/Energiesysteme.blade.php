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

                    <input id="address" type="text" > <!--- INPUT FELD ZUM SUCHEN -->
                    <div id="find" class="btn btn-success">Suchen</div> <!--- BUTTON ZUM SUCHEN -->

                    <div class="shadow-lg rounded p-5">
                        <div class="d-flex flex-column">
                            <div class="d-flex justify-content-between">
                                <h3> <b id="Listuberschrieft">Energiesysteme</b> <img src="/images/icons/es.png" id="Listimage"></h3>
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
                                            <?php 
                                            $userID = Auth::user();
                                            ?>

                                                <!-- Wenn man nicht angemeldet ist darf man die ES nicht verwalten-->
                                                <!-- Nur der Ersteller eines ES darf dieses auch bearbeiten + Admin (ID 1) darf alle -->
                                               
                                             
                                                 <!--$userID->id == $d->id -->

                                                 @if ($userID->id == $d->user_id || $userID->role == "Admin")
                                                     
                                        
                                                <td id="hov"> <a href="/delete/{{ $d->id }}" class="btn btn2"
                                                        style="background-image: url('/images/buttons/delete.png')"></a></td>

                                                <td id="hov"> <a href="javascript:GrafanafunctionES()" class="btn btn2"
                                                        style="background-image: url('/images/buttons/statistik.png')"></a></td>

                                                <td id="hov"> <a href="javascript:editfunction({{ $d->id }})" class="btn btn2" 
                                                    style="background-image: url('/images/buttons/stift.png')"></a></td>
                                               

                                                @else

                                                <td> <a href="javascript:GrafanafunctionES()" class="btn btn2"
                                                    style="background-image: url('/images/buttons/statistik.png')"></a></td>
                                                <td> <a href="javascript:augefunction({{ $d->id }})"
                                                    class="btn btn2"
                                                    style="background-image: url('/images/buttons/auge.png')"></a></td>

                                                <td> </td>    

                                                @endif

                                                
                                               
                                            @endauth
                                                


                                            @guest
                                            <td> <a href="javascript:GrafanafunctionES()" class="btn btn2"
                                                style="background-image: url('/images/buttons/statistik.png')"></a></td>
                                            <td> <a href="javascript:augefunction({{ $d->id }})"
                                                class="btn btn2"
                                                style="background-image: url('/images/buttons/auge.png')"></a></td>
                                            @endguest
                                                       
                                        </tr>



                                    </tbody>
                                @endforeach
                            </table>
                        </div>

                    </div>
                </div>






        <!-- Button trigger modal -->
        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"
        style="margin-top: 6%; margin-left:35%; background-color:#3e8e41"; border:1px solid #3e8e41">
        Energiesystem hinzufügen
        </button>-->
                           
        
        
        
        <!--Pop Up Fenster -->



                    <!-- Modal ES hinzufügen -->
                    <div class="modal modal2 fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal2-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title modal2-title" id="exampleModalLongTitle">Energiesystem <img src="/images/icons/es2.png"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">


                                    <form action="{{ route('EnSys.store') }}" method="POST">
                                        @csrf

                                        <div class="input-group mb-3" style="margin-top:2%">
                                        <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                            <img src="/images/pop-up/name.png" style="margin-right:10px;">
                                            Bezeichnung</span>
                                        <input type="text" class="form-control3" id="BezeichnungES" name="BezeichnungES"  aria-label="Bezeichnung" aria-describedby="basic-addon1" placeholder="MicroGridLab">
                                        </div>
                                        <div class="input-group mb-3" style="margin-top:5%">
                                            <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                                <img src="/images/pop-up/katastralgemeinde.png" style="margin-right:10px;">
                                                Katastralgemeinde</span>
                                            <input  type="text" class="form-control3" id="KatastralgemeindenES" name="KatastralgemeindenES" aria-label="Katastralgemeinden" aria-describedby="basic-addon1" placeholder="Wieselburg">
                                        </div>
                                        <div class="input-group mb-3" style="margin-top:5%">
                                            <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                                <img src="/images/pop-up/postleitzahl.png" style="margin-right:10px;">
                                                Postleitzahl</span>
                                            <input  type="text" class="form-control3" id="PostleitzahlES" name="PostleitzahlES" aria-label="Postleitzahl" aria-describedby="basic-addon1" placeholder="3250">
                                        </div>
                                        <div class="input-group mb-3" style="margin-top:5%">
                                            <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                                <img src="/images/pop-up/längengrad.png" style="margin-right:10px;">
                                                Längengrad</span>
                                            <input  type="text" class="form-control3" id="LaengengradES" name="LaengengradES" aria-label="LaengengradES" aria-describedby="basic-addon1" readonly>
                                        </div>
                                        <div class="input-group mb-3" style="margin-top:5%">
                                            <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                                <img src="/images/pop-up/breitengrad.png" style="margin-right:10px;">
                                                Breitengrad</span>
                                            <input  type="text" class="form-control3" id="BreitengradES" name="BreitengradES" aria-label="BreitengradES" aria-describedby="basic-addon1" readonly>
                                        </div>


                                        <br>
                                        <!--  <button type="button" class="btn btn3" data-dismiss="modal">Close</button>-->
                                        <input type="submit" class="btn btn-success" style="margin-left:30%" id="ESerstellen" value="Energiesystem erstellen">
                                    </form>
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
                                <h5 class="modal-title modal2-title" id="exampleModalLongTitle">Energietechnologie<img src="/images/icons/etgrün2.png"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="{{ route('EnTech.store') }}" id="ETerstellen" method="POST">
                                    @csrf
                                    <div class="input-group mb-3" style="margin-top:2%">
                                        <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                            <img src="/images/pop-up/id.png" style="margin-right:10px;">
                                            ID-ES</span>
                                        <input type="text" class="form-control3" id="IDES"  name="IDES" readonly aria-label="ID-ES" aria-describedby="basic-addon1">
                                    </div>

                                    <div class="input-group mb-3" style="margin-top:2%">
                                        <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                            <img src="/images/pop-up/name.png" style="margin-right:10px;">
                                            Bezeichnung</span>
                                        <input type="text" class="form-control3" id="BezeichnungET"
                                            name="Bezeichnung" placeholder="Bezeichung" aria-label="BezeichnungET" aria-describedby="basic-addon1">
                                    </div>

                                    <div class="input-group mb-3" style="margin-top:2%; width:445px;">
                                        <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                            <img src="/images/pop-up/typ.png" style="margin-right:10px;">
                                            Typ</span>
                                            <br>
                                            <select class="form-select" name="Typ" id="Typ" style="text-align:center">
                                                <option value="PV-Anlage">PV-Anlage</option>
                                                <option value="Stromnetzbezug">Stromnetzbezug</option>
                                                <option value="Batteriespeicher">Batteriespeicher</option>
                                                <option value="Wasserstoff Elektrolyse">Wasserstoff Elektrolyse</option>
                                                <option value="Wasserstoff Brennstoffzelle"> Wasserstoff Brennstoffzelle</option>
                                                <option value="Wasserstoff Speicher"> Wasserstoff Speicher</option>
                                                <option value="Windkraftanlage"> Windkraftanlage</option>
                                                <option value="E-Ladestation"> E-Ladestation</option>
                                                <option value="Hausanschlusszähler"> Hausanschlusszähler</option>
                                                <option value="Wärmenetzbezug"> Wärmenetzbezug</option>
                                                <option value="Biomasseheizkraftwerk"> Biomasseheizkraftwerk (BHKW)</option>
                                                <option value="Biomasseheizwerk"> Biomasseheizwerk </option>
                                                <option value="Biomasseheizkessel"> Biomasseheizkessel</option>
                                                <option value="Wärmespeicher"> Wärmespeicher</option>
                                                <option value="Solarthermieanlage"> Solarthermieanlage</option>
                                                <option value="Wärmepumpe"> Wärmepumpe</option>
                                                <option value="Gebäude Wärmebedarfszähler"> Gebäude Wärmebedarfszähler</option>
                                                <option value="Kompressionskältemaschiene"> Kompressionskältemaschiene</option>
                                                <option value="Ab oder Adsorbtionskältemaschiene"> Ab oder Adsorbtionskältemaschiene</option>
                                                <option value="Kältespeicher">Kältespeicher</option>
                                                <option value="Gebäude Kältebedarfszähler">Gebäude Kältebedarfszähler</option>
                                              </select>
                                    </div>

                                    <div class="input-group mb-3" style="margin-top:2%">
                                        <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                            <img src="/images/pop-up/ort.png" style="margin-right:10px;">
                                            Ort</span>
                                        <input type="text" class="form-control3" id="OrtET"
                                            name="Ort" placeholder="Wieselburg" aria-label="OrtET" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="input-group mb-3" style="margin-top:2%">
                                        <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                            <img src="/images/pop-up/längengrad.png" style="margin-right:10px;">
                                            Längengrad</span>
                                        <input type="text" class="form-control3" id="LaengengradET"
                                            name="Laengengrad"  aria-label="LängengradET" aria-describedby="basic-addon1" readonly>
                                    </div>
                                    <div class="input-group mb-3" style="margin-top:2%">
                                        <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                            <img src="/images/pop-up/breitengrad.png" style="margin-right:10px;">
                                            Breitengrad</span>
                                        <input type="text" class="form-control3" id="BreitengradET"
                                            name="Breitengrad" aria-label="BreitengradET" aria-describedby="basic-addon1" readonly>
                                    </div>



                                    <br>
                                    <input type="submit" class="btn btn-success" style="margin-left:30%" id="ETerstellen"
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
                            <h5 class="modal-title modal2-title" id="exampleModalLongTitle">Energiesystem <img src="/images/icons/esgrün2.png"></h5></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">


                            <form id="editForm" method="GET">
                                <!-- wird nur am Seitenaufruf gemacht und nicht zwischendurch-->
                                @csrf
                                <div class="input-group mb-3" style="margin-top:2%">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                        <img src="/images/pop-up/name.png" style="margin-right:10px;">
                                        Bezeichnung</span>                                    
                                <input type="text" class="form-control3" id="bezeichnung" name="Bezeichnung" value="" aria-label="Bezeichnung" aria-describedby="basic-addon1">
                                </div>

                                <div class="input-group mb-3" style="margin-top:5%">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                        <img src="/images/pop-up/katastralgemeinde.png" style="margin-right:10px;">
                                        Katastralgemeinde</span>    
                                    <input type="text" class="form-control3" id="katastralgemeinde" name="Katastralgemeinden" value="" aria-label="Katastralgemeinden" aria-describedby="basic-addon1">
                                </div>

                                <div class="input-group mb-3" style="margin-top:5%">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                        <img src="/images/pop-up/postleitzahl.png" style="margin-right:10px;">
                                        Postleitzahl</span> 
                                    <input type="text" class="form-control3" id="postleitzahl"  name="Postleitzahl" value="" aria-label="Postleitzahl" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3" style="margin-top:5%">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                        <img src="/images/pop-up/längengrad.png" style="margin-right:10px;">
                                        Längengrad</span> 
                                    <input type="text" class="form-control3" id="LaengengradEdit" name="Laengengrad" value="" aria-label="Laengengrad" aria-describedby="basic-addon1" readonly>
                                </div>
                                <div class="input-group mb-3" style="margin-top:5%">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                        <img src="/images/pop-up/breitengrad.png" style="margin-right:10px;">
                                         Breitengrad</span> 
                                    <input type="text" class="form-control3" id="BreitengradEdit" name="Breitengrad" value="" readonly aria-label="Breitengrad" aria-describedby="basic-addon1">
                                </div>



                                <br>
                                <input type="submit" class="btn  btn-success" style="margin-left:30%"
                                    value="Energiesystem aktualisieren">
                                    
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
                    <h5 class="modal-title modal2-title" id="exampleModalLongTitle">Energietechnologie<img src="/images/icons/etgrün2.png"></h5></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <form id="editFormET" method="GET">
                        <!-- wird nur am Seitenaufruf gemacht und nicht zwischendurch-->
                        @csrf
                        <div class="input-group mb-3" style="margin-top:2%">
                            <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                <img src="/images/pop-up/id.png" style="margin-right:10px;">
                                ID Energiesystem</span>                            
                                <input type="text" class="form-control3" id="idEditES" name="idEditES" value="" aria-label="ID-ES" aria-describedby="basic-addon1" readonly>
                        </div>

                        <div class="input-group mb-3" style="margin-top:2%">
                            <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                <img src="/images/pop-up/id.png" style="margin-right:10px;">
                                ID Energietechnologie</span>  
                            <input type="text" class="form-control3" id="idEditET" name="idEditET" value="" aria-label="idEditET" aria-describedby="basic-addon1" readonly>
                        </div>

                        <div class="input-group mb-3" style="margin-top:2%">
                            <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                <img src="/images/pop-up/name.png" style="margin-right:10px;">
                                Bezeichnung</span>                              
                                <input type="text" class="form-control3" id="BezeichnungEditET" name="BezeichnungEditET" value="" aria-label="BezeichnungEditET" aria-describedby="basic-addon1">
                        </div>

                        <div class="input-group mb-3" style="margin-top:2%; width:445px;">
                            <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                <img src="/images/pop-up/typ.png" style="margin-right:10px;">
                                Typ</span>  
                                <br>
                                
                                <select name="TypEditET" class="form-select" id="TypEditET" style="text-align:center;">
                                    <option value="PV-Anlage">PV-Anlage</option>
                                    <option value="Stromnetzbezug">Stromnetzbezug</option>
                                    <option value="Batteriespeicher">Batteriespeicher</option>
                                    <option value="Wasserstoff Elektrolyse">Wasserstoff Elektrolyse</option>
                                    <option value="Wasserstoff Brennstoffzelle"> Wasserstoff Brennstoffzelle</option>
                                    <option value="Wasserstoff Speicher"> Wasserstoff Speicher</option>
                                    <option value="Windkraftanlage"> Windkraftanlage</option>
                                    <option value="E-Ladestation"> E-Ladestation</option>
                                    <option value="Hausanschlusszähler"> Hausanschlusszähler</option>
                                    <option value="Wärmenetzbezug"> Wärmenetzbezug</option>
                                    <option value="Biomasseheizkraftwerk"> Biomasseheizkraftwerk (BHKW)</option>
                                    <option value="Biomasseheizwerk"> Biomasseheizwerk </option>
                                    <option value="Biomasseheizkessel"> Biomasseheizkessel</option>
                                    <option value="Wärmespeicher"> Wärmespeicher</option>
                                    <option value="Solarthermieanlage"> Solarthermieanlage</option>
                                    <option value="Wärmepumpe"> Wärmepumpe</option>
                                    <option value="Gebäude Wärmebedarfszähler"> Gebäude Wärmebedarfszähler</option>
                                    <option value="Kompressionskältemaschiene"> Kompressionskältemaschiene</option>
                                    <option value="Ab oder Adsorbtionskältemaschiene"> Ab oder Adsorbtionskältemaschiene</option>
                                    <option value="Kältespeicher">Kältespeicher</option>
                                    <option value="Gebäude Kältebedarfszähler">Gebäude Kältebedarfszähler</option>
                                  </select>
                        </div>

                        <div class="input-group mb-3" style="margin-top:2%">
                            <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                <img src="/images/pop-up/ort.png" style="margin-right:10px;">
                                Ort </span>                              
                                <input type="text" class="form-control3" id="OrtEditET"  name="OrtEditET" value="" aria-label="OrtEditET" aria-describedby="basic-addon1">
                        </div>

                        <div class="input-group mb-3" style="margin-top:2%">
                            <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                <img src="/images/pop-up/längengrad.png" style="margin-right:10px;">
                                Längengrad</span>                             
                             <input type="text" class="form-control3" id="LaengengradEditET" name="LaengengradEditET" value="" readonly aria-label="LaengengradEditET" aria-describedby="basic-addon1">
                        </div>

                        <div class="input-group mb-3" style="margin-top:2%">
                            <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                <img src="/images/pop-up/breitengrad.png" style="margin-right:10px;">
                                Breitgengrad</span>                              
                                <input type="text" class="form-control3" id="BreitengradEditET" name="BreitengradEditET" value="" readonly aria-label="BreitengradEditET" aria-describedby="basic-addon1">
                        </div>



                        <br>
                        <!-- <button type="button" class="btn btn3" data-dismiss="modal">Close</button>-->
                        <input type="submit" class="btn btn-success" style="margin-left:30%"
                            value="Energietechnologie aktualisieren">
                
                    </form>






                </div>


            </div>
        </div>
    </div>
       <!-- ModalEdit ET  aus-->







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






              <!-- ModalAuge ES -->
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






                <!-- ModalAuge ET -->
                <div class="modal modal2 fade" id="exampleModalCenterAugeET" tabindex="-1" role="dialog"
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
                            <h3 style="text-align: center;"> Weitere Details </h3>
                            <form id="augeFormET" method="GET">
                              <!-- wird nur am Seitenaufruf gemacht und nicht zwischendurch-->
                              @csrf
                              <div class="form-group">
                                  <label for="exampleFormControlInput1" style="margin-left:45%">ID-ES</label>
                                  <input type="text" class="form-control form-control3" id="IDESAugeET"
                                      name="Bezeichnung" value="" readonly>
                              </div>
                              <div class="form-group ">
                                  <label for="exampleFormControlInput1" style="margin-left:45%">ID-ET</label>
                                  <input type="text" class="form-control form-control3" id="IDETAugeET"
                                      name="Katastralgemeinden" value="" readonly>
                              </div>
                              <div class="form-group">
                                  <label for="exampleFormControlInput1" style="margin-left:40%">Bezeichnung</label>
                                  <input type="text" class="form-control form-control3" id="BezeichnungAugeET"
                                      name="Postleitzahl" value="" readonly>
                              </div>
                              <div class="form-group">
                                  <label for="exampleFormControlInput1" style="margin-left:45%">Typ</label>
                                  <input type="text" class="form-control form-control3" id="TypAugeET"
                                      name="Laengengrad" value="" readonly>
                              </div>
                              <div class="form-group">
                                  <label for="exampleFormControlInput1" style="margin-left:45%">Ort</label>
                                  <input type="text" class="form-control form-control3" id="OrtAugeET"
                                      name="Breitengrad" value="" readonly>
                              </div>
                              <div class="form-group">
                                <label for="exampleFormControlInput1" style="margin-left:40%">Längengrad</label>
                                <input type="text" class="form-control form-control3" id="LaengengradAugeET"
                                    name="Breitengrad" value="" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1" style="margin-left:40%">Breitengrad</label>
                                <input type="text" class="form-control form-control3" id="BreitengradAugeET"
                                    name="Breitengrad" value="" readonly>
                            </div>
                          </form>
  
  
                        </div>
  
  
                    </div>
                </div>
            </div>












          

    </body>

  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>




    <!-- Hier gehört der API Key eingebunden   -->

    <!-- Kronstana API Key: AIzaSyDiSVawVLzIwn_GksL2Mc6HjoEqWhBfXvs-->
    <!-- Entner API Key: AIzaSyDboUvk9ElphosPEFC-Am9XzHFsmnOZR7I-->

    <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDboUvk9ElphosPEFC-Am9XzHFsmnOZR7I&callback=LoadMap">
    </script>-->
    


    <script>

    var activeMarker = false;
    var activeClick = false;
    var markersArray= [];

function initAutocomplete() {


    let mapOptions = {

        center: new google.maps.LatLng('48.14078077082782', '15.14955200012205'), //Ausgangspostion der Map
        zoom: 12,
        mapTypeId: "roadmap", //Typ der Map auf Road MAp setzen
        streetViewControl: false, // STreet View Männdchen ausblenden
        // mapTypeControl: false,  // Button um zwischen Satiliet und Roadmap umschalten
        mapId: '23802346582caa31', // MapID von der selbst erstellen Map 
        draggableCursor: 'crosshair',    
        scrollwheel: true, //dass Mausscrollen ohne Probleme funktioniert
        fullscreenControl: false, //Vollbild Button entfernen
       // scaleControl: false,
       zoomControl: false, //rechts unten Zoom Buttons
       scaleControl: true, //rechts unten Maßstab
     
    
      
       mapTypeControl: true,
    mapTypeControlOptions: {
        style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
        mapTypeIds: [
            google.maps.MapTypeId.ROADMAP,
            google.maps.MapTypeId.SATELLITE
        ]
    },
    




        //Enter Map: 23802346582caa31
        //Kronstana Map: 396ac7c2d5bcd46

        }

	autocomplete = new google.maps.places.Autocomplete((document.getElementById('address')),{
		types: ['geocode']
	});
	
		
	var map		=	new google.maps.Map(document.getElementById('map'), mapOptions);
	
	// START BY CLICK
	$('div#find').on('click', function() {
		LatLngSearch();			
	});
	
	// START BY PRESS ENTER
	$('#address').bind("enterKey",function(e){
		LatLngSearch();	
	});
	$('#address').keyup(function(e){
		if(e.keyCode == 13) {
			LatLngSearch();
		}
	});
			
	// SHOW LAT LNG		
	function LatLngSearch(  ) {
		
		var value			=	$('input#address').val();
		
		if ( value ) {
			var request		=	$.ajax({
				url			:	"/mapsLocation",
				method		:	"GET",
				data		:	{ 
									address		:	value
								},
				dataType	:	'json',
				success		:	function(result) {
					
					var searchLatLng = {
						lat			:	result['lat'],
						lng			:	result['lng']
					};
					
					// NEW POSITION
                    mapOptions.center = searchLatLng
                    mapOptions.zoom = 14
					var map		=	new google.maps.Map(document.getElementById('map'),mapOptions);

                    setMarkers(map);
		            
				},
				error		:	function (xhr, ajaxOptions, thrownError) {
					alert(xhr.status);
					alert(thrownError);
				}
			});
		}
	}

    @auth //Gast darf keine ES erstellen
                map.addListener("click", (e) => { //Ausgefürht wenn Map-Klick
                if(!activeMarker){
                breit = e.latLng.toString().substring(1, 16);
                lang = e.latLng.toString().substring(20, 35);
                document.getElementById("LaengengradES").setAttribute('value',breit); //Koordinaten den Input Feldern hinzufügen
                document.getElementById("BreitengradES").setAttribute('value', lang);

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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDboUvk9ElphosPEFC-Am9XzHFsmnOZR7I&libraries=places&callback=initAutocomplete"></script>



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
        $es_select =  DB::select('select id, Bezeichnung, Laengengrad,Breitengrad, Postleitzahl, Katastralgemeinden from EnSys'); // ES Select mit Laravel


        $sql2 = 'SELECT id, ensys_id, Typ, Bezeichnung, Ort, Breitengrad, Laengengrad  FROM EnTech';  // ET
        $et_select = DB::select('select id, ensys_id, Typ, Bezeichnung, Ort, Laengengrad, Breitengrad from EnTech'); // ET Select mit Laravel
    

        $result = $conn->query($sql); //für SQL DB Conn
        $result2 = $conn->query($sql2); //für SQL DB Conn

      //$result = $es_select; //für laravel DB Conn
      //$result2 = $et_select; //für laravel DB Conn

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

                $locationET = "['{$row['Bezeichnung']}', {$row['Laengengrad']}, {$row['Breitengrad']}, {$row['ensys_id']}, '{$row['Typ']}', '{$row['Ort']}', '{$row['id']}']";

                array_push($locationsET, $locationET);
    
              
            }
            $conn->close();  //für SQL DB Conn


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




     } //für SQL DB Conn
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


        function augefunctionET(id){
            $('#exampleModalCenterAugeET').modal('show');
            locationsET.forEach(loc => {
                if (loc[6] == id) {
                    $("#IDESAugeET").val(loc[3]);
                    $("#IDETAugeET").val(loc[6]);
                    $("#BezeichnungAugeET").val(loc[0]);
                    $("#TypAugeET").val(loc[4]);
                    $("#OrtAugeET").val(loc[5]);
                    $("#LaengengradAugeET").val(loc[1]);
                    $("#BreitengradAugeET").val(loc[2]);
                    $("#augeFormET")
                }
            })
        }



        function ETerstellen(id){
            $('#exampleModalCenterET').modal('show');
            locationsET.forEach(loc => {
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




        function setETMarker(map, id)
        {
        
                for (let i = 0; i < locationsET.length; i++) {
                    const energietechnologie = locationsET[i];

                    let sysID = energietechnologie[3];
                    if(sysID != id){
                        continue;
                    }

                    let options = {
                        position: {
                            lat: energietechnologie[1],
                            lng: energietechnologie[2]
                        },
                        map, // 0 Bezeichnung, 1 Längengrad, 2 Breitengrad, 3 Id
                      
                        title: energietechnologie[0], //Hover 
                        //label: beach[0], // Was im Icon steht
                        label: {
                            text: energietechnologie[0],
                            color: 'black',
                            fontSize: '15px',
                            className: 'marker-position',
                        },
                        animation: google.maps.Animation.DROP //verschiedene Moduse: DROP, BOUNCE                        
                         
                    }

                    switch (energietechnologie[4]) {
                        case "PV-Anlage":
                        options.icon = "/images/icons/PV_icon.png"
                        break;

                        case "Stromnetzbezug":
                        options.icon = "/images/icons/stromnetz_icon.png"
                        break;

                        case "Batteriespeicher":
                        options.icon = "/images/icons/batterie_icon.png"
                        break;
                        
                        case "Wasserstoff Elektrolyse":
                        options.icon = "/images/icons/wasserspeicher_icon.png"
                        break;
                        
                        case "Wasserstoff Brennstoffzelle":
                        options.icon = "/images/icons/wasserspeicher_icon.png"
                        break;
                        
                        case "Wasserstoff Speicher":
                        options.icon = "/images/icons/Speicher_icon.png"
                        break;
                        
                        case "Windkraftanlage":
                        options.icon = "/images/icons/batterie_icon.png"
                        break;
                        
                        case "E-Ladestation":
                        options.icon = "/images/icons/eauto_icon.png"
                        break;
                        
                        case "Hausanschlusszähler":
                        options.icon = "/images/icons/batterie_icon.png"
                        break;
                        
                        case "Wärmenetzbezug":
                        options.icon = "/images/icons/stromnetz_icon.png"
                        break;
                        
                        case "Biomasseheizkraftwerk":
                        options.icon = "/images/icons/batterie_icon.png"
                        break;
                        
                        case "Biomasseheizwerk":
                        options.icon = "/images/icons/batterie_icon.png"
                        break;
                        
                        case "Biomasseheizkessel":
                        options.icon = "/images/icons/batterie_icon.png"
                        break;
                        
                        case "Wärmespeicher":
                        options.icon = "/images/icons/Speicher_icon.png"
                        break;
                        
                        case "Solarthermieanlage":
                        options.icon = "/images/icons/batterie_icon.png"
                        break;
                        
                        case "Wärmepumpe":
                        options.icon = "/images/icons/batterie_icon.png"
                        break;
                        
                        case "Gebäude Wärmebedarfszähler":
                        options.icon = "/images/icons/batterie_icon.png"
                        break;
                        
                        case "Kompressionskältemaschiene":
                        options.icon = "/images/icons/batterie_icon.png"
                        break;

                        case "Ab oder Adsorbtionskältemaschiene":
                        options.icon = "/images/icons/batterie_icon.png"
                        break;

                        case "Kältespeicher":
                        options.icon = "/images/icons/Speicher_icon.png"
                        break;

                        case "Gebäude Kältebedarfszähler":
                        options.icon = "/images/icons/batterie_icon.png"
                        break;
                    
                        default:
                            options.icon = "/images/icons/etgrün.png"
                            break;
                    }

                    const markerET = new google.maps.Marker(options);


                    markerET.addListener("click", () => {
                        //alert("ET pressed");
                        map.setZoom(19);
                        map.setCenter(markerET.getPosition());

                    });

                    markersArray.push(markerET);
                    
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
                    icon: '/images/icons/es.png',
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

                function unsetMarker(map){
                    
            
                    for (var i = 0; i < markersArray.length; i++ ) {
                          markersArray[i].setMap(null);
                    }
                        markersArray.length = 0;
                 

                          

                }


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
                    marker.setIcon("/images/icons/esgrün.png");
                    marker.setAnimation(google.maps.Animation.BOUNCE);
                    print_List_Energietechnologie(id);
                    
                    activeMarker = true;
                    activeClick=true;

                   

                    
                    setETMarker(map, id);
                  
                    
                


                    @auth                    
                    map.setOptions({ draggableCursor: 'url(/images/icons/etgrün.png), move' });

                    map.addListener("click", (e1) => { //Ausgefürht wenn Map-Klick
                    if(activeMarker){
                    let latLng = e1.latLng.toString();
                    breitET = parseFloat(latLng.substring(1, latLng.indexOf(","))).toFixed(9);
                    langET = parseFloat(latLng.substring(latLng.indexOf(",")+1, latLng.length)).toFixed(9);
                    document.getElementById("LaengengradET").setAttribute('value',breitET); //Koordinaten den Input Feldern hinzufügen
                    document.getElementById("BreitengradET").setAttribute('value', langET);
                    document.getElementById("IDES").setAttribute('value', id); //ID von ES einfügen
                    
                    $('#exampleModalCenterET').modal('show'); //Pop Up ET erstellen Aufruf

                    
                    
                   

                    }

                     });
                     @endauth


                });

                //Einfacher Klick um ES abzuwählen
                marker.addListener("click", () => {
                    map.setZoom(15);
                    map.setCenter(marker.getPosition());
                    marker.setIcon("/images/icons/es.png");
                    marker.setAnimation(google.maps.Animation.DROP);
                    print_List_Energiesysteme();
                    map.setOptions({ draggableCursor: 'crosshair' });
                    $('#exampleModalCenterET').modal('hide'); //Pop Up ET erstellen Aufruf                  
                    activeMarker = false;
                    if (activeClick == true){
                     unsetMarker(map);
                    }
                    
               
    

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
            ETListe += "                                        <tr class='enTechTR-{{$d->ensys_id}}' style='display:none;'>";
            ETListe += "";                                          
            ETListe += "                                            <td>{{ $d->ensys_id }}</td>"; //IDES
            ETListe += "                                            <td>{{ $d->id }}</td>"; //IDET
            ETListe += "                                            <td>{{ $d->Bezeichnung }}</td>"; //Bezeichnung
            ETListe += "                                            <td>{{ $d->Typ }}</td>"; //Typ 
            ETListe += "                                            <td>{{ $d->Ort }}</td>"; //Ort
            ETListe += "";
            ETListe += "                                            @auth";

            ETListe += "                                               @if (Auth::user()->id == $d->user_id || Auth::user()->role == 'Admin')"
            ETListe += "                                                <!-- Wenn man nicht angemeldet ist darf man die ES nicht verwalten-->";
            ETListe += "                                                <td> <a href=\"\/deleteET\/{{ $d->id }}\" class=\"btn btn2\"";
            ETListe += "                                                        style=\"background-image: url('/images/buttons/delete.png')\"><\/a><\/td>";
            ETListe += "                                                <td> <a href=\"javascript:GrafanafunctionET()\" class=\"btn btn2\"";
            ETListe += "                                                        style=\"background-image: url('/images/buttons/statistik.png')\"><\/a><\/td>";
            ETListe += "                                                <td> <a href=\"javascript:editfunctionET({{ $d->id }})\"";
            ETListe += "                                                        class=\"btn btn2\"";
            ETListe += "                                                        style=\"background-image: url('/images/buttons/stift.png')\"><\/a><\/td>";

            ETListe += "                                                @else"
            ETListe += "                                            <td> <a href=\"javascript:GrafanafunctionET()\" class=\"btn btn2\"";
            ETListe += "                                                style=\"background-image: url('/images/buttons/statistik.png')\"><\/a><\/td>";
            ETListe += "                                            <td> <a href=\"javascript:augefunctionET({{ $d->id }})\"";
            ETListe += "                                                class=\"btn btn2\"";
            ETListe += "                                                style=\"background-image: url('/images/buttons/auge.png')\"><\/a><\/td>";
            ETListe += "                                            <td> </td>"  ;  
            ETListe += "                                            @endif";
            ETListe += "                                            @endauth";
            ETListe += "";
            ETListe += "                                            @guest";
            ETListe += "                                            <td> <a href=\"javascript:GrafanafunctionET()\" class=\"btn btn2\"";
            ETListe += "                                                style=\"background-image: url('/images/buttons/statistik.png')\"><\/a><\/td>";
            ETListe += "                                            <td> <a href=\"javascript:augefunctionET({{ $d->id }})\"";
            ETListe += "                                                class=\"btn btn2\"";
            ETListe += "                                                style=\"background-image: url('/images/buttons/auge.png')\"><\/a><\/td>";
            ETListe += "                                            @endguest";
            ETListe += "";
            ETListe += "                                        <\/tr>";
            ETListe += "                                    <\/tbody>";
            ETListe += "                                @endforeach";

            
          
            ETListe += "                            <\/table>";

            document.getElementById("table").innerHTML = ETListe;

            $(".enTechTR-" + id).css("display", "table-row");

                document.getElementById("Listuberschrieft").innerHTML = "Energietechnologien";
                document.getElementById("Listimage").src = "/images/icons/etgrün.png";
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
                        EnsysListe += "                                               @if (Auth::user()->id == $d->user_id || Auth::user()->role == 'Admin')"

                        EnsysListe += "                                                <!-- Wenn man nicht angemeldet ist darf man die ES nicht verwalten-->";
                        EnsysListe += "                                                <td> <a href=\"\/delete\/{{ $d->id }}\" class=\"btn btn2\"";
                        EnsysListe += "                                                        style=\"background-image: url('/images/buttons/delete.png')\"><\/a><\/td>";
                        EnsysListe += "                                                <td> <a href=\"javascript:GrafanafunctionES()\" class=\"btn btn2\"";
                        EnsysListe += "                                                        style=\"background-image: url('/images/buttons/statistik.png')\"><\/a><\/td>";
                        EnsysListe += "                                                <td> <a href=\"javascript:editfunction({{ $d->id }})\"";
                        EnsysListe += "                                                        class=\"btn btn2\"";
                        EnsysListe += "                                                        style=\"background-image: url('/images/buttons/stift.png')\"><\/a><\/td>";

                        EnsysListe += "                                                @else"
                        EnsysListe += "                                            <td> <a href=\"javascript:GrafanafunctionET()\" class=\"btn btn2\"";
                        EnsysListe += "                                                style=\"background-image: url('/images/buttons/statistik.png')\"><\/a><\/td>";
                        EnsysListe += "                                            <td> <a href=\"javascript:augefunctionET({{ $d->id }})\"";
                        EnsysListe += "                                                class=\"btn btn2\"";
                        EnsysListe += "                                                style=\"background-image: url('/images/buttons/auge.png')\"><\/a><\/td>";
                        EnsysListe += "                                            <td> </td> ";   
                        EnsysListe += "                                            @endif";
                        EnsysListe += "                                            @endauth";
                        EnsysListe += "";
                        EnsysListe += "                                            @guest";
                        EnsysListe += "                                            <td> <a href=\"javascript:GrafanafunctionES()\" class=\"btn btn2\"";
                        EnsysListe += "                                                style=\"background-image: url('/images/buttons/statistik.png')\"><\/a><\/td>";
                        EnsysListe += "                                            <td> <a href=\"javascript:augefunction({{ $d->id }})\"";
                        EnsysListe += "                                                class=\"btn btn2\"";
                        EnsysListe += "                                                style=\"background-image: url('/images/buttons/auge.png')\"><\/a><\/td>";
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
            document.getElementById("Listimage").src = "/images/icons/es.png";
        }



      
      




    </script>




@endsection
@section('foooter')
