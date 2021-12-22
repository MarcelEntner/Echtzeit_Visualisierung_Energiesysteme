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

                    <input id="address" type="text">
                    <!--- INPUT FELD ZUM SUCHEN -->
                    <div id="find" class="btn btn-success">Suchen</div>
                    <!--- BUTTON ZUM SUCHEN -->

                    <div class="shadow-lg rounded p-3">
                        <div class="d-flex flex-column">
                            <div class="d-flex justify-content-between">
                                <h3> <b id="Listuberschrieft">Energiesysteme</b> <img src="/images/icons/es.png"
                                        id="Listimage"></h3>
                                <!--<input class="form-control form-control2" placeholder="Suchen" aria-label="Search">-->
                            </div>


                        </div>
                        <br>



                        <!-- DataTable -> Th und Td müssen gleiche Anzahl haben-->

                        <!-- Main Liste class="table-responsive" -->
                        <div style="height: 41vh; width:100%;">

                           <!-- style="height: 30vh;" -->
                            <div id="tableDiv">
                                <table class="table table-borderless table-hover" id="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Bezeichnung</th>
                                            <th scope="col">Katastralgemeinde</th>
                                            <th scope="col">Postleitzahl</th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $d)

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
                                                    <!-- Nur der Ersteller eines ES darf dieses auch bearbeiten + Admin (Rolle Admin) darf alle -->



                                                    @if ($userID->id == $d->user_id || $userID->role == 'Admin')


                                                        <td id="hov"> <a href="/delete/{{ $d->id }}"
                                                                class="btn btn2"
                                                                style="background-image: url('/images/buttons/delete.png')"></a>
                                                        </td>

                                                        <td id="hov"> <a href="javascript:GrafanafunctionES()"
                                                                class="btn btn2"
                                                                style="background-image: url('/images/buttons/statistik.png')"></a>
                                                        </td>

                                                        <td id="hov"> <a href="javascript:editfunction({{ $d->id }})"
                                                                class="btn btn2"
                                                                style="background-image: url('/images/buttons/stift.png')"></a>
                                                        </td>


                                                    @else

                                                        <td> <a href="javascript:GrafanafunctionES()" class="btn btn2"
                                                                style="background-image: url('/images/buttons/statistik.png')"></a>
                                                        </td>
                                                        <td> <a href="javascript:augefunction({{ $d->id }})"
                                                                class="btn btn2"
                                                                style="background-image: url('/images/buttons/auge.png')"></a>
                                                        </td>

                                                        <td> </td>

                                                    @endif



                                                @endauth



                                                @guest
                                                    <td> <a href="javascript:GrafanafunctionES()" class="btn btn2"
                                                            style="background-image: url('/images/buttons/statistik.png')"></a>
                                                    </td>
                                                    <td> <a href="javascript:augefunction({{ $d->id }})"
                                                            class="btn btn2"
                                                            style="background-image: url('/images/buttons/auge.png')"></a></td>
                                                    <td></td>
                                                @endguest

                                            </tr>

                                        @endforeach
                                    </tbody>
                                   
                                </table>
                            </div>

                            <div id="tableETDiv" style="display: none">
                                <!-- ET Liste style="height: 30vh;" -->
                                <table class="table table-borderless table-hover" id="tableET">
                                    <thead>
                                        <tr>
                                            <th scope="col">IDES</th>
                                            <th scope="col">IDET</th>
                                            <th scope="col">Bezeichnung</th>
                                            <th scope="col">Typ</th>
                                            <th scope="col">Ort</th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        
                                        @foreach ($dataEnTech as $d)
                                        
                                            <tr class="enTechTR-{{ $d->ensys_id }}" style='display:none;'>

                                                <td>{{ $d->ensys_id }}</td>
                                                <td>{{ $d->id }}</td>
                                                <td>{{ $d->Bezeichnung }}</td>
                                                <td>{{ $d->Typ }}</td>
                                                <td>{{ $d->Ort }}</td>
                                                @auth

                                                    @if (Auth::user()->id == $d->user_id || Auth::user()->role == 'Admin')
                                                        <!-- Wenn man nicht angemeldet ist darf man die ES nicht verwalten-->
                                                        <td> <a href="/deleteET/{{ $d->id }}" class="btn btn2"
                                                                style="background-image: url('/images/buttons/delete.png')"></a>
                                                        </td>

                                                        <td> <a href="javascript:GrafanafunctionET()" class="btn btn2"
                                                                style="background-image: url('/images/buttons/statistik.png')"></a>
                                                        </td>

                                                        <td> <a href="javascript:editfunctionET({{ $d->id }})"
                                                                class="btn btn2"
                                                                style="background-image: url('/images/buttons/stift.png')"></a>
                                                        </td>

                                                    @else
                                                        <td> <a href="javascript:GrafanafunctionET()\" class="btn btn2"
                                                                style="background-image: url('/images/buttons/statistik.png')"></a>
                                                        </td>

                                                        <td> <a href="javascript:augefunctionET({{ $d->id }})"
                                                                class="btn btn2"
                                                                style="background-image: url('/images/buttons/auge.png')"></a>
                                                        </td>

                                                        <td> </td>
                                                    @endif
                                                @endauth

                                                @guest
                                                    <td> <a href="javascript:GrafanafunctionET()" class="btn btn2"
                                                            style="background-image: url('/images/buttons/statistik.png')"></a>
                                                    </td>

                                                    <td> <a href="javascript:augefunctionET({{ $d->id }})"
                                                            class="btn btn2"
                                                            style="background-image: url('/images/buttons/auge.png')"></a></td>
                                                    <td></td>
                                                @endguest

                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>




                            <div id="tableESDiv" style="display: none">
                                <!-- ES Liste style="height: 30vh; -->
                                <table class="table table-borderless table-hover" id="tableES" >
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Bezeichnung</th>
                                            <th scope="col">Katastralgemeinde</th>
                                            <th scope="col">Postleitzahl</th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($data as $d)
                                            <tr>
                                                <td>{{ $d->id }}</td>
                                                <td>{{ $d->Bezeichnung }}</td>
                                                <td>{{ $d->Katastralgemeinden }}</td>
                                                <td>{{ $d->Postleitzahl }}</td>

                                                @auth
                                                    @if (Auth::user()->id == $d->user_id || Auth::user()->role == 'Admin')

                                                        <!-- Wenn man nicht angemeldet ist darf man die ES nicht verwalten-->
                                                        <td> <a href="/delete/{{ $d->id }}" class="btn btn2"
                                                                style="background-image: url('/images/buttons/delete.png')"></a>
                                                        </td>

                                                        <td> <a href="javascript:GrafanafunctionES()" class="btn btn2"
                                                                style="background-image: url('/images/buttons/statistik.png')"></a>
                                                        </td>

                                                        <td> <a href="javascript:editfunction({{ $d->id }})"
                                                                class="btn btn2"
                                                                style="background-image: url('/images/buttons/stift.png')"></a>
                                                        </td>

                                                    @else
                                                        <td> <a href="javascript:GrafanafunctionES()" class="btn btn2"
                                                                style="background-image: url('/images/buttons/statistik.png')"></a>
                                                        </td>

                                                        <td> <a href="javascript:augefunction({{ $d->id }})"
                                                                class="btn btn2"
                                                                style="background-image: url('/images/buttons/auge.png')"></a>
                                                        </td>
                                                        <td> </td>
                                                    @endif
                                                @endauth

                                                @guest
                                                    <td> <a href="javascript:GrafanafunctionES()" class="btn btn2"
                                                            style="background-image: url('/images/buttons/statistik.png')"></a>
                                                    </td>

                                                    <td> <a href="javascript:augefunction({{ $d->id }})"
                                                            class="btn btn2"
                                                            style="background-image: url('/images/buttons/auge.png')"></a></td>
                                                    <td></td>
                                                @endguest

                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>




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
                            <h5 class="modal-title modal2-title" id="exampleModalLongTitle">Energiesystem <img
                                    src="/images/icons/es2.png"></h5>
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
                                    <input type="text" class="form-control3" id="BezeichnungES" name="BezeichnungES"
                                        aria-label="Bezeichnung" aria-describedby="basic-addon1" placeholder="MicroGridLab">
                                </div>
                                <div class="input-group mb-3" style="margin-top:5%">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                        <img src="/images/pop-up/katastralgemeinde.png" style="margin-right:10px;">
                                        Katastralgemeinde</span>
                                    <input type="text" class="form-control3" id="KatastralgemeindenES"
                                        name="KatastralgemeindenES" aria-label="Katastralgemeinden"
                                        aria-describedby="basic-addon1" placeholder="Wieselburg">
                                </div>
                                <div class="input-group mb-3" style="margin-top:5%">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                        <img src="/images/pop-up/postleitzahl.png" style="margin-right:10px;">
                                        Postleitzahl</span>
                                    <input type="text" class="form-control3" id="PostleitzahlES" name="PostleitzahlES"
                                        aria-label="Postleitzahl" aria-describedby="basic-addon1" placeholder="3250">
                                </div>
                                <div class="input-group mb-3" style="margin-top:5%">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                        <img src="/images/pop-up/längengrad.png" style="margin-right:10px;">
                                        Längengrad</span>
                                    <input type="text" class="form-control3" id="LaengengradES" name="LaengengradES"
                                        aria-label="LaengengradES" aria-describedby="basic-addon1" readonly>
                                </div>
                                <div class="input-group mb-3" style="margin-top:5%">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                        <img src="/images/pop-up/breitengrad.png" style="margin-right:10px;">
                                        Breitengrad</span>
                                    <input type="text" class="form-control3" id="BreitengradES" name="BreitengradES"
                                        aria-label="BreitengradES" aria-describedby="basic-addon1" readonly>
                                </div>


                                <br>
                                <!--  <button type="button" class="btn btn3" data-dismiss="modal">Close</button>-->
                                <input type="submit" class="btn btn-success" style="margin-left:30%" id="ESerstellen"
                                    value="Energiesystem erstellen">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal ES hinzufügen aus -->



            <!-- Modal ET hinzufügen -->
            <div class="modal modal2 fade" id="exampleModalCenterET" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal2-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title modal2-title" id="exampleModalLongTitle">Energietechnologie <img
                                    src="/images/icons/etgrün2.png"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form action="{{ route('EnTech.store') }}" id="ETerstellen" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group mb-3" style="margin-top:2%">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                        <img src="/images/pop-up/id.png" style="margin-right:10px;">
                                        ID-ES</span>
                                    <input type="text" class="form-control3" id="IDES" name="IDES" readonly
                                        aria-label="ID-ES" aria-describedby="basic-addon1">
                                </div>

                                <div class="input-group mb-3" style="margin-top:2%">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                        <img src="/images/pop-up/name.png" style="margin-right:10px;">
                                        Bezeichnung</span>
                                    <input type="text" class="form-control3" id="BezeichnungET" name="Bezeichnung"
                                        placeholder="Bezeichung" aria-label="BezeichnungET" aria-describedby="basic-addon1">
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
                                        <option value="Ab oder Adsorbtionskältemaschiene"> Ab oder Adsorbtionskältemaschiene
                                        </option>
                                        <option value="Kältespeicher">Kältespeicher</option>
                                        <option value="Gebäude Kältebedarfszähler">Gebäude Kältebedarfszähler</option>
                                    </select>
                                </div>

                                <div class="input-group mb-3" style="margin-top:2%">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                        <img src="/images/pop-up/ort.png" style="margin-right:10px;">
                                        Ort</span>
                                    <input type="text" class="form-control3" id="OrtET" name="Ort" placeholder="Dach"
                                        aria-label="OrtET" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3" style="margin-top:2%">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                        <img src="/images/pop-up/längengrad.png" style="margin-right:10px;">
                                        Längengrad</span>
                                    <input type="text" class="form-control3" id="LaengengradET" name="Laengengrad"
                                        aria-label="LängengradET" aria-describedby="basic-addon1" readonly>
                                </div>
                                <div class="input-group mb-3" style="margin-top:2%">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                        <img src="/images/pop-up/breitengrad.png" style="margin-right:10px;">
                                        Breitengrad</span>
                                    <input type="text" class="form-control3" id="BreitengradET" name="Breitengrad"
                                        aria-label="BreitengradET" aria-describedby="basic-addon1" readonly>
                                </div>
                                <div class="input-group mb-3" style="margin-top:5%">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                        <img src="/images/pop-up/bild.png" style="margin-right:10px;">
                                        Bild einfügen</span>
                                        <input type="file" class="form-control3" id="imageET" name="imageET" value="">
                                </div>
                                <div class="input-group mb-3" style="margin-top:2%">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                        <img src="/images/pop-up/beschreibung.png" style="margin-right:10px;">
                                        Beschreibung</span>
                                    <input type="text" class="form-control3" id="BeschreibungET" name="BeschreibungET" placeholder="..."
                                        aria-label="BeschreibungET" aria-describedby="basic-addon1">
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

        <!-- Modal ET hinzufügen aus -->


        <!-- ModalEditES -->
        <div class="modal modal2 fade" id="exampleModalCenterEdit" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal2-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title modal2-title" id="exampleModalLongTitle">Energiesystem <img
                                src="/images/icons/esgrün2.png"></h5>
                        </h5>
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
                                <input type="text" class="form-control3" id="bezeichnung" name="Bezeichnung" value=""
                                    aria-label="Bezeichnung" aria-describedby="basic-addon1">
                            </div>

                            <div class="input-group mb-3" style="margin-top:5%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/katastralgemeinde.png" style="margin-right:10px;">
                                    Katastralgemeinde</span>
                                <input type="text" class="form-control3" id="katastralgemeinde" name="Katastralgemeinden"
                                    value="" aria-label="Katastralgemeinden" aria-describedby="basic-addon1">
                            </div>

                            <div class="input-group mb-3" style="margin-top:5%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/postleitzahl.png" style="margin-right:10px;">
                                    Postleitzahl</span>
                                <input type="text" class="form-control3" id="postleitzahl" name="Postleitzahl" value=""
                                    aria-label="Postleitzahl" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3" style="margin-top:5%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/längengrad.png" style="margin-right:10px;">
                                    Längengrad</span>
                                <input type="text" class="form-control3" id="LaengengradEdit" name="Laengengrad" value=""
                                    aria-label="Laengengrad" aria-describedby="basic-addon1" readonly style="background-color:#e9ecef">
                            </div>
                            <div class="input-group mb-3" style="margin-top:5%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/breitengrad.png" style="margin-right:10px;">
                                    Breitengrad</span>
                                <input type="text" class="form-control3" id="BreitengradEdit" name="Breitengrad" value=""
                                    readonly aria-label="Breitengrad" aria-describedby="basic-addon1" style="background-color:#e9ecef">
                            </div>

                            <details closed>
                                <summary>Mehr Details zu diesem Energiesystem</summary>
                           
                            <div class="input-group mb-3" style="margin-top:5%;">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:250px;">
                                    <img src="/images/pop-up/erzeugertechnologien.png" style="margin-right:10px;">
                                    Az-Erzeugungstechnologien</span>
                                <input type="text" class="form-control3" id="Az-Erzeugungstechnologien" name="Az-Erzeugungstechnologien"
                                    aria-label="Az-Erzeugungstechnologien" aria-describedby="basic-addon1" value="" 
                                    style="width:180px; background-color:#e9ecef;" readonly >
                            </div>

                            
                            <div class="input-group mb-3" style="margin-top:5%;">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:250px;">
                                    <img src="/images/pop-up/verbraucher.png" style="margin-right:10px;">
                                    Az-Verbraucher</span>
                                <input type="text" class="form-control3" id="Az-Verbraucher" name="Az-Verbraucher"
                                    aria-label="Az-Verbraucher" aria-describedby="basic-addon1" value="" 
                                    style="width:180px; background-color:#e9ecef;" readonly >
                            </div>

                            <div class="input-group mb-3" style="margin-top:5%;">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:250px;">
                                    <img src="/images/pop-up/azspeicher.png" style="margin-right:10px;">
                                    Az-Speicher</span>
                                <input type="text" class="form-control3" id="Az-Speicher" name="Az-Speicher"
                                    aria-label="Az-Speicher" aria-describedby="basic-addon1" value="" 
                                    style="width:180px; background-color:#e9ecef;" readonly >
                            </div>

                            <div class="input-group mb-3" style="margin-top:5%;">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:250px;">
                                    <img src="/images/pop-up/leistung.png" style="margin-right:10px;">
                                    Ges-Nennleistung</span>
                                <input type="text" class="form-control3" id="Ges-Nennleistung" name="Ges-Nennleistung"
                                    aria-label="Ges-Nennleistung" aria-describedby="basic-addon1" value="" 
                                    style="width:180px; background-color:#e9ecef;" readonly>
                            </div>

                            <div class="input-group mb-3" style="margin-top:5%;">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:250px;">
                                    <img src="/images/pop-up/energie.png" style="margin-right:10px;">
                                    Ges-Energie</span>
                                <input type="text" class="form-control3" id="Ges-Energie" name="Ges-Energie"
                                    aria-label="Ges-Energie" aria-describedby="basic-addon1" value="" 
                                    style="width:180px; background-color:#e9ecef;" readonly >
                            </div>

                            <div class="input-group mb-3" style="margin-top:5%;">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:250px;">
                                    <img src="/images/pop-up/gesamtverleistung.png" style="margin-right:10px;">
                                    Ges-VerbraucherLeistung</span>
                                <input type="text" class="form-control3" id="Ges-VerbraucherLeistung" name="Ges-VerbraucherLeistung"
                                    aria-label="Ges-VerbraucherLeistung" aria-describedby="basic-addon1" value="" 
                                    style="width:180px; background-color:#e9ecef;" readonly >
                            </div>

                            <div class="input-group mb-3" style="margin-top:5%;">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:250px;">
                                    <img src="/images/pop-up/gesverenergie.png" style="margin-right:10px;">
                                    Ges-VerbraucherEnergie</span>
                                <input type="text" class="form-control3" id="Ges-VerbraucherEnergie" name="Ges-VerbraucherEnergie"
                                    aria-label="Ges-VerbraucherEnergie" aria-describedby="basic-addon1" value="" 
                                    style="width:180px; background-color:#e9ecef;" readonly >
                            </div>

                            <div class="input-group mb-3" style="margin-top:5%;">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:250px;">
                                    <img src="/images/pop-up/gesspeicherkap.png" style="margin-right:10px;">
                                    Ges-SpeicherKapazität</span>
                                <input type="text" class="form-control3" id="Ges-SpeicherKapazität" name="Ges-SpeicherKapazität"
                                    aria-label="Ges-SpeicherKapazität" aria-describedby="basic-addon1" value="" 
                                    style="width:180px; background-color:#e9ecef;" readonly >
                            </div>

                            <div class="input-group mb-3" style="margin-top:5%;">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:250px;">
                                    <img src="/images/pop-up/netzbezug.png" style="margin-right:10px;">
                                    Aktueller Netzbezug</span>
                                <input type="text" class="form-control3" id="Aktueller Netzbezug" name= "Aktueller Netzbezug"
                                    aria-label="Aktueller Netzbezug" aria-describedby="basic-addon1" value="" 
                                    style="width:180px; background-color:#e9ecef;" readonly >
                            </div>
                        </details>
                                


                            <br>
                            <input type="submit" class="btn  btn-success" style="margin-left:30%"
                                value="Energiesystem aktualisieren">

                        </form>






                    </div>


                </div>
            </div>
        </div>
        <!-- ModalEditES aus -->



        <!-- ModalEdit ET -->
        <div class="modal modal2 fade" id="exampleModalCenterEditET" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal2-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title modal2-title" id="exampleModalLongTitle">Energietechnologie <img
                                src="/images/icons/etgrün2.png"></h5>
                        </h5>
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
                                <input type="text" class="form-control3" id="idEditES" name="idEditES" value=""
                                    aria-label="ID-ES" aria-describedby="basic-addon1" readonly style="background-color:#e9ecef;">
                            </div>

                            <div class="input-group mb-3" style="margin-top:2%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/id.png" style="margin-right:10px;">
                                    ID Energietechnologie</span>
                                <input type="text" class="form-control3" id="idEditET" name="idEditET" value=""
                                    aria-label="idEditET" aria-describedby="basic-addon1" readonly style="background-color:#e9ecef;">
                            </div>

                            <div class="input-group mb-3" style="margin-top:2%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/name.png" style="margin-right:10px;">
                                    Bezeichnung</span>
                                <input type="text" class="form-control3" id="BezeichnungEditET" name="BezeichnungEditET"
                                    value="" aria-label="BezeichnungEditET" aria-describedby="basic-addon1">
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
                                    <option value="Ab oder Adsorbtionskältemaschiene"> Ab oder Adsorbtionskältemaschiene
                                    </option>
                                    <option value="Kältespeicher">Kältespeicher</option>
                                    <option value="Gebäude Kältebedarfszähler">Gebäude Kältebedarfszähler</option>
                                </select>
                            </div>

                            <div class="input-group mb-3" style="margin-top:2%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/ort.png" style="margin-right:10px;">
                                    Ort </span>
                                <input type="text" class="form-control3" id="OrtEditET" name="OrtEditET" value=""
                                    aria-label="OrtEditET" aria-describedby="basic-addon1">
                            </div>

                            <div class="input-group mb-3" style="margin-top:2%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/längengrad.png" style="margin-right:10px;">
                                    Längengrad</span>
                                <input type="text" class="form-control3" id="LaengengradEditET" name="LaengengradEditET"
                                    value="" readonly aria-label="LaengengradEditET" aria-describedby="basic-addon1" style="background-color:#e9ecef;"> 
                            </div>

                            <div class="input-group mb-3" style="margin-top:2%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/breitengrad.png" style="margin-right:10px;">
                                    Breitgengrad</span>
                                <input type="text" class="form-control3" id="BreitengradEditET" name="BreitengradEditET"
                                    value="" readonly aria-label="BreitengradEditET" aria-describedby="basic-addon1" style="background-color:#e9ecef;">
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


        <!-- Grafana ES -->
        <div class="modal modal2 fade" id="exampleModalCenterGrafanaES" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal2-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title modal2-title" id="exampleModalLongTitle">Grafana-Statistiken Energiesysteme
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        

                        <!--Grafana Statistik iframe
                        <iframe src="http://192.168.1.5:3000/d-solo/zlzP3wmgk/raumklimav2?orgId=1&from=1639334652637&to=1639507452638&panelId=2" width="800" height="1000" frameborder="0"></iframe>
                    -->
                    </div>


                </div>
            </div>
        </div>
        <!-- Grafana ES aus -->



        <!-- Grafana ET -->
        <div class="modal modal2 fade" id="exampleModalCenterGrafanaET" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal2-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title modal2-title" id="exampleModalLongTitle">Grafana-Statistiken
                            Energietechnologie</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">


                    </div>


                </div>
            </div>
        </div>
        <!-- Grafana ET aus -->



        <!-- ModalAuge ES -->
        <div class="modal modal2 fade" id="exampleModalCenterAuge" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal2-dialog modal-dialog-centered" role="document" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title modal2-title" id="exampleModalLongTitle">Energiesystem <img
                            src="/images/icons/esgrün2.png"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <h3 style="text-align: center;"> Weitere Details </h3>
                        <form id="augeForm" method="GET">
                            <!-- wird nur am Seitenaufruf gemacht und nicht zwischendurch-->
                            @csrf
                            <div class="input-group mb-3" style="margin-top:2%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/name.png" style="margin-right:10px;">
                                    Bezeichnung</span>
                                <input type="text" class="form-control3" id="bezeichnunga" name="Bezeichnung"
                                    aria-label="Bezeichnung" aria-describedby="basic-addon1" value="" readonly style="background-color:#e9ecef;">
                            </div>

                            <div class="input-group mb-3" style="margin-top:5%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/katastralgemeinde.png" style="margin-right:10px;">
                                    Katastralgemeinde</span>
                                <input type="text" class="form-control3" id="katastralgemeindea" name="Katastralgemeinden"
                                    value="" aria-label="Katastralgemeinde" aria-describedby="basic-addon1" readonly style="background-color:#e9ecef;">
                            </div>

                            <div class="input-group mb-3" style="margin-top:5%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/postleitzahl.png" style="margin-right:10px;">
                                    Postleitzahl</span>
                                <input type="text" class="form-control3" id="postleitzahla" name="Postleitzahl" value=""
                                    aria-label="Postleitzahl" aria-describedby="basic-addon1" readonly style="background-color:#e9ecef;">
                            </div>

                            <div class="input-group mb-3" style="margin-top:5%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/längengrad.png" style="margin-right:10px;">
                                    Längengrad</span>
                                <input type="text" class="form-control3" id="LaengengradEdita" name="Laengengrad"
                                    aria-label="Laengengrad" aria-describedby="basic-addon1" value="" readonly style="background-color:#e9ecef;">
                            </div>

                            <div class="input-group mb-3" style="margin-top:5%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/breitengrad.png" style="margin-right:10px;">
                                    Breitengrad</span>
                                <input type="text" class="form-control3" id="BreitengradEdita" name="Breitengrad"
                                    aria-label="Breitengrad" aria-describedby="basic-addon1" value="" readonly style="background-color:#e9ecef;">
                            </div>

                            <details closed>
                                <summary>Mehr Details zu diesem Energiesystem</summary>

                            <div class="input-group mb-3" style="margin-top:5%;">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:250px;">
                                    <img src="/images/pop-up/erzeugertechnologien.png" style="margin-right:10px;">
                                    Az-Erzeugungstechnologien</span>
                                <input type="text" class="form-control3" id="Az-Erzeugungstechnologien" name="Az-Erzeugungstechnologien"
                                    aria-label="Az-Erzeugungstechnologien" aria-describedby="basic-addon1" value="" 
                                    style="width:180px; background-color:#e9ecef;" readonly>
                            </div>

                            
                            <div class="input-group mb-3" style="margin-top:5%;">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:250px;">
                                    <img src="/images/pop-up/verbraucher.png" style="margin-right:10px;">
                                    Az-Verbraucher</span>
                                <input type="text" class="form-control3" id="Az-Verbraucher" name="Az-Verbraucher"
                                    aria-label="Az-Verbraucher" aria-describedby="basic-addon1" value="" 
                                    style="width:180px; background-color:#e9ecef;" readonly>
                            </div>

                            <div class="input-group mb-3" style="margin-top:5%;">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:250px;">
                                    <img src="/images/pop-up/azspeicher.png" style="margin-right:10px;">
                                    Az-Speicher</span>
                                <input type="text" class="form-control3" id="Az-Speicher" name="Az-Speicher"
                                    aria-label="Az-Speicher" aria-describedby="basic-addon1" value="" 
                                    style="width:180px; background-color:#e9ecef;" readonly>
                            </div>

                            <div class="input-group mb-3" style="margin-top:5%;">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:250px;">
                                    <img src="/images/pop-up/leistung.png" style="margin-right:10px;">
                                    Ges-Nennleistung</span>
                                <input type="text" class="form-control3" id="Ges-Nennleistung" name="Ges-Nennleistung"
                                    aria-label="Ges-Nennleistung" aria-describedby="basic-addon1" value="" 
                                    style="width:180px; background-color:#e9ecef;" readonly>
                            </div>

                            <div class="input-group mb-3" style="margin-top:5%;">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:250px;">
                                    <img src="/images/pop-up/energie.png" style="margin-right:10px;">
                                    Ges-Energie</span>
                                <input type="text" class="form-control3" id="Ges-Energie" name="Ges-Energie"
                                    aria-label="Ges-Energie" aria-describedby="basic-addon1" value="" 
                                    style="width:180px; background-color:#e9ecef;" readonly>
                            </div>

                            <div class="input-group mb-3" style="margin-top:5%;">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:250px;">
                                    <img src="/images/pop-up/gesamtverleistung.png" style="margin-right:10px;">
                                    Ges-VerbraucherLeistung</span>
                                <input type="text" class="form-control3" id="Ges-VerbraucherLeistung" name="Ges-VerbraucherLeistung"
                                    aria-label="Ges-VerbraucherLeistung" aria-describedby="basic-addon1" value="" 
                                    style="width:180px; background-color:#e9ecef;" readonly>
                            </div>

                            <div class="input-group mb-3" style="margin-top:5%;">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:250px;">
                                    <img src="/images/pop-up/gesverenergie.png" style="margin-right:10px;">
                                    Ges-VerbraucherEnergie</span>
                                <input type="text" class="form-control3" id="Ges-VerbraucherEnergie" name="Ges-VerbraucherEnergie"
                                    aria-label="Ges-VerbraucherEnergie" aria-describedby="basic-addon1" value="" 
                                    style="width:180px; background-color:#e9ecef;" readonly>
                            </div>

                            <div class="input-group mb-3" style="margin-top:5%;">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:250px;">
                                    <img src="/images/pop-up/gesspeicherkap.png" style="margin-right:10px;">
                                    Ges-SpeicherKapazität</span>
                                <input type="text" class="form-control3" id="Ges-SpeicherKapazität" name="Ges-SpeicherKapazität"
                                    aria-label="Ges-SpeicherKapazität" aria-describedby="basic-addon1" value="" 
                                    style="width:180px; background-color:#e9ecef;" readonly>
                            </div>

                            <div class="input-group mb-3" style="margin-top:5%;">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:250px;">
                                    <img src="/images/pop-up/netzbezug.png" style="margin-right:10px;">
                                    Aktueller Netzbezug</span>
                                <input type="text" class="form-control3" id="Aktueller Netzbezug" name= "Aktueller Netzbezug"
                                    aria-label="Aktueller Netzbezug" aria-describedby="basic-addon1" value="" 
                                    style="width:180px; background-color:#e9ecef;" readonly>
                            </div>

                        </details>

                        </form>


                    </div>


                </div>
            </div>
        </div>
        <!-- ModalAuge ES aus -->



        <!-- ModalAuge ET -->
        <div class="modal modal2 fade" id="exampleModalCenterAugeET" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal2-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title modal2-title" id="exampleModalLongTitle">Energietechnologie <img
                            src="/images/icons/etgrün2.png"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <h3 style="text-align: center;"> Weitere Details </h3>
                        <form id="augeFormET" method="GET">
                            <!-- wird nur am Seitenaufruf gemacht und nicht zwischendurch-->
                            @csrf
                            <div class="input-group mb-3" style="margin-top:2%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/id.png" style="margin-right:10px;">
                                    ID-ES</span>
                                <input type="text" class="form-control3" id="IDESAugeET" name="IDESAugeET" aria-label="IDESAugeET" aria-describedby="basic-addon1"
                                    value="" readonly style="background-color:#e9ecef;">
                            </div>

                            <div class="input-group mb-3" style="margin-top:2%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/id.png" style="margin-right:10px;">
                                    ID-ET</span>
                                <input type="text" class="form-control3" id="IDETAugeET"  aria-label="IDETAugeET" aria-describedby="basic-addon1"
                                    name="IDETAugeET" value="" readonly style="background-color:#e9ecef;">
                            </div>

                            <div class="input-group mb-3" style="margin-top:2%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/name.png" style="margin-right:10px;">
                                    Bezeichnung</span>
                                <input type="text" class="form-control3" id="BezeichnungAugeET"  aria-label="BezeichnungAugeET" aria-describedby="basic-addon1"
                                    name="Postleitzahl" value="" readonly style="background-color:#e9ecef;">
                            </div>

                            <div class="input-group mb-3" style="margin-top:2%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/typ.png" style="margin-right:10px;">
                                    Typ</span>                                
                                <input type="text" class="form-control3" id="TypAugeET" name="Laengengrad"
                                    value="" readonly style="background-color:#e9ecef;">
                            </div>

                            <div class="input-group mb-3" style="margin-top:2%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/ort.png" style="margin-right:10px;">
                                    Ort</span>                                
                                <input type="text" class="form-control3" id="OrtAugeET" name="Breitengrad"
                                    value="" readonly style="background-color:#e9ecef;">
                            </div>

                            <div class="input-group mb-3" style="margin-top:2%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/längengrad.png" style="margin-right:10px;">
                                    Längengrad</span>                                   
                                <input type="text" class="form-control3" id="LaengengradAugeET"
                                    name="Breitengrad" value="" readonly style="background-color:#e9ecef;">
                            </div>

                            <div class="input-group mb-3" style="margin-top:2%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/breitengrad.png" style="margin-right:10px;">
                                    Breitengrad</span>                                   
                                <input type="text" class="form-control3" id="BreitengradAugeET"
                                    name="Breitengrad" value="" readonly style="background-color:#e9ecef;">
                            </div>
                        </form>


                    </div>


                </div>
            </div>
        </div>
        <!-- ModalAuge ET aus -->



        <script>
            $('#table').DataTable({
                "columnDefs": [{
                        "orderable": false,
                        "targets": 4
                    }, //Um die Sortierfunktion bei den Icons zu deaktivieren
                    {
                        "orderable": false,
                        "targets": 5
                    },
                    {
                        "orderable": false,
                        "targets": 6
                    }
                ],
                lengthChange: false,  //Auswahl wieviele Pro Seite man sehen möchte

                lengthMenu: [5], //Wieviele ES/ET pro Seite angezeigt werden 
                language: {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
                }

            });

            
            $('#tableET').DataTable({
                "columnDefs": [{
                        "orderable": false,
                        "targets": 5
                    }, //Um die Sortierfunktion bei den Icons zu deaktivieren
                    {
                        "orderable": false,
                        "targets": 6
                    },
                    {
                        "orderable": false,
                        "targets": 7
                    }
                ],
                lengthChange: false,

                lengthMenu: [100], //Wieviele ES/ET pro Seite angezeigt werden 
                language: {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
                }
            });

            $('#tableES').DataTable({
                "columnDefs": [{
                        "orderable": false,
                        "targets": 4
                    }, //Um die Sortierfunktion bei den Icons zu deaktivieren
                    {
                        "orderable": false,
                        "targets": 5
                    },
                    {
                        "orderable": false,
                        "targets": 6
                    }
                ],
                lengthChange: false,

                lengthMenu: [5], //Wieviele ES/ET pro Seite angezeigt werden 
                language: {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
                }
            });
        </script>
    </body>






    <!-- Hier gehört der API Key eingebunden   -->

    <!-- Kronstana API Key: AIzaSyDiSVawVLzIwn_GksL2Mc6HjoEqWhBfXvs-->
    <!-- Entner API Key: AIzaSyDboUvk9ElphosPEFC-Am9XzHFsmnOZR7I-->

    <!--   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDboUvk9ElphosPEFC-Am9XzHFsmnOZR7I&callback=LoadMap">
    </script>--> 



    <script>
        var activeMarker = false;
        var activeClick = false;
        var markersArray = [];

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

            autocomplete = new google.maps.places.Autocomplete((document.getElementById('address')), {
                types: ['geocode']
            });


            var map = new google.maps.Map(document.getElementById('map'), mapOptions);

            // START BY CLICK
            $('div#find').on('click', function() {
                LatLngSearch();
            });

            // START BY PRESS ENTER
            $('#address').bind("enterKey", function(e) {
                LatLngSearch();
            });
            $('#address').keyup(function(e) {
                if (e.keyCode == 13) {
                    LatLngSearch();
                }
            });

            // SHOW LAT LNG		
            function LatLngSearch() {

                var value = $('input#address').val();

                if (value) {
                    var request = $.ajax({
                        url: "/mapsLocation",
                        method: "GET",
                        data: {
                            address: value
                        },
                        dataType: 'json',
                        success: function(result) {

                            var searchLatLng = {
                                lat: result['lat'],
                                lng: result['lng']
                            };

                            // NEW POSITION
                            mapOptions.center = searchLatLng
                            mapOptions.zoom = 14
                            var map = new google.maps.Map(document.getElementById('map'), mapOptions);

                            setMarkers(map);
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

                        },
                        error: function(xhr, ajaxOptions, thrownError) {
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
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDboUvk9ElphosPEFC-Am9XzHFsmnOZR7I&libraries=places&callback=initAutocomplete">
    </script>



    <?php
    
    
    $servername = 'localhost';
    $username = 'dev';
    $password = 'Oi24Spc5';
    $dbname = 'EnSysAlpha';
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    } else {
        

        $sql = 'SELECT id, Bezeichnung, Laengengrad, Breitengrad, Postleitzahl, Katastralgemeinden FROM EnSys'; // ES
        $es_select = DB::table('EnSys')->get(); // ES Select mit Laravel
    
        $sql2 = 'SELECT id, ensys_id, Typ, Bezeichnung, Ort, Breitengrad, Laengengrad  FROM EnTech'; // ET
        $et_select = DB::table('EnTech')->get(); //ET Select mit Laravel
    
        $result = $conn->query($sql); //für SQL DB Conn
       $result2 = $conn->query($sql2); //für SQL DB Conn
    
      //  $result = $es_select; //für laravel DB Conn
       // $result2 = $et_select; //für laravel DB Conn
    
        $locations = [];
        $locationsET = [];
    
        
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                // echo "id: " . $row["id"]. " " . $row["Bezeichnung"]." ". $row["Laengengrad"]. " ". $row["Breitengrad"]. "<br>";
    
                $location = "['{$row['Bezeichnung']}', {$row['Laengengrad']}, {$row['Breitengrad']}, {$row['id']}, {$row['Postleitzahl']}, '{$row['Katastralgemeinden']}']";
                array_push($locations, $location);
            }
        
    
        if ($result2->num_rows > 0) {
            // output data of each row
            while ($row = $result2->fetch_assoc()) {
                $locationET = "['{$row['Bezeichnung']}', {$row['Laengengrad']}, {$row['Breitengrad']}, {$row['ensys_id']}, '{$row['Typ']}', '{$row['Ort']}', '{$row['id']}']";
    
                array_push($locationsET, $locationET);
            }
            $conn->close(); //für SQL DB Conn
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


        function augefunctionET(id) {
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



        function ETerstellen(id) {
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




        function setETMarker(map, id) {

            for (let i = 0; i < locationsET.length; i++) {
                const energietechnologie = locationsET[i];

                let sysID = energietechnologie[3];
                if (sysID != id) {
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
                        options.icon = "/images/icons/stromnetz_icon.PNG"
                        break;

                    case "Batteriespeicher":
                        options.icon = "/images/icons/batterie_icon.png"
                        break;

                    case "Wasserstoff Elektrolyse":
                        options.icon = "/images/icons/elektrolyseur_icon.PNG"
                        break;

                    case "Wasserstoff Brennstoffzelle":
                        options.icon = "/images/icons/brennstoffzelle_icon.PNG"
                        break;

                    case "Wasserstoff Speicher":
                        options.icon = "/images/icons/wasserstoffspeicher_icon.PNG"
                        break;

                    case "Windkraftanlage":
                        options.icon = "/images/icons/windkraft_icon.PNG"
                        break;

                    case "E-Ladestation":
                        options.icon = "/images/icons/etankstelle_icon.PNG"
                        break;

                    case "Hausanschlusszähler":
                        options.icon = "/images/icons/haus_icon.PNG"
                        break;

                    case "Wärmenetzbezug":
                        options.icon = "/images/icons/industrie_icon.PNG"
                        break;

                    case "Biomasseheizkraftwerk":
                        options.icon = "/images/icons/raffinerie_icon.PNG"
                        break;

                    case "Biomasseheizwerk":
                        options.icon = "/images/icons/bhkw_icon.PNG"
                        break;

                    case "Biomasseheizkessel":
                        options.icon = "/images/icons/biomassekessel_icon.PNG"
                        break;

                    case "Wärmespeicher":
                        options.icon = "/images/icons/Wärmespeicher_icon.PNG"
                        break;

                    case "Solarthermieanlage":
                        options.icon = "/images/icons/solarthermie_icon.PNG"
                        break;

                    case "Wärmepumpe":
                        options.icon = "/images/icons/Wärmepumpe_icon.png"
                        break;

                    case "Gebäude Wärmebedarfszähler":
                        options.icon = "/images/icons/wohnhaus_icon.PNG"
                        break;

                    case "Kompressionskältemaschiene":
                        options.icon = "/images/icons/Kompressionskältemaschiene_icon.png"
                        break;

                    case "Ab oder Adsorbtionskältemaschiene":
                        options.icon = "/images/icons/Ab oder Adsorbtionskältemaschiene_icon.png"
                        break;

                    case "Kältespeicher":
                        options.icon = "/images/icons/kältespeicher_icon.PNG"
                        break;

                    case "Gebäude Kältebedarfszähler":
                        options.icon = "/images/icons/Gebäude Kältebedarfszähler_icon.png"
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

            // ES Marker
            for (let i = 0; i < locations.length; i++) {
                const beach = locations[i];

                const marker = new google.maps.Marker({
                    position: {
                        lat: beach[1],
                        lng: beach[2]
                    },
                    map, // 0 Bezeichnung, 1 Längengrad, 2 Breitengrad, 3 Id
                    icon: '/images/icons/esrotneu.png',
                    title: beach[0], //Hover 
                    //label: beach[0], // Was im Icon steht
                    label: {
                        text: beach[0],
                        color: 'red', //Farbe der Schrift unter dem ES
                        fontWeight: "bold",
                        fontSize: '17px', //Schriftgröße
                        className: 'marker-position', //Damit die Schrift unter dem Icon steht
                    }, 
                    animation: google.maps.Animation.DROP, //verschiedene Moduse: DROP, BOUNCE
                });

                function unsetMarker(map) {


                    for (var i = 0; i < markersArray.length; i++) {
                        markersArray[i].setMap(null);
                    }
                    markersArray.length = 0;




                }


                //Doppelklick um ES auszuwählen
                marker.addListener("dblclick", (e) => {

                    let latLng = e.latLng.toString();
                    breit = parseFloat(latLng.substring(1, latLng.indexOf(","))).toFixed(9);
                    lang = parseFloat(latLng.substring(latLng.indexOf(",") + 1, latLng.length)).toFixed(9);
                    let id;
                    locations.forEach((loc) => {
                        if (loc[1].toFixed(9) == breit && loc[2].toFixed(9) == lang) {
                            id = loc[3];
                        }
                    });

                    map.setZoom(17);
                    map.setCenter(marker.getPosition());
                    marker.setIcon("/images/icons/esrotneuausgewählt.png");
                    marker.setAnimation(google.maps.Animation.BOUNCE);
                    print_List_Energietechnologie(id);

                    activeMarker = true;
                    activeClick = true;




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
                    marker.setIcon("/images/icons/esrotneu.png");
                    marker.setAnimation(google.maps.Animation.DROP);
                    print_List_Energiesysteme();
                    map.setOptions({
                        draggableCursor: 'crosshair'
                    });
                    $('#exampleModalCenterET').modal('hide'); //Pop Up ET erstellen Aufruf                  
                    activeMarker = false;
                    if (activeClick == true) {
                        unsetMarker(map);
                    }




                });



            }


        }








        function print_List_Energietechnologie(id) {

            document.getElementById("tableDiv").style.display = "none";
            document.getElementById("tableETDiv").style.display = "block";
            document.getElementById("tableESDiv").style.display = "none";

            $("#tableETDiv tbody tr").css("display", "none");
            $(".enTechTR-" + id).css("display", "table-row");

            document.getElementById("Listuberschrieft").innerHTML = "Energietechnologien";
            document.getElementById("Listimage").src = "/images/icons/etgrün.png"; 
            

        }




        function print_List_Energiesysteme() {

            document.getElementById("tableDiv").style.display = "none";
            document.getElementById("tableETDiv").style.display = "none";
            document.getElementById("tableESDiv").style.display = "block";

            
            document.getElementById("Listuberschrieft").innerHTML = "Energiesysteme";
            document.getElementById("Listimage").src = "/images/icons/es.png";
            

        }
    </script>





<?php

use Illuminate\Support\Facades\Http;

//$response = Http::withToken('eyJrIjoiM2dTZlU5bTM2SzJPaEt3OExnUUE5eDlFR1NEdjVjSVkiLCJuIjoiVGVzdEtleSIsImlkIjoxfQ==')->get('192.168.1.5:3000/api/dashboards/uid/21');
/*

$createEnsysDashboard = Http::withHeaders([

    'Authorization' => 'Bearer eyJrIjoiM2dTZlU5bTM2SzJPaEt3OExnUUE5eDlFR1NEdjVjSVkiLCJuIjoiVGVzdEtleSIsImlkIjoxfQ==',
    'Content-Type' => 'application/json',
    'Accept' => 'application/json',
    
])->post('192.168.1.5:3000/api/dashboards/db', [
    "dashboard" => [
         "id" => null, 
         "uid" => null, 
         "title" => 'tesffffft', 
         "tags" => [
            "templated" 
         ], 
         "timezone" => "browser", 
         "schemaVersion" => 16, 
         "version" => 0 
      ], 
   "folderId" => 0, 
   "overwrite" => false 
]);
echo($createEnsysDashboard);
*/

/*
$id = 27;

$strid = strval($id);


        $url = '192.168.1.5:3000/api/dashboards/uid/';


        $furl = $url . $strid;


        echo($furl);
        $deleteEnsysDashboard = Http::withHeaders([

            'Authorization' => 'Bearer eyJrIjoiM2dTZlU5bTM2SzJPaEt3OExnUUE5eDlFR1NEdjVjSVkiLCJuIjoiVGVzdEtleSIsImlkIjoxfQ==',
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',

        ])->delete($furl);



        echo ($deleteEnsysDashboard);






//echo($response);



*/


?>



@endsection
@section('foooter')
