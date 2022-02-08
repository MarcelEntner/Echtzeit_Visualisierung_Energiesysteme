@extends('layouts.layout')
@section('title', 'Energiesysteme')
@section('head')
@endsection
@section('content')

    <!-- Google Maps API Informationen -->
    <!-- ca. Zeile 1300 : API Key einbinden -->
    <!-- ca. Zeile 1175 : Eigene designte Map einbinden -->

    <body oncontextmenu="return false"> <!-- Rechtsklick auf der Web-Seite nicht möglich -->


        <div class="Energiesysteme container-fluid p-5">
            <div class="row w-100">
                <div class="col-12 col-lg-7 shadow-lg rounded" id="map"></div>
                <div class="Liste col-12 col-lg-5">
                    <input id="address" type="text">
                    <!--- INPUT FELD ZUM SUCHEN -->
                    <div id="find" class="btn btn-success">Suchen</div>
                    <!--- BUTTON ZUM SUCHEN -->

                    <!--- Gesamte rechte Div der Liste (ohne Addresssuchfeld)  -->
                    <div class="shadow-lg rounded p-3">
                        <div class="d-flex flex-column">
                            <div class="d-flex justify-content-between">
                                <h3> <b id="Listuberschrieft">Energiesysteme</b> <img src="/images/icons/es.png"
                                        id="Listimage"></h3>
                            </div>
                        </div>
                        

                        <!-- DataTable  Th und Td gleiche Anzahl, ansonsten funktioniert er nicht-->

                        <!-- Gesamte DataTable Div -->
                        <div style="height: 48vh; width:100%; margin-top:-7%;">

                            <!-- DataTable ES Ausgangspunkt-->
                            <div id="tableDiv"> 
                                <table class="table table-borderless table-hover" id="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Bezeichnung</th>
                                            <th scope="col">Katastralgemeinde</th>
                                            <th scope="col">PLZ</th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $d)

                                            <tr>
                                                <td onclick="moveToMarker({{ $d->id }})">{{ $d->Bezeichnung }}</td>
                                                <td onclick="moveToMarker({{ $d->id }})">{{ $d->Katastralgemeinden }}</td>
                                                <td onclick="moveToMarker({{ $d->id }})">{{ $d->Postleitzahl }} </td>

                                                @auth
                                                    <?php
                                                    $userID = Auth::user();
                                                    ?>

                                                    <!-- Wenn man nicht angemeldet ist darf man die ES nicht verwalten-->
                                                    <!-- Nur der Ersteller eines ES darf dieses auch bearbeiten || Admin (Rolle Admin) darf alle -->

                                                    @if ($userID->id == $d->user_id || $userID->role == 'Admin')

                                                        <td id="hov"> <a href="/delete/{{ $d->id }}" class="btn btn2" style="background-image: url('/images/buttons/delete.png')"></a>
                                                        </td>

                                                        <td id="hov"> <a href="javascript:GrafanafunctionES({{ $d->id }})"
                                                                class="btn btn2"
                                                                style="background-image: url('/images/buttons/statistik.png')"></a>
                                                        </td>

                                                        <td id="hov"> <a href="javascript:EditfunctionES({{ $d->id }})"
                                                                class="btn btn2"
                                                                style="background-image: url('/images/buttons/stift.png')"></a>
                                                        </td>

                                                    @else
                                                        <!-- Wenn man  angemeldet ist aber nicht das ES erstellt hat oder nicht Admin ist -->

                                                        <td> <a href="javascript:GrafanafunctionES({{ $d->id }})" class="btn btn2"
                                                                style="background-image: url('/images/buttons/statistik.png')"></a>
                                                        </td>
                                                        <td> <a href="javascript:AugefunctionES({{ $d->id }})"
                                                                class="btn btn2"
                                                                style="background-image: url('/images/buttons/auge.png')"></a>
                                                        </td>

                                                        <td> </td>

                                                    @endif

                                                @endauth

                                                <!-- Wenn man nicht angemeldet ist-->

                                                @guest
                                                    <td> <a href="javascript:GrafanafunctionES({{ $d->id }})" class="btn btn2"
                                                            style="background-image: url('/images/buttons/statistik.png')"></a>
                                                    </td>
                                                    <td> <a href="javascript:AugefunctionES({{ $d->id }})"
                                                            class="btn btn2"
                                                            style="background-image: url('/images/buttons/auge.png')"></a></td>
                                                    <td></td>
                                                @endguest

                                            </tr>

                                        @endforeach
                                    </tbody>

                                </table>
                            </div>

                            <!-- DataTable ET -->
                            <div id="tableETDiv" style="display: none;">
                                <table class="table table-borderless table-hover" id="tableET">
                                    <thead>
                                        <tr>
                                            <th scope="col">Bezeichnung</th>
                                            <th scope="col">Typ </th>
                                            <th scope="col">Ort</th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        
                                    </tbody>

                                </table>
                            </div>



                            <!-- DataTable ES nach Aktualisierung des DataTablesES -->
                            <div id="tableESDiv" style="display: none">
                                <table class="table table-borderless table-hover" id="tableES">
                                    <thead>
                                        <tr>
                                            <th scope="col">Bezeichnung</th>
                                            <th scope="col">Katastralgemeinde</th>
                                            <th scope="col">PLZ</th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($data as $d)
                                            <tr>
                                                <td onclick="moveToMarker({{ $d->id }})">{{ $d->Bezeichnung }} </td>
                                                <td onclick="moveToMarker({{ $d->id }})">{{ $d->Katastralgemeinden }}</td>
                                                <td onclick="moveToMarker({{ $d->id }})">{{ $d->Postleitzahl }}</td>

                                                @auth
                                                    <!-- Wenn man nicht angemeldet ist darf man die ES nicht verwalten-->
                                                    <!-- Nur der Ersteller eines ES darf dieses auch bearbeiten || Admin (Rolle Admin) darf alle -->
                                                    @if (Auth::user()->id == $d->user_id || Auth::user()->role == 'Admin')

                                                        <td> <a href="/delete/{{ $d->id }}" class="btn btn2"
                                                                style="background-image: url('/images/buttons/delete.png')"></a>
                                                        </td>

                                                        <td> <a href="javascript:GrafanafunctionES({{ $d->id }})" class="btn btn2"
                                                                style="background-image: url('/images/buttons/statistik.png')"></a>
                                                        </td>

                                                        <td> <a href="javascript:EditfunctionES({{ $d->id }})"
                                                                class="btn btn2"
                                                                style="background-image: url('/images/buttons/stift.png')"></a>
                                                        </td>

                                                    @else
                                                        <!-- Wenn man  angemeldet ist aber nicht das ES erstellt hat oder nicht Admin ist -->

                                                        <td> <a href="javascript:GrafanafunctionES({{ $d->id }})" class="btn btn2"
                                                                style="background-image: url('/images/buttons/statistik.png')"></a>
                                                        </td>

                                                        <td> <a href="javascript:AugefunctionES({{ $d->id }})"
                                                                class="btn btn2"
                                                                style="background-image: url('/images/buttons/auge.png')"></a>
                                                        </td>
                                                        <td> </td>
                                                    @endif
                                                @endauth
                                                <!-- Wenn man nicht angemeldet ist-->

                                                @guest
                                                    <td> <a href="javascript:GrafanafunctionES({{ $d->id }})" class="btn btn2"
                                                            style="background-image: url('/images/buttons/statistik.png')"></a>
                                                    </td>

                                                    <td> <a href="javascript:AugefunctionES({{ $d->id }})"
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



            
            <!--Pop Up Fenster -->

            <!-- ES hinzufügen -->
            <div class="modal modal2 fade" id="PopUpESHinzufügen" tabindex="-1" role="dialog"
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
                            <!--Route zu der Methode store (erstellen) im Controller EnSys -->
                            <form action="{{ route('EnSys.store') }}" method="POST">
                                @csrf
                                <!--Input Felder -->
                                <!--Input Feld Bezeichnung -->
                                <div class="input-group mb-3" style="margin-top:2%">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                        <img src="/images/pop-up/name.png" style="margin-right:10px;">
                                        Bezeichnung</span>
                                    <input type="text" class="form-control3" id="BezeichnungES" name="BezeichnungES"
                                        aria-label="Bezeichnung" aria-describedby="basic-addon1" placeholder="MicroGridLab" required>
                                </div>
                                <!--Input Feld Katastralgemeinde -->
                                <div class="input-group mb-3" style="margin-top:5%">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                        <img src="/images/pop-up/katastralgemeinde.png" style="margin-right:10px;">
                                        Katastralgemeinde</span>
                                    <input type="text" class="form-control3" id="KatastralgemeindenES"
                                        name="KatastralgemeindenES" aria-label="Katastralgemeinden"
                                        aria-describedby="basic-addon1" placeholder="Wieselburg" required>
                                </div>
                                <!--Input Feld Postleitzahl -->
                                <div class="input-group mb-3" style="margin-top:5%">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                        <img src="/images/pop-up/postleitzahl.png" style="margin-right:10px;">
                                        Postleitzahl</span>
                                    <input type="number" class="form-control3" id="PostleitzahlES" name="PostleitzahlES"
                                        aria-label="Postleitzahl" aria-describedby="basic-addon1" placeholder="3250" required>
                                </div>
                                <!--Input Feld Längengrad Readonly (value wird automatisch gesetzt)-->
                                <div class="input-group mb-3" style="margin-top:5%">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                        <img src="/images/pop-up/längengrad.png" style="margin-right:10px;">
                                        Längengrad</span>
                                    <input type="text" class="form-control3" id="LaengengradES" name="LaengengradES"
                                        aria-label="LaengengradES" aria-describedby="basic-addon1" readonly
                                        style="background-color:#e9ecef">
                                </div>
                                <!--Input Feld Breitengrad (value wird automatisch gesetzt)-->
                                <div class="input-group mb-3" style="margin-top:5%">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                        <img src="/images/pop-up/breitengrad.png" style="margin-right:10px;">
                                        Breitengrad</span>
                                    <input type="text" class="form-control3" id="BreitengradES" name="BreitengradES"
                                        aria-label="BreitengradES" aria-describedby="basic-addon1" readonly
                                        style="background-color:#e9ecef">
                                </div>
                                <br>
                                <!--Button Energiesystem erstellen -->
                                <input type="submit" class="btn btn-success" style="margin-left:30%" id="ESerstellen"
                                    value="Energiesystem erstellen">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ES hinzufügen Ende -->


            <!-- ET hinzufügen -->
            <div class="modal modal2 fade" id="PopUpETHinzufügen" tabindex="-1" role="dialog"
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
                            <!--Route zu der Methode store (erstellen) im Controller EnTech -->
                            <form action="{{ route('EnTech.store') }}" id="ETerstellen" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <!--Input Felder -->
                                <!--Input Feld ID-ES Readonly (value wird automatisch gesetzt) -->
                                <div class="input-group mb-3" style="margin-top:2%; display:none;">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                        <img src="/images/pop-up/id.png" style="margin-right:10px;">
                                        ID-ES</span>
                                    <input type="text" class="form-control3" id="IDES" name="IDES" readonly
                                        aria-label="ID-ES" aria-describedby="basic-addon1" style="background-color:#e9ecef">
                                </div>
                                <!--Input Feld Bezeichnung -->
                                <div class="input-group mb-3" style="margin-top:2%">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                        <img src="/images/pop-up/name.png" style="margin-right:10px;">
                                        Bezeichnung</span>
                                    <input type="text" class="form-control3" id="BezeichnungET" name="Bezeichnung"
                                        placeholder="Bezeichung" aria-label="BezeichnungET" aria-describedby="basic-addon1" required> 
                                </div>
                                <!--Input Feld Typ -->
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
                                        <option value="Kompressionskältemaschine"> Kompressionskältemaschine</option>
                                        <option value="Ab oder Adsorbtionskältemaschine"> Ab oder Adsorbtionskältemaschine
                                        </option>
                                        <option value="Kältespeicher">Kältespeicher</option>
                                        <option value="Gebäude Kältebedarfszähler">Gebäude Kältebedarfszähler</option>
                                    </select>
                                </div>
                                <!--Input Feld Ort -->
                                <div class="input-group mb-3" style="margin-top:2%">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                        <img src="/images/pop-up/ort.png" style="margin-right:10px;">
                                        Ort</span>
                                    <input type="text" class="form-control3" id="OrtET" name="Ort" placeholder="Dach"
                                        aria-label="OrtET" aria-describedby="basic-addon1" required>
                                </div>
                                <!--Input Feld Längengrad Readonly (value wird automatisch gesetzt) -->
                                <div class="input-group mb-3" style="margin-top:2%">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                        <img src="/images/pop-up/längengrad.png" style="margin-right:10px;">
                                        Längengrad</span>
                                    <input type="text" class="form-control3" id="LaengengradET" name="Laengengrad"
                                        aria-label="LängengradET" aria-describedby="basic-addon1" readonly
                                        style="background-color:#e9ecef">
                                </div>
                                <!--Input Feld Breitengrad Readonly (value wird automatisch gesetzt)-->
                                <div class="input-group mb-3" style="margin-top:2%">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                        <img src="/images/pop-up/breitengrad.png" style="margin-right:10px;">
                                        Breitengrad</span>
                                    <input type="text" class="form-control3" id="BreitengradET" name="Breitengrad"
                                        aria-label="BreitengradET" aria-describedby="basic-addon1" readonly
                                        style="background-color:#e9ecef">
                                </div>
                                <!--Input Feld Bild -->
                                <div class="input-group mb-3" style="margin-top:5%">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                        <img src="/images/pop-up/bild.png" style="margin-right:10px;">
                                        Bild einfügen</span>
                                    <input type="file" class="form-control3" id="imageET" name="imageET" value="">
                                </div>
                                <!--Input Feld Beschreibung -->
                                <div class="input-group mb-3" style="margin-top:2%">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                        <img src="/images/pop-up/beschreibung.png" style="margin-right:10px;">
                                        Beschreibung</span>
                                    <input type="text" class="form-control3" id="BeschreibungET" name="BeschreibungET"
                                        placeholder="..." aria-label="BeschreibungET" aria-describedby="basic-addon1" required>
                                </div>
                                <br>
                                <!--Button Energietechnologie erstellen  -->
                                <input type="submit" class="btn btn-success" style="margin-left:30%" id="ETerstellen"
                                    value="Energietechnologie erstellen">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ET hinzufügen Ende -->


        <!-- ES Editieren -->
        <div class="modal modal2 fade" id="PopUpESEditieren" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
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
                            <!-- Wird nur am Seitenaufruf gemacht und nicht zwischendurch, deswegen werden die Attribut-Daten beim Klick auf Stift neu geladen-->
                            @csrf
                            <!--Input Felder -->
                            <!--Input Feld Bezeichnung Änderbar -->
                            <div class="input-group mb-3" style="margin-top:2%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/name.png" style="margin-right:10px;">
                                    Bezeichnung</span>
                                <input type="text" class="form-control3" id="BezeichnungESEdit" name="Bezeichnung" value=""
                                    aria-label="Bezeichnung" aria-describedby="basic-addon1" required>
                            </div>
                            <!--Input Feld Katastralgemeinde Änderbar -->
                            <div class="input-group mb-3" style="margin-top:5%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/katastralgemeinde.png" style="margin-right:10px;">
                                    Katastralgemeinde</span>
                                <input type="text" class="form-control3" id="KatastralgemeindeESEdit"
                                    name="Katastralgemeinden" value="" aria-label="Katastralgemeinden"
                                    aria-describedby="basic-addon1" required>
                            </div>
                            <!--Input Feld Postleitzahl Änderbar -->
                            <div class="input-group mb-3" style="margin-top:5%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/postleitzahl.png" style="margin-right:10px;">
                                    Postleitzahl</span>
                                <input type="number" class="form-control3" id="PostleitzahlESEdit" name="Postleitzahl"
                                    value="" aria-label="Postleitzahl" aria-describedby="basic-addon1" required>
                            </div>
                            <!--Input Feld Längengrad Readonly -->
                            <div class="input-group mb-3" style="margin-top:5%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/längengrad.png" style="margin-right:10px;">
                                    Längengrad</span>
                                <input type="text" class="form-control3" id="LaengengradESEdit" name="Laengengrad"
                                    value="" aria-label="Laengengrad" aria-describedby="basic-addon1" readonly
                                    style="background-color:#e9ecef">
                            </div>
                            <!--Input Feld Breitengrad Readonly -->
                            <div class="input-group mb-3" style="margin-top:5%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/breitengrad.png" style="margin-right:10px;">
                                    Breitengrad</span>
                                <input type="text" class="form-control3" id="BreitengradESEdit" name="Breitengrad"
                                    value="" readonly aria-label="Breitengrad" aria-describedby="basic-addon1"
                                    style="background-color:#e9ecef">
                            </div>
                            <!--Option Mehr Deatils zum ES -->
                            <details closed>
                                <summary>Mehr Details zu diesem Energiesystem</summary>
                                <!--Input Feld Az-Erzeugungstechnologien Readonly -->
                                <div class="input-group mb-3" style="margin-top:5%;">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:270px;">
                                        <img src="/images/pop-up/erzeugertechnologien.png" style="margin-right:10px;">
                                        Az-Erzeugungstechnologien</span>
                                    <input type="text" class="form-control3" id="Az-Erzeugungstechnologien"
                                        name="Az-Erzeugungstechnologien" aria-label="Az-Erzeugungstechnologien"
                                        aria-describedby="basic-addon1" value=""
                                        style="width:160px; background-color:#e9ecef;" readonly>
                                </div>
                                <!--Input Feld Az-Verbraucher Readonly -->
                                <div class="input-group mb-3" style="margin-top:5%;">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:270px;">
                                        <img src="/images/pop-up/verbraucher.png" style="margin-right:10px;">
                                        Az-Verbraucher</span>
                                    <input type="text" class="form-control3" id="Az-Verbraucher" name="Az-Verbraucher"
                                        aria-label="Az-Verbraucher" aria-describedby="basic-addon1" value=""
                                        style="width:160px; background-color:#e9ecef;" readonly>
                                </div>
                                <!--Input Feld Az-Speicher Readonly -->
                                <div class="input-group mb-3" style="margin-top:5%;">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:270px;">
                                        <img src="/images/pop-up/azspeicher.png" style="margin-right:10px;">
                                        Az-Speicher</span>
                                    <input type="text" class="form-control3" id="Az-Speicher" name="Az-Speicher"
                                        aria-label="Az-Speicher" aria-describedby="basic-addon1" value=""
                                        style="width:160px; background-color:#e9ecef;" readonly>
                                </div>
                                <!--Input Feld Ges-Nennleistung [kW] Readonly -->
                                <div class="input-group mb-3" style="margin-top:5%;">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:270px;">
                                        <img src="/images/pop-up/leistung.png" style="margin-right:10px;">
                                        Ges-Nennleistung [kW]</span>
                                    <input type="text" class="form-control3" id="Ges-Nennleistung" name="Ges-Nennleistung"
                                        aria-label="Ges-Nennleistung" aria-describedby="basic-addon1" value=""
                                        style="width:160px; background-color:#e9ecef;" readonly>
                                </div>
                                <!--Input Feld Ges-Energie [kW/h] Readonly -->
                                <div class="input-group mb-3" style="margin-top:5%;">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:270px;">
                                        <img src="/images/pop-up/energie.png" style="margin-right:10px;">
                                        Ges-Energie [kW/h]</span>
                                    <input type="text" class="form-control3" id="Ges-Energie" name="Ges-Energie"
                                        aria-label="Ges-Energie" aria-describedby="basic-addon1" value=""
                                        style="width:160px; background-color:#e9ecef;" readonly>
                                </div>
                                <!--Input Feld Ges-VerbraucherLeistung [kW] Readonly -->
                                <div class="input-group mb-3" style="margin-top:5%;">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:270px;">
                                        <img src="/images/pop-up/gesamtverleistung.png" style="margin-right:10px;">
                                        Ges-VerbraucherLeistung [kW]</span>
                                    <input type="text" class="form-control3" id="Ges-VerbraucherLeistung"
                                        name="Ges-VerbraucherLeistung" aria-label="Ges-VerbraucherLeistung"
                                        aria-describedby="basic-addon1" value=""
                                        style="width:160px; background-color:#e9ecef;" readonly>
                                </div>
                                <!--Input Feld Ges-VerbraucherEnergie [kW] Readonly -->
                                <div class="input-group mb-3" style="margin-top:5%;">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:270px;">
                                        <img src="/images/pop-up/gesverenergie.png" style="margin-right:5px;">
                                        Ges-VerbraucherEnergie [kW/h]</span>
                                    <input type="text" class="form-control3" id="Ges-VerbraucherEnergie"
                                        name="Ges-VerbraucherEnergie" aria-label="Ges-VerbraucherEnergie"
                                        aria-describedby="basic-addon1" value=""
                                        style="width:160px; background-color:#e9ecef;" readonly>
                                </div>
                                <!--Input Feld Ges-ErzeugerLeistung [kW] Readonly -->
                                <div class="input-group mb-3" style="margin-top:5%;">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:270px;">
                                        <img src="/images/pop-up/gesverenergie.png" style="margin-right:5px;">
                                        Ges-ErzeugerLeistung [kW]</span>
                                    <input type="text" class="form-control3" id="Ges-ErzeugerLeistung"
                                        name="Ges-VerbraucherEnergie" aria-label="Ges-VerbraucherEnergie"
                                        aria-describedby="basic-addon1" value=""
                                        style="width:160px; background-color:#e9ecef;" readonly>
                                </div>
                                <!--Input Feld Ges-ErzeugerEnergie [kW] Readonly -->
                                <div class="input-group mb-3" style="margin-top:5%;">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:270px;">
                                        <img src="/images/pop-up/gesverenergie.png" style="margin-right:5px;">
                                        Ges-ErzeugerEnergie [kW/h]</span>
                                    <input type="text" class="form-control3" id="Ges-ErzeugerEnergie"
                                        name="Ges-VerbraucherEnergie" aria-label="Ges-VerbraucherEnergie"
                                        aria-describedby="basic-addon1" value=""
                                        style="width:160px; background-color:#e9ecef;" readonly>
                                </div>
                                <!--Input Feld Ges-SpeicherKapazität [kW/h] Readonly -->
                                <div class="input-group mb-3" style="margin-top:5%;">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:270px;">
                                        <img src="/images/pop-up/gesspeicherkap.png" style="margin-right:10px;">
                                        Ges-SpeicherKapazität [kW/h]</span>
                                    <input type="text" class="form-control3" id="Ges-SpeicherKapazität"
                                        name="Ges-SpeicherKapazität" aria-label="Ges-SpeicherKapazität"
                                        aria-describedby="basic-addon1" value=""
                                        style="width:160px; background-color:#e9ecef;" readonly>
                                </div>
                                <!--Input Feld Aktueller Netzbezug [kW] Readonly -->
                                <div class="input-group mb-3" style="margin-top:5%;">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:270px;">
                                        <img src="/images/pop-up/netzbezug.png" style="margin-right:10px;">
                                        Aktueller Netzbezug [kW]</span>
                                    <input type="text" class="form-control3" id="AktuellerNetzbezug"
                                        name="Aktueller Netzbezug" aria-label="Aktueller Netzbezug"
                                        aria-describedby="basic-addon1" value=""
                                        style="width:160px; background-color:#e9ecef;" readonly>
                                </div>
                            </details>
                            <br>
                            <!--Button Energiesystem aktualisieren  -->
                            <input type="submit" class="btn  btn-success" style="margin-left:30%"
                                value="Energiesystem aktualisieren">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ES Editieren Ende -->



        <!-- ET  Editieren -->
        <div class="modal modal2 fade" id="PopUpETEditieren" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal2-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title modal2-title" id="exampleModalLongTitle">Energietechnologie <img src="/images/icons/etgrün2.png"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editFormET" method="GET">
                            <!-- Wird nur am Seitenaufruf gemacht und nicht zwischendurch, deswegen werden die Attribut-Daten beim Klick auf Stift neu geladen-->
                            @csrf
                            <!--Input Felder -->
                            <!--Input Feld ID Energiesystem Readonly -->
                            <div class="input-group mb-3" style="margin-top:2%; display:none;">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/id.png" style="margin-right:10px;">
                                    ID Energiesystem</span>
                                <input type="text" class="form-control3" id="IdEditES" name="idEditES" value=""
                                    aria-label="ID-ES" aria-describedby="basic-addon1" readonly
                                    style="background-color:#e9ecef;">
                            </div>
                            <!--Input Feld ID Energietechnologie Readonly -->
                            <div class="input-group mb-3" style="margin-top:2%; display:none;">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/id.png" style="margin-right:10px;">
                                    ID Energietechnologie</span>
                                <input type="text" class="form-control3" id="IdEditET" name="idEditET" value=""
                                    aria-label="idEditET" aria-describedby="basic-addon1" readonly
                                    style="background-color:#e9ecef;">
                            </div>
                            <!--Input Feld Bezeichnung Änderbar -->
                            <div class="input-group mb-3" style="margin-top:2%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/name.png" style="margin-right:10px;">
                                    Bezeichnung</span>
                                <input type="text" class="form-control3" id="BezeichnungEditET" name="BezeichnungEditET"
                                    value="" aria-label="BezeichnungEditET" aria-describedby="basic-addon1" required>
                            </div>
                            <!--Input Feld Typ Readonly -->
                            <div class="input-group mb-3" style="margin-top:2%; width:445px;">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/typ.png" style="margin-right:10px;">
                                    Typ</span>
                                <input type="text" class="form-control3" id="TypEditET" name="TypEditET" value=""
                                    aria-label="TypEditET" aria-describedby="basic-addon1" readonly
                                    style="background-color:#e9ecef;">
                            </div>
                            <!--Input Feld Ort Änderbar -->
                            <div class="input-group mb-3" style="margin-top:2%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/ort.png" style="margin-right:10px;">
                                    Ort </span>
                                <input type="text" class="form-control3" id="OrtEditET" name="OrtEditET" value=""
                                    aria-label="OrtEditET" aria-describedby="basic-addon1" required>
                            </div>
                            <!--Input Feld Längengrad Readonly -->
                            <div class="input-group mb-3" style="margin-top:2%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/längengrad.png" style="margin-right:10px;">
                                    Längengrad</span>
                                <input type="text" class="form-control3" id="LaengengradEditET" name="LaengengradEditET"
                                    value="" readonly aria-label="LaengengradEditET" aria-describedby="basic-addon1"
                                    style="background-color:#e9ecef;">
                            </div>
                            <!--Input Feld Breitgengrad Readonly -->
                            <div class="input-group mb-3" style="margin-top:2%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/breitengrad.png" style="margin-right:10px;">
                                    Breitgengrad</span>
                                <input type="text" class="form-control3" id="BreitengradEditET" name="BreitengradEditET"
                                    value="" readonly aria-label="BreitengradEditET" aria-describedby="basic-addon1"
                                    style="background-color:#e9ecef;">
                            </div>
                              <!--Input Feld Bild -->
                              <div class="input-group mb-3" style="margin-top:5%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/bild.png" style="margin-right:10px;">
                                    Bild einfügen</span>
                                <input type="file" class="form-control3" id="imageEditET" name="imageEditET" value="">
                            </div>
                            <!--Input Feld Beschreibung -->
                            <div class="input-group mb-3" style="margin-top:2%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/beschreibung.png" style="margin-right:10px;">
                                    Beschreibung</span>
                                <input type="text" class="form-control3" id="BeschreibungEditET" name="BeschreibungEditET"
                                    placeholder="..." aria-label="BeschreibungET" aria-describedby="basic-addon1" required>
                            </div>
                            <br>
                            <!--Button Energietechnologie aktualisieren -->
                            <input type="submit" class="btn btn-success" style="margin-left:30%"
                                value="Energietechnologie aktualisieren">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Et Editieren Ende-->


        <!-- ES Grafana -->
        <div class="modal modal2 fade" id="PopUpESGrafana" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal2-dialog modal-dialog-centered" role="document" >
                
            <div class="modal-content" style=" left: -29vw;  background-color:white;">
                
            <div class="modal-header" style=" left: -29vw; width: 1600px; background-color:white; ">

            <h5 class="modal-title modal2-title" id="exampleModalLongTitle" style="padding-left:32%;">Statistiken - Energiesysteme</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
                


                <div class="modal-body" style=" height:700px;   background-color:white; width: 1600px;" >

                    <script type="text/javascript">
                    
                  
                    function GrafanafunctionES(id)  {
                        $('#PopUpESGrafana').modal('show');

                        console.log(id);
                    }
                     </script>


                    <!-- Statistiken Ende-->
                </div>



                </div>
            </div>
        </div>
        <!-- ES Grafana Ende -->





        <!-- ET Grafana -->
        <div class="modal modal2 fade" id="PopUpETGrafana" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal2-dialog modal-dialog-centered" role="document">
                    <div class="modal-content" style=" left: -29vw;  background-color:white;">

                        <div class="modal-header" style=" left: -29vw; width: 1600px; background-color:white; ">
                            <h5 class="modal-title modal2-title" id="exampleModalLongTitle" style="padding-left:32%;">Statistiken Energietechnologie</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                    <div class="modal-body" style=" height:700px;   background-color:white; width: 1600px;" >
                            <!-- Statistiken Anfang-->

                            <script type="text/javascript">
                    
                           function GrafanafunctionET(id) {
                            $('#PopUpETGrafana').modal('show');

                           }

                          
                            </script>


                       
@isset($d)
@isset($da)
 <!-- <iframe src="http://192.168.1.5:3000/d-solo/{{ $d->id }}/{{ $d->Bezeichnung }}?orgId=1&panelId={{ $da->id }}" width="100%" height="100%" frameborder="0"></iframe> -->
  @endisset
@endisset


                            <!-- Statistiken Ende-->
                        </div>
                    </div>
                </div>
        </div>
        <!-- ET Grafana Ende -->



        <!-- ES Auge -->
        <div class="modal modal2 fade" id="PopUpESAuge" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal2-dialog modal-dialog-centered" role="document">
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
                            <!-- Wird nur am Seitenaufruf gemacht und nicht zwischendurch, deswegen werden die Attribut-Daten beim Klick auf Stift neu geladen-->
                            @csrf
                            <!--Input Felder -->
                            <!--Input Bezeichnung  Readonly -->
                            <div class="input-group mb-3" style="margin-top:2%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/name.png" style="margin-right:10px;">
                                    Bezeichnung</span>
                                <input type="text" class="form-control3" id="BezeichnungAuge" name="Bezeichnung"
                                    aria-label="Bezeichnung" aria-describedby="basic-addon1" value="" readonly
                                    style="background-color:#e9ecef;">
                            </div>
                            <!--Input Katastralgemeinde  Readonly -->
                            <div class="input-group mb-3" style="margin-top:5%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/katastralgemeinde.png" style="margin-right:10px;">
                                    Katastralgemeinde</span>
                                <input type="text" class="form-control3" id="KatastralgemeindeAuge"
                                    name="Katastralgemeinden" value="" aria-label="Katastralgemeinde"
                                    aria-describedby="basic-addon1" readonly style="background-color:#e9ecef;">
                            </div>
                            <!--Input Postleitzahl  Readonly -->
                            <div class="input-group mb-3" style="margin-top:5%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/postleitzahl.png" style="margin-right:10px;">
                                    Postleitzahl</span>
                                <input type="text" class="form-control3" id="PostleitzahlAuge" name="Postleitzahl"
                                    value="" aria-label="Postleitzahl" aria-describedby="basic-addon1" readonly
                                    style="background-color:#e9ecef;">
                            </div>
                            <!--Input Längengrad  Readonly -->
                            <div class="input-group mb-3" style="margin-top:5%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/längengrad.png" style="margin-right:10px;">
                                    Längengrad</span>
                                <input type="text" class="form-control3" id="LaengengradAuge" name="Laengengrad"
                                    aria-label="Laengengrad" aria-describedby="basic-addon1" value="" readonly
                                    style="background-color:#e9ecef;">
                            </div>
                            <!--Input Breitengrad  Readonly -->
                            <div class="input-group mb-3" style="margin-top:5%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/breitengrad.png" style="margin-right:10px;">
                                    Breitengrad</span>
                                <input type="text" class="form-control3" id="BreitengradAuge" name="Breitengrad"
                                    aria-label="Breitengrad" aria-describedby="basic-addon1" value="" readonly
                                    style="background-color:#e9ecef;">
                            </div>
                            <!--Mehr Details  -->
                            <details closed>
                                <summary>Mehr Details zu diesem Energiesystem</summary>
                                <!--Input Az-Erzeugungstechnologien  Readonly -->
                                <div class="input-group mb-3" style="margin-top:5%;">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:270px;">
                                        <img src="/images/pop-up/erzeugertechnologien.png" style="margin-right:10px;">
                                        Az-Erzeugungstechnologien</span>
                                    <input type="text" class="form-control3" id="Az-ErzeugungstechnologienAuge"
                                        name="Az-Erzeugungstechnologien" aria-label="Az-Erzeugungstechnologien"
                                        aria-describedby="basic-addon1" value=""
                                        style="width:160px; background-color:#e9ecef;" readonly>
                                </div>
                                <!--Input Az-Verbraucher  Readonly -->
                                <div class="input-group mb-3" style="margin-top:5%;">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:270px;">
                                        <img src="/images/pop-up/verbraucher.png" style="margin-right:10px;">
                                        Az-Verbraucher</span>
                                    <input type="text" class="form-control3" id="Az-VerbraucherAuge" name="Az-Verbraucher"
                                        aria-label="Az-Verbraucher" aria-describedby="basic-addon1" value=""
                                        style="width:160px; background-color:#e9ecef;" readonly>
                                </div>
                                <!--Input Az-Speicher  Readonly -->
                                <div class="input-group mb-3" style="margin-top:5%;">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:270px;">
                                        <img src="/images/pop-up/azspeicher.png" style="margin-right:10px;">
                                        Az-Speicher</span>
                                    <input type="text" class="form-control3" id="Az-SpeicherAuge" name="Az-Speicher"
                                        aria-label="Az-Speicher" aria-describedby="basic-addon1" value=""
                                        style="width:160px; background-color:#e9ecef;" readonly>
                                </div>
                                <!--Input Ges-Nennleistung [kW]  Readonly -->
                                <div class="input-group mb-3" style="margin-top:5%;">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:270px;">
                                        <img src="/images/pop-up/leistung.png" style="margin-right:10px;">
                                        Ges-Nennleistung [kW]</span>
                                    <input type="text" class="form-control3" id="Ges-NennleistungAuge"
                                        name="Ges-Nennleistung" aria-label="Ges-Nennleistung"
                                        aria-describedby="basic-addon1" value=""
                                        style="width:160px; background-color:#e9ecef;" readonly>
                                </div>
                                <!--Input Ges-Energie [kW/h]  Readonly -->
                                <div class="input-group mb-3" style="margin-top:5%;">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:270px;">
                                        <img src="/images/pop-up/energie.png" style="margin-right:10px;">
                                        Ges-Energie [kW/h]</span>
                                    <input type="text" class="form-control3" id="Ges-EnergieAuge" name="Ges-Energie"
                                        aria-label="Ges-Energie" aria-describedby="basic-addon1" value=""
                                        style="width:160px; background-color:#e9ecef;" readonly>
                                </div>
                                <!--Input Ges-VerbraucherLeistung [kW] Readonly -->
                                <div class="input-group mb-3" style="margin-top:5%;">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:270px;">
                                        <img src="/images/pop-up/gesamtverleistung.png" style="margin-right:10px;">
                                        Ges-VerbraucherLeistung [kW]</span>
                                    <input type="text" class="form-control3" id="Ges-VerbraucherLeistungAuge"
                                        name="Ges-VerbraucherLeistung" aria-label="Ges-VerbraucherLeistung"
                                        aria-describedby="basic-addon1" value=""
                                        style="width:160px; background-color:#e9ecef;" readonly>
                                </div>
                                <!--Input Ges-VerbraucherEnergie [kW/h] Readonly -->
                                <div class="input-group mb-3" style="margin-top:5%;">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:270px;">
                                        <img src="/images/pop-up/gesverenergie.png" style="margin-right:10px;">
                                        Ges-VerbraucherEnergie [kW/h]</span>
                                    <input type="text" class="form-control3" id="Ges-VerbraucherEnergieAuge"
                                        name="Ges-VerbraucherEnergie" aria-label="Ges-VerbraucherEnergie"
                                        aria-describedby="basic-addon1" value=""
                                        style="width:160px; background-color:#e9ecef;" readonly>
                                </div>
                                <!--Input Ges-ErzeugerLeistung [kW] Readonly -->
                                <div class="input-group mb-3" style="margin-top:5%;">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:270px;">
                                        <img src="/images/pop-up/gesverenergie.png" style="margin-right:5px;">
                                        Ges-ErzeugerLeistung [kW]</span>
                                    <input type="text" class="form-control3" id="Ges-ErzeugerLeistungAuge"
                                        name="Ges-VerbraucherEnergie" aria-label="Ges-VerbraucherEnergie"
                                        aria-describedby="basic-addon1" value=""
                                        style="width:160px; background-color:#e9ecef;" readonly>
                                </div>
                                <!--Input Ges-ErzeugerEnergie [kW/h] Readonly -->
                                <div class="input-group mb-3" style="margin-top:5%;">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:270px;">
                                        <img src="/images/pop-up/gesverenergie.png" style="margin-right:5px;">
                                        Ges-ErzeugerEnergie [kW/h]</span>
                                    <input type="text" class="form-control3" id="Ges-ErzeugerEnergieAuge"
                                        name="Ges-VerbraucherEnergie" aria-label="Ges-VerbraucherEnergie"
                                        aria-describedby="basic-addon1" value=""
                                        style="width:160px; background-color:#e9ecef;" readonly>
                                </div>
                                <!--Input Ges-SpeicherKapazität [kW/h] Readonly -->
                                <div class="input-group mb-3" style="margin-top:5%;">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:270px;">
                                        <img src="/images/pop-up/gesspeicherkap.png" style="margin-right:10px;">
                                        Ges-SpeicherKapazität [kW/h]</span>
                                    <input type="text" class="form-control3" id="Ges-SpeicherKapazitätAuge"
                                        name="Ges-SpeicherKapazität" aria-label="Ges-SpeicherKapazität"
                                        aria-describedby="basic-addon1" value=""
                                        style="width:160px; background-color:#e9ecef;" readonly>
                                </div>
                                <!--Input  Aktueller Netzbezug [kW] Readonly -->
                                <div class="input-group mb-3" style="margin-top:5%;">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%; width:270px;">
                                        <img src="/images/pop-up/netzbezug.png" style="margin-right:10px;">
                                        Aktueller Netzbezug [kW]</span>
                                    <input type="text" class="form-control3" id="AktuellerNetzbezugAuge"
                                        name="Aktueller Netzbezug" aria-label="Aktueller Netzbezug"
                                        aria-describedby="basic-addon1" value=""
                                        style="width:160px; background-color:#e9ecef;" readonly>
                                </div>
                            </details>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ES Auge Ende -->



        <!-- ET Auge -->
        <div class="modal modal2 fade" id="PopUpETAuge" tabindex="-1" role="dialog"
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
                            <!-- Wird nur am Seitenaufruf gemacht und nicht zwischendurch, deswegen werden die Attribut-Daten beim Klick auf Stift neu geladen-->
                            @csrf
                            <!--Input Felder -->
                            <!--Input ID-ES  Readonly -->
                            <div class="input-group mb-3" style="margin-top:2%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/id.png" style="margin-right:10px;">
                                    ID-ES</span>
                                <input type="text" class="form-control3" id="IDESAugeET" name="IDESAugeET"
                                    aria-label="IDESAugeET" aria-describedby="basic-addon1" value="" readonly
                                    style="background-color:#e9ecef;">
                            </div>
                            <!--Input ID-ET  Readonly -->
                            <div class="input-group mb-3" style="margin-top:2%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/id.png" style="margin-right:10px;">
                                    ID-ET</span>
                                <input type="text" class="form-control3" id="IDETAugeET" aria-label="IDETAugeET"
                                    aria-describedby="basic-addon1" name="IDETAugeET" value="" readonly
                                    style="background-color:#e9ecef;">
                            </div>
                            <!--Input Bezeichnung Readonly -->
                            <div class="input-group mb-3" style="margin-top:2%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/name.png" style="margin-right:10px;">
                                    Bezeichnung</span>
                                <input type="text" class="form-control3" id="BezeichnungAugeET"
                                    aria-label="BezeichnungAugeET" aria-describedby="basic-addon1" name="Postleitzahl"
                                    value="" readonly style="background-color:#e9ecef;">
                            </div>
                            <!--Input Typ Readonly -->
                            <div class="input-group mb-3" style="margin-top:2%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/typ.png" style="margin-right:10px;">
                                    Typ</span>
                                <input type="text" class="form-control3" id="TypAugeET" name="Laengengrad" value=""
                                    readonly style="background-color:#e9ecef;">
                            </div>
                            <!--Input Ort Readonly -->
                            <div class="input-group mb-3" style="margin-top:2%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/ort.png" style="margin-right:10px;">
                                    Ort</span>
                                <input type="text" class="form-control3" id="OrtAugeET" name="Breitengrad" value=""
                                    readonly style="background-color:#e9ecef;">
                            </div>
                            <!--Input Längengrad Readonly -->
                            <div class="input-group mb-3" style="margin-top:2%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/längengrad.png" style="margin-right:10px;">
                                    Längengrad</span>
                                <input type="text" class="form-control3" id="LaengengradAugeET" name="Breitengrad"
                                    value="" readonly style="background-color:#e9ecef;">
                            </div>
                            <!--Input Breitengrad Readonly -->
                            <div class="input-group mb-3" style="margin-top:2%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/breitengrad.png" style="margin-right:10px;">
                                    Breitengrad</span>
                                <input type="text" class="form-control3" id="BreitengradAugeET" name="Breitengrad"
                                    value="" readonly style="background-color:#e9ecef;">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ET Auge Ende -->



        <!-- DataTable Definitionen -->
        <script>
            //DataTable ES Ausgangslage
            $('#table').DataTable({
                "columnDefs": [
                    {
                        "orderable": false,
                        "targets": 3 //Auf 4 kommt man weil man beim zählen bei 0 beginnt ( 0 = ID, 1 = Bezeichnung, 2 = Katastralgemeinde, 3 = Postleitzahl 4 = Mülleimer )
                    }, //Um die Sortierfunktion bei den Icon  zu deaktivieren
                    {
                        "orderable": false,
                        "targets": 4
                    }, //Um die Sortierfunktion bei den Icon Statistiken zu deaktivieren
                    {
                        "orderable": false,
                        "targets": 5
                    } //Um die Sortierfunktion bei den Icon Stift/Auge zu deaktivieren
                ],
                lengthChange: false, //Auswahl wieviele Pro Seite man sehen möchte, False da immer max. 5 angezeigt werden

                lengthMenu: [5], //Wieviele ES/ET pro Seite angezeigt werden 
                language: {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json" //Sprache des DataTables z.B. der Buttenbeschriftung
                }

            });

            //DataTable ET
            var tableET = $('#tableET').DataTable({  
                "columnDefs": [
                    {
                        "orderable": false,
                        "targets": 3
                    }, //Um die Sortierfunktion bei den Icon Mülleimer zu deaktivieren
                    {
                        "orderable": false,
                        "targets": 4
                    }, //Um die Sortierfunktion bei den Icon Statistiken zu deaktivieren
                    {
                        "orderable": false,
                        "targets": 5
                    }, //Um die Sortierfunktion bei den Icon Stift/Auge zu deaktivieren
                    {"width": "50%" , "targets": 2}
                
                
                ],
                fixedColumns: true,
                lengthChange: false, //Auswahl wieviele Pro Seite man sehen möchte, False da immer max. 5 angezeigt werden
                lengthMenu: [5], //Wieviele ES/ET pro Seite angezeigt werden 
                language: {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json" //Sprache des DataTables z.B. der Buttenbeschriftung
                }
            });

            //DataTable ES, bei aktualisierung des ES DataTables
            $('#tableES').DataTable({
                "columnDefs": [{
                        "orderable": false,
                        "targets": 3
                    }, //Um die Sortierfunktion bei den Icon Mülleimer zu deaktivieren
                    {
                        "orderable": false,
                        "targets": 4
                    }, //Um die Sortierfunktion bei den Icon Statistiken zu deaktivieren
                    {
                        "orderable": false,
                        "targets": 5
                    } //Um die Sortierfunktion bei den Icon Stift/Auge zu deaktivieren
                ],
                lengthChange: false, //Auswahl wieviele Pro Seite man sehen möchte, False da immer max. 5 angezeigt werden

                lengthMenu: [5], //Wieviele ES/ET pro Seite angezeigt werden 
                language: {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json" //Sprache des DataTables z.B. der Buttenbeschriftung
                }
            });
        </script>

    </body>


    <script>
        var activeMarker = false; //Boolean Wert zum Überprüfen ob ein ES Marker gerade ausgewählt ist
        var activeClick = false;  //Boolean Wert zum Überprüfen ob ein ES Marker gerade abgewählt wird
        var markersArray = []; //Array zum speichern der Daten

        function initAutocomplete() {
            //Hier werden die Map Optionen definiert
            let mapOptions = {
                center: new google.maps.LatLng('48.14078077082782',
                    '15.14955200012205'), //Ausgangspostion der Map beim Laden (Wieselburg)
                zoom: 12, //Zoom Level beim Laden der Map
                mapTypeId: "roadmap", //Typ der Map Road Map (weitere: satellite, hybrid, terrain)
                streetViewControl: false, // Street View Männdchen rechts unten ausblenden
                mapId: '23802346582caa31', // MapID von der selbst erstellen Map                     Enter Map: 23802346582caa31 Kronstana Map: 396ac7c2d5bcd46
                draggableCursor: 'crosshair', //Curser auf der Map
                scrollwheel: true, //dass Mausscrollen ohne Probleme funktioniert
                fullscreenControl: false, //Vollbild Button entfernen
                scaleControl: true, //Maßstabselement rechts unten anzeigen
                zoomControl: false, //rechts unten Zoom Buttons
                mapTypeControl: true, // Button um zwischen Satellit und Roadmap wechseln
                mapTypeControlOptions: { //Unterfunktionen bei Satellit und Roadmap ausblenden
                    style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                    mapTypeIds: [
                        google.maps.MapTypeId.ROADMAP,
                        google.maps.MapTypeId.SATELLITE
                    ]
                },

            }
            //Autocomplete für das Addresssuchfeld
            autocomplete = new google.maps.places.Autocomplete((document.getElementById('address')), {
                types: ['geocode']
            });

            //Der Map die MapOptions zuordnen
            var map = new google.maps.Map(document.getElementById('map'), mapOptions);

            //Addresssuchfeld beginnt bei Click auf Button oder
            $('div#find').on('click', function() {
                LatLngSearch();
            });

            // oder bei ENTER
            $('#address').bind("enterKey", function(e) {
                LatLngSearch();
            });
            $('#address').keyup(function(e) {
                if (e.keyCode == 13) {
                    LatLngSearch();
                }
            });

            //Aus der Addresse die Koordinaten bekommen
            function LatLngSearch() {

                var value = $('input#address').val();

                if (value) {
                    var request = $.ajax({
                        url: "/mapsLocation", //Route im web.php
                        method: "GET",
                        data: {
                            address: value
                        },
                        dataType: 'json',
                        success: function(result) {
                            //Neue Koordinaten
                            var searchLatLng = {
                                lat: result['lat'],
                                lng: result['lng']
                            };

                            // Bei erfolgreichen Umwandeln werden die neuen Koordinaten auf der Map angezeigt
                            mapOptions.center = searchLatLng
                            mapOptions.zoom = 14
                            var map = new google.maps.Map(document.getElementById('map'), mapOptions);

                            //Anschließend werden alle Marker auf der Map plaziert
                            setESMarker(map);
                            @auth //Gast darf keine ES erstellen
                                map.addListener("click", (e) => { //Ausgefürht wenn Map-Klick -> Um ein ES hinzufügen zu können
                                if(!activeMarker){ //Überprüfung ob e kein ES ausgewählt ist
                                breit = e.latLng.toString().substring(1, 16); //Breitengrad-Koordinaten des Klickes speichern
                                lang = e.latLng.toString().substring(20, 35); //Längengrad-Koordinaten des Klickes speichern
                                document.getElementById("LaengengradES").setAttribute('value',breit); //Koordinaten den Input Feldern hinzufügen(PopUpES)
                                document.getElementById("BreitengradES").setAttribute('value', lang); //Koordinaten den Input Feldern hinzufügen (PopUpES)
                            
                                $('#PopUpESHinzufügen').modal('show'); //PopUpESHinzufügen öffnen
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

            //Generelle Map-Funktionen

            @auth //Gast darf keine ES erstellen somit ist hier die Überprüfung auf Authentifizierung notwendig
                //Map-Klick Listener
                map.addListener("click", (e) => { //Ausgefürht bei einem Map-Klick
                if(!activeMarker){ //Überprüfung ob kein ES ausgewählt ist, denn wenn ein ES ausgewählt ist hat man ja die Option ET hinzuzufügen
                breit = e.latLng.toString().substring(1, 16); //Breitengrad-Koordinaten des Klickes speichern
                lang = e.latLng.toString().substring(20, 35); //Längengrad-Koordinaten des Klickes speichern
                document.getElementById("LaengengradES").setAttribute('value',breit); //Koordinaten den Input Feldern hinzufügen (PopUpES)
                document.getElementById("BreitengradES").setAttribute('value', lang); //Koordinaten den Input Feldern hinzufügen (PopUpES)
            
                $('#PopUpESHinzufügen').modal('show'); //PopUpESHinzufügen öffnen
                }
                });
            @endauth

            google.maps.event.addListenerOnce(map, 'idle', function() { //Diese Funktion wird ausgeführt wenn die Map geladen wird
                //Hier werden die Marker auf der Karte plaziert
                setESMarker(map); //Funktion um die Marker zu setzen
            });

        }
    </script>

    <!-- Hier gehört der API Key eingebunden   -->
    <!-- Tovias API Key: AIzaSyDiSVawVLzIwn_GksL2Mc6HjoEqWhBfXvs-->
    <!-- Entner API Key: AIzaSyDboUvk9ElphosPEFC-Am9XzHFsmnOZR7I-->

    <!-- key=.....&callback= initAutocomplete Funktion wird aufgerufen-->
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDboUvk9ElphosPEFC-Am9XzHFsmnOZR7I&libraries=places&callback=initAutocomplete">
    </script>


    <!-- Hier werden die Daten aus der Datenbank herausgelesen und in ein Array gespeichert, um später darauf zugreifen zu können-->
    <?php
    //Datenbank Daten
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'laravel';
    
    //Connection aufbauen
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    //Connection überprüfen 
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    } else {
        $es_select = 'SELECT id, Bezeichnung, Laengengrad, Breitengrad, Postleitzahl, Katastralgemeinden FROM EnSys'; // Select Statement für ES Daten
        //$es_select = DB::table('EnSys')->get(); // ES Select mit Laravel
    
        $et_select = 'SELECT id, ensys_id, Typ, Bezeichnung, Ort, Breitengrad, Laengengrad, Beschreibung, Bild  FROM EnTech'; // Select Statement für ET Daten
        //$et_select = DB::table('EnTech')->get(); //ET Select mit Laravel
    

        $es_result = $conn->query($es_select); //für SQL DB Conn ES
        $et_result = $conn->query($et_select); //für SQL DB Conn ET
    
        //$es_result = $es_select; //für laravel DB Conn
        //$et_result2 = $et_select; //für laravel DB Conn

        //Arrays
        $DB_Daten_ES = [];
        $DB_Daten_ET = [];
    
        //Überprüfung auf Inhalt des Ergebnisses des Select-Statements
        if ($es_result->num_rows > 0) {
        //Jeder Datensatz wird nach der Reihe als Array gespeichert
            while ($row = $es_result->fetch_assoc()) { 
              $sqlES = "['{$row['Bezeichnung']}', {$row['Laengengrad']}, {$row['Breitengrad']}, {$row['id']}, {$row['Postleitzahl']}, '{$row['Katastralgemeinden']}']";
                array_push($DB_Daten_ES, $sqlES);
            }
        }
        
        //Überprüfung auf Inhalt des Ergebnisses des Select-Statements
        if ($et_result->num_rows > 0) {
            //Jeder Datensatz wird nach der Reihe als Array gespeichert
            while ($row = $et_result->fetch_assoc()) {
                $sqlET = "['{$row['Bezeichnung']}', {$row['Laengengrad']}, {$row['Breitengrad']}, {$row['ensys_id']}, '{$row['Typ']}', '{$row['Ort']}', '{$row['id']}','{$row['Beschreibung']}','{$row['Bild']}']";
                array_push($DB_Daten_ET, $sqlET);
            }
            $conn->close(); //Datenbank Connection wieder schließen
        }
    
        //ES in Array übertragen
        echo '<script>var DB_Daten_ES = ['; //in das Array DB_Daten_ES in JS die Daten übertragen 
    
            foreach ($DB_Daten_ES as $dbES) { //Jeder Datensatz wird nach der Reihe übertragen
                echo $dbES . ',';
            } //Anschließend wird später immer auf das Array DB_Daten_ES zugegriffen um an die ES Daten aus der DB zu gelangen
    
        echo ']</script>';
    
        //ET in Array übertragen
        echo '<script>var DB_Daten_ET = [';  //in das Array DB_Daten_ET in JS die Daten übertragen
    
            foreach ($DB_Daten_ET as $dbET) { //Jeder Datensatz wird nach der Reihe übertragen
                echo $dbET . ',';
            } //Anschließend wird später immer auf das Array DB_Daten_ES zugegriffen um an die ET Daten aus der DB zu gelangen
    
        echo ']</script>';
    }
    
    ?>


    <!-- Statistik(Grafana), Stift(Editieren) und Auge(Nur anschauen) Funktionen -->
    <script>
        //Stift-Funktion zum Editieren von ES
        function EditfunctionES(id) { //Wird die ID des ES mitgegeben
            $('#PopUpESEditieren').modal('show'); //Das PopUpESEditieren zum Editieren öffnen

            //Variablen zum Berechnen der Attribute die beim ES mehr Details zu sehen sind
            var AzErzeuger = 0;
            var AzVerbraucher = 0;
            var AzSpeicher = 0;
            var GesNennleistung = 0;
            var GesEnergie = 0;
            var GesVerbraucherLeistung = 0;
            var GesVerbraucherEnergie = 0;
            var GesErzeugerLeistung = 0;
            var GesErzeugerEnergie = 0;
            var GesSpeicherKapazität = 0;
            var AktuellerNetzbezug = 0; //AktuellerNetzbezug = Differenz von GesVerbraucherLeistung & GesErzeugerLeistung 


            //Berechnungen der Attribute
            DB_Daten_ET.forEach(locET => { //Hier wird jede einzelne ET nacheinander durchgegangen

                if (locET[3] == id) { //Überprüfung damit nur ET aus dem ausgewählten ES gezählt werden 

                    switch (locET[4]) { //Switch Anweisung mit dem Typ der ET
                        //Bei Typ PV-Anlage
                        case "PV-Anlage":
                            AzErzeuger++; //Az-Erzeuger um eins erhöhen
                            @foreach ($etpv as $pv) //Zugriff auf die Echtzeitdaten der PV
                                if ({{ $pv->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten von der richtigen PV genommen werden EnTech_id müssen übereinstimmen  
                                {
                                    GesNennleistung += {{ $pv->Leistung }}; //Leistung der PV zur GesNennleistung addieren
                                    GesEnergie += {{ $pv->Energie }}; //Energie der PV zur GesEnergie addieren
                                    GesErzeugerLeistung += {{ $pv->Leistung }}; //Leistung der PV zur GesErzeugerLeistung addieren
                                    GesErzeugerEnergie += {{ $pv->Energie }}; //Energie der PV zur GesErzeugerEnergie addieren
                                }
                            @endforeach
                            break; 

                        //Bei Typ Stromnetzbezug
                        case "Stromnetzbezug":
                            AzErzeuger++; //Az-Erzeuger um eins erhöhen
                            @foreach ($etsnb as $s) 
                                if ({{ $s->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden 
                                {
                                    GesNennleistung += {{ $s->Leistung }}; //Leistung des Stromnetzbezuges zur GesNennleistung addieren
                                    GesEnergie += {{ $s->Energie }}; //Energie des Stromnetzbezuges zur GesEnergie addieren
                                    GesErzeugerLeistung += {{ $s->Leistung }};  //Leistung des Stromnetzbezuges GesErzeugerLeistung addieren
                                    GesErzeugerEnergie += {{ $s->Energie }}; //Energie des Stromnetzbezuges zur GesErzeugerEnergie addieren
                                }
                            @endforeach
                            break;

                        //Bei Typ Batteriespeicher
                        case "Batteriespeicher":
                            AzSpeicher++; //Az-Speicher um eins erhöhen
                            @foreach ($etbs as $b)
                                if ({{ $b->EnTech_id }} == locET[6] )  //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                { 
                                    GesNennleistung += {{ $b->Leistung }};  //Leistung des Batteriespeichers zur GesNennleistung addieren
                                    GesEnergie += {{ $b->Energie }};        //Energie des Batteriespeichers zur GesEnergie addieren
                                    GesSpeicherKapazität += {{ $b->Speicherkap }}; //Speicherkapazität des Batteriespeichers zur GesSpeicherKapazität addieren
                                }
                            @endforeach
                            break;

                        //Bei Typ Wasserstoff Elektrolyse
                        case "Wasserstoff Elektrolyse":
                            AzVerbraucher++; //Az-Verbraucher um eins erhöhen
                            @foreach ($etwe as $w)
                                if ({{ $w->EnTech_id }} == locET[6] )  //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                {
                                    GesNennleistung += {{ $w->Leistung }}; //Leistung der Wasserstoff Elektrolyse zur GesNennleistung addieren
                                    GesEnergie += {{ $w->Energie }};        //Energie der Wasserstoff Elektrolyse zur GesEnergie addieren
                                    GesVerbraucherLeistung += {{ $w->Leistung }};  //Leistung der Wasserstoff Elektrolyse zur GesVerbraucherLeistung addieren
                                    GesVerbraucherEnergie += {{ $w->Energie }}; //Energie der Wasserstoff Elektrolyse zur GesVerbraucherEnergie addieren
                                }
                            @endforeach
                            break;

                        //Bei Typ Wasserstoff Brennstoffzelle
                        case "Wasserstoff Brennstoffzelle":
                            AzErzeuger++; //Az-Erzeuger um eins erhöhen
                            @foreach ($etbsz as $b)
                                if ({{ $b->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                { 
                                    GesNennleistung += {{ $b->Leistung }}; //Leistung der Wasserstoff Brennstoffzelle zur GesNennleistung addieren
                                    GesEnergie += {{ $b->Energie }}; //Energie der Wasserstoff Brennstoffzelle zur GesEnergie addieren
                                    GesErzeugerLeistung += {{ $b->Leistung }}; //Leistung der Wasserstoff Brennstoffzelle zur GesErzeugerLeistung addieren
                                    GesErzeugerEnergie += {{ $b->Energie }}; //Energie der Wasserstoff Brennstoffzelle zur GesErzeugerEnergie addieren
                                }
                            @endforeach
                            break;

                        //Bei Typ Wasserstoff Speicher
                        case "Wasserstoff Speicher":
                            AzSpeicher++; //Az-Speicher um eins erhöhen
                            @foreach ($etws as $w)
                                if ({{ $w->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                {
                                GesNennleistung += {{ $w->Leistung }}; //Leistung der Wasserstoff Speicher zur GesNennleistung addieren
                                GesEnergie += {{ $w->Energie }}; //Energie der Wasserstoff Speicher zur GesEnergie addieren
                                GesSpeicherKapazität += {{ $w->Speicherkap }}; //Speicherkapazität der Wasserstoff Speicher zur GesSpeicherKapazität addieren
                                }
                            @endforeach
                            break;
                        //Bei Typ Windkraftanlage
                        case "Windkraftanlage":
                            AzErzeuger++; //Az-Erzeuger um eins erhöhen
                            @foreach ($etwka as $w)
                                if ({{ $w->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                {
                                    GesNennleistung += {{ $w->Leistung }}; //Leistung der Windkraftanlage zur GesNennleistung addieren
                                    GesEnergie += {{ $w->Energie }}; //Energie der Windkraftanlage zur GesEnergie addieren
                                    GesErzeugerLeistung += {{ $w->Leistung }}; //Leistung der Windkraftanlage zur GesErzeugerLeistung addieren
                                    GesErzeugerEnergie += {{ $w->Energie }}; //Energie der Windkraftanlage zur GesErzeugerEnergie addieren
                                }
                            @endforeach
                            break;

                         //Bei Typ Ladestation
                        case "E-Ladestation":
                            AzVerbraucher++; //Az-Verbraucher um eins erhöhen
                            @foreach ($etel as $e)
                                if ({{ $e->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                {
                                    GesNennleistung += {{ $e->Leistung }}; //Leistung der E-Ladestation zur GesNennleistung addieren
                                    GesEnergie += {{ $e->Energie }}; //Energie der E-Ladestation zur GesEnergie addieren
                                    GesVerbraucherLeistung += {{ $e->Leistung }}; //Leistung der E-Ladestation zur GesVerbraucherLeistung addieren
                                    GesVerbraucherEnergie += {{ $e->Energie }}; //Energie der E-Ladestation zur GesVerbraucherEnergie addieren
                                }
                            @endforeach
                            break;

                        //Bei Typ Hausanschlusszähler
                        case "Hausanschlusszähler":
                            AzVerbraucher++; //Az-Verbraucher um eins erhöhen
                            @foreach ($ethaz as $h)
                                if ({{ $h->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                {
                                    GesNennleistung += {{ $h->Leistung }}; //Leistung des Hausanschlusszähler zur GesNennleistung addieren
                                    GesEnergie += {{ $h->Energie }}; //Energie des Hausanschlusszähler zur GesEnergie addieren
                                    GesVerbraucherLeistung += {{ $h->Leistung }}; //Leistung des Hausanschlusszähler zur GesVerbraucherLeistung addieren
                                    GesVerbraucherEnergie += {{ $h->Energie }}; //Energie des Hausanschlusszähler zur GesVerbraucherEnergie addieren
                                }
                            @endforeach
                            break;

                        //Bei Typ Wärmenetzbezug
                        case "Wärmenetzbezug":
                            AzErzeuger++; //Az-Erzeuger um eins erhöhen
                            @foreach ($etwnb as $w)
                                if ({{ $w->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                {
                                    GesNennleistung += {{ $w->Leistung }}; //Leistung des Wärmenetzbezuges zur GesNennleistung addieren
                                    GesEnergie += {{ $w->Energie }}; //Energie des Wärmenetzbezuges zur GesEnergie addieren
                                    GesErzeugerLeistung += {{ $w->Leistung }}; //Leistung des Wärmenetzbezuges zur GesErzeugerLeistung addieren
                                    GesErzeugerEnergie += {{ $w->Energie }}; //Energie des Wärmenetzbezuges zur GesErzeugerEnergie addieren
                                }
                            @endforeach
                            break;

                        //Bei Typ Biomasseheizkraftwerk
                        case "Biomasseheizkraftwerk":
                            AzVerbraucher++; //Az-Verbraucher um eins erhöhen
                            AzErzeuger++; //Az-Erzeuger um eins erhöhen

                            @foreach ($etbhkw as $b)
                                if ({{ $b->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                {
                                    GesNennleistung += {{ $b->Leistung }}; //Leistung des Biomasseheizkraftwerkes zur GesNennleistung addieren
                                    GesEnergie += {{ $b->Energie }}; //Energie des Biomasseheizkraftwerkes zur GesEnergie addieren
                                    GesVerbraucherLeistung += {{ $b->Leistung }}; //Leistung des Biomasseheizkraftwerkes zur GesVerbraucherLeistung addieren
                                    GesVerbraucherEnergie += {{ $b->Energie }}; //Energie des Biomasseheizkraftwerkes zur GesVerbraucherEnergie addieren
                                    GesErzeugerLeistung += {{ $b->Leistung }}; //Leistung des Biomasseheizkraftwerkes zur GesErzeugerLeistung addieren
                                    GesErzeugerEnergie += {{ $b->Energie }}; //Energie des Biomasseheizkraftwerkes zur GesErzeugerEnergie addieren
                                }
                            @endforeach
                            break;

                        //Bei Typ Biomasseheizwerk
                        case "Biomasseheizwerk":
                            AzVerbraucher++; //Az-Verbraucher um eins erhöhen
                            AzErzeuger++; //Az-Erzeuger um eins erhöhen
                            @foreach ($etbmhw as $b)
                                if ({{ $b->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                {
                                    GesNennleistung += {{ $b->Leistung }}; //Leistung des Biomasseheizwerkes zur GesNennleistung addieren
                                    GesEnergie += {{ $b->Energie }}; //Energie des Biomasseheizwerkes zur GesEnergie addieren
                                    GesVerbraucherLeistung += {{ $b->Leistung }}; //Leistung des Biomasseheizwerkes zur GesVerbraucherLeistung addieren
                                    GesVerbraucherEnergie += {{ $b->Energie }}; //Energie des Biomasseheizwerkes zur GesVerbraucherEnergie addieren
                                    GesErzeugerLeistung += {{ $b->Leistung }}; //Leistung des Biomasseheizwerkes zur GesErzeugerLeistung addieren
                                    GesErzeugerEnergie += {{ $b->Energie }}; //Energie des Biomasseheizwerkes zur GesErzeugerEnergie addieren
                                }
                            @endforeach
                            break;

                        //Bei Typ Biomasseheizkessel
                        case "Biomasseheizkessel":
                            AzVerbraucher++; //Az-Verbraucher um eins erhöhen
                            AzErzeuger++; //Az-Erzeuger um eins erhöhen
                            @foreach ($etbmhk as $b)
                                if ({{ $b->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                {
                                    GesNennleistung += {{ $b->Leistung }}; //Leistung des Biomasseheizkessels zur GesNennleistung addieren
                                    GesEnergie += {{ $b->Energie }}; //Energie des Biomasseheizkessels zur GesEnergie addieren
                                    GesVerbraucherLeistung += {{ $b->Leistung }}; //Leistung des Biomasseheizkessels zur GesVerbraucherLeistung addieren
                                    GesVerbraucherEnergie += {{ $b->Energie }}; //Energie des Biomasseheizkessels zur GesVerbraucherEnergie addieren
                                    GesErzeugerLeistung += {{ $b->Leistung }}; //Leistung des Biomasseheizkessels zur GesErzeugerLeistung addieren
                                    GesErzeugerEnergie += {{ $b->Energie }}; //Energie des Biomasseheizkessels zur GesErzeugerEnergie addieren
                                }
                            @endforeach
                            break;

                        //Bei Typ Wärmespeicher
                        case "Wärmespeicher":
                            AzSpeicher++; //Az-Speicher um eins erhöhen
                            @foreach ($etwes as $w)
                                if ({{ $w->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                {
                                    GesNennleistung += {{ $w->Leistung }}; //Leistung des Wärmespeichers zur GesNennleistung addieren
                                    GesEnergie += {{ $w->Energie }}; //Energie des Wärmespeichers zur GesEnergie addieren
                                    //keine Speicherkapazität sondern TempUnten TempMitte TempOben
                                }
                            @endforeach
                            break;

                        //Bei Typ Solarthermieanlage
                        case "Solarthermieanlage":
                            AzErzeuger++; //Az-Erzeuger um eins erhöhen
                            @foreach ($etsth as $s)
                                if ({{ $s->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                {
                                    GesNennleistung += {{ $s->Leistung }}; //Leistung der Solarthermieanlage zur GesNennleistung addieren
                                    GesEnergie += {{ $s->Energie }}; //Energie der Solarthermieanlage zur GesEnergie addieren
                                    GesErzeugerLeistung += {{ $s->Leistung }}; //Leistung der Solarthermieanlage zur GesErzeugerLeistung addieren
                                    GesErzeugerEnergie += {{ $s->Energie }}; //Energie der Solarthermieanlage zur GesErzeugerEnergie addieren
                                }
                            @endforeach
                            break;

                        //Bei Typ Wärmepumpe
                        case "Wärmepumpe":
                            AzErzeuger++; //Az-Erzeuger um eins erhöhen

                            @foreach ($etwp as $w)
                                if ({{ $w->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                {
                                    GesNennleistung += {{ $w->Leistung }}; //Leistung der Wärmepumpe zur GesNennleistung addieren
                                    GesEnergie += {{ $w->Energie }}; //Energie der Wärmepumpe zur GesEnergie addieren
                                    GesErzeugerLeistung += {{ $w->Leistung }}; //Leistung der Wärmepumpe zur GesErzeugerLeistung addieren
                                    GesErzeugerEnergie += {{ $w->Energie }}; //Energie der Wärmepumpe zur GesErzeugerEnergie addieren
                                }
                            @endforeach
                            break;

                        //Bei Typ Gebäude Wärmebedarfszähler
                        case "Gebäude Wärmebedarfszähler":
                            AzVerbraucher++; //Az-Verbraucher um eins erhöhen
                            //etgwbz hat keine Leistung oder Energie sondern nur Zählerstand
                            break;

                        //Bei Typ Kompressionskältemaschine
                        case "Kompressionskältemaschine":
                            AzVerbraucher++; //Az-Verbraucher um eins erhöhen
                            AzErzeuger++; //Az-Erzeuger um eins erhöhen
                            @foreach ($etkkm as $k)
                                if ({{ $k->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                {
                                    GesNennleistung += {{ $k->Leistung }}; //Leistung der Kompressionskältemaschine zur GesNennleistung addieren
                                    GesEnergie += {{ $k->Energie }}; //Energie der Kompressionskältemaschine zur GesEnergie addieren
                                    GesVerbraucherLeistung += {{ $k->Leistung }}; //Leistung der Kompressionskältemaschine zur GesVerbraucherLeistung addieren
                                    GesVerbraucherEnergie += {{ $k->Energie }}; //Energie der Kompressionskältemaschine zur GesVerbraucherEnergie addieren
                                    GesErzeugerLeistung += {{ $k->Leistung }}; //Leistung der Kompressionskältemaschine zur GesErzeugerLeistung addieren
                                    GesErzeugerEnergie += {{ $k->Energie }}; //Energie der Kompressionskältemaschine zur GesErzeugerEnergie addieren
                                }
                            @endforeach
                            break;

                        //Bei Typ Ab oder Adsorbtionskältemaschine
                        case "Ab oder Adsorbtionskältemaschine":
                            AzVerbraucher++; //Az-Verbraucher um eins erhöhen
                            AzErzeuger++; //Az-Erzeuger um eins erhöhen
                            @foreach ($etadabkm as $e)
                                if ({{ $e->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                { 
                                    GesNennleistung += {{ $e->Leistung }}; //Leistung der Ab oder Adsorbtionskältemaschine zur GesNennleistung addieren
                                    GesEnergie += {{ $e->Energie }}; //Energie der Ab oder Adsorbtionskältemaschine zur GesEnergie addieren
                                    GesVerbraucherLeistung += {{ $e->Leistung }}; //Leistung der Ab oder Adsorbtionskältemaschine zur GesVerbraucherLeistung addieren
                                    GesVerbraucherEnergie += {{ $e->Energie }}; //Energie der Ab oder Adsorbtionskältemaschine zur GesVerbraucherEnergie addieren
                                    GesErzeugerLeistung += {{ $e->Leistung }}; //Leistung der Ab oder Adsorbtionskältemaschine zur GesErzeugerLeistung addieren
                                    GesErzeugerEnergie += {{ $e->Energie }}; //Energie der Ab oder Adsorbtionskältemaschine zur GesErzeugerEnergie addieren
                                }
                            @endforeach
                            break;

                        //Bei Typ Kältespeicher
                        case "Kältespeicher":
                            AzSpeicher++; //Az-Speicher um eins erhöhen
                            @foreach ($etks as $k)
                                if ({{ $k->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                {
                                    GesNennleistung += {{ $k->Leistung }}; //Leistung des Kältespeichers zur GesNennleistung addieren
                                    GesEnergie += {{ $k->Energie }}; //Energie des Kältespeichers zur GesEnergie addieren
                                    GesSpeicherKapazität += {{ $k->Speicherkap }}; //Speicherkapazität des Kältespeichers zur GesSpeicherKapazität addieren
                                }
                            @endforeach
                            break;

                        //Bei Typ Gebäude Kältebedarfszähle
                        case "Gebäude Kältebedarfszähler":
                            AzVerbraucher++; //Az-Verbraucher um eins erhöhen
                            //etgkbz hat keine Leistung nur Zählerstand
                            break;
                    }
                }
            }) //foreach für jede ET aus


            //Berechnung des aktuellen Netzbezuges
            AktuellerNetzbezug = GesVerbraucherLeistung - GesErzeugerLeistung;
            if (AktuellerNetzbezug < 0) { //wenn mehr Leistung erzeugt wird als verbraucht wird ist der aktuelle Netzbezug 0
                AktuellerNetzbezug = 0;
            }

            //Hier werden die Input Felder des PopUps mit Daten befüllt 
            DB_Daten_ES.forEach(dbES => {
                if (dbES[3] == id) {  //Überprüfung ob ES ID's übereinstimmen
                    $("#BezeichnungESEdit").val(dbES[0]); //Input Feld mit der ID BezeichnungESEdit bekommt den Inhalt dbES[0] = Bezeichnung
                    $("#KatastralgemeindeESEdit").val(dbES[5]); //Input Feld bekommt Inhalt
                    $("#PostleitzahlESEdit").val(dbES[4]); //Input Feld bekommt Inhalt
                    $("#LaengengradESEdit").val(dbES[1]); //Input Feld bekommt Inhalt
                    $("#BreitengradESEdit").val(dbES[2]); //Input Feld bekommt Inhalt
                    $("#Az-Erzeugungstechnologien").val(AzErzeuger); //Input Feld bekommt Inhalt
                    $("#Az-Verbraucher").val(AzVerbraucher); //Input Feld bekommt Inhalt
                    $("#Az-Speicher").val(AzSpeicher); //Input Feld bekommt Inhalt
                    $("#Ges-Nennleistung").val(GesNennleistung); //Input Feld bekommt Inhalt
                    $("#Ges-Energie").val(GesEnergie); //Input Feld bekommt Inhalt
                    $("#Ges-VerbraucherLeistung").val(GesVerbraucherLeistung); //Input Feld bekommt Inhalt
                    $("#Ges-VerbraucherEnergie").val(GesVerbraucherEnergie); //Input Feld bekommt Inhalt
                    $("#Ges-ErzeugerLeistung").val(GesErzeugerLeistung); //Input Feld bekommt Inhalt
                    $("#Ges-ErzeugerEnergie").val(GesErzeugerEnergie); //Input Feld bekommt Inhalt
                    $("#Ges-SpeicherKapazität").val(GesSpeicherKapazität); //Input Feld bekommt Inhalt
                    $("#AktuellerNetzbezug").val(AktuellerNetzbezug); //Input Feld bekommt Inhalt
                    $("#editForm").attr("action", "/edit/" + id)
                }
            })

        }

        //Stift-Funktion zum Editieren von ET
        function EditfunctionET(id) { //Wird die ID des ET mitgegeben
            $('#PopUpETEditieren').modal('show'); //Das PopUpETEditieren zum Editieren öffnen
        
            
            DB_Daten_ET.forEach(locEt => { //Hier wird jede einzelne ET nacheinander durchgegangen
                if (locEt[6] == id) {  //Überprüfung ob die EnTech_id die gleiche ist wie die übergebene/ausgewählte ID
                    $("#IdEditES").val(locEt[3]); //Input Feld bekommt den Inhalt 
                    $("#IdEditET").val(locEt[6]); //Input Feld bekommt den Inhalt
                    $("#BezeichnungEditET").val(locEt[0]); //Input Feld bekommt den Inhalt
                    $("#OrtEditET").val(locEt[5]); //Input Feld bekommt den Inhalt
                    $("#TypEditET").val(locEt[4]); //Input Feld bekommt den Inhalt
                    $("#LaengengradEditET").val(locEt[1]); //Input Feld bekommt den Inhalt
                    $("#BreitengradEditET").val(locEt[2]); //Input Feld bekommt den Inhalt
                    $("#BeschreibungEditET").val(locEt[7]); //Input Feld bekommt den Inhalt
                    $("#editFormET").attr("action", "/editET/" + id)
                }
            })
        }

        //Statistik-Funktion von ES
        //function GrafanafunctionES(id) {
           // $('#PopUpESGrafana').modal('show'); //Das PopUpESGrafana zum Anschauen der ES Statistiken öffnen
           // document.getElementById("StatistikIDES").value = id;
   
       // }

        //Statistik-Funktion von ET
       // function GrafanafunctionET(id) {
           // $('#PopUpETGrafana').modal('show'); //Das PopUpETGrafana zum Anschauen der ET Statistiken öffnen
       // }

        //Auge-Funktion zum Anschauen von ES
        function AugefunctionES(id) { //Wird die ID des ES mitgegeben
            $('#PopUpESAuge').modal('show'); //Das PopUpESAuge zum Anschauen öffnen

            //Variablen zum Berechnen der Attribute die beim ES mehr Details zu sehen sind
            var AzErzeuger = 0;
            var AzVerbraucher = 0;
            var AzSpeicher = 0;
            var GesNennleistung = 0;
            var GesEnergie = 0;
            var GesVerbraucherLeistung = 0;
            var GesVerbraucherEnergie = 0;
            var GesErzeugerLeistung = 0;
            var GesErzeugerEnergie = 0;
            var GesSpeicherKapazität = 0;
            var AktuellerNetzbezug = 0; //AktuellerNetzbezug = Differenz von GesVerbraucherLeistung & GesErzeugerLeistung 


            //Berechnungen der Attribute
            DB_Daten_ET.forEach(locET => { //Hier wird jede einzelne ET nacheinander durchgegangen

                if (locET[3] == id) { //Damit nur ET aus dem ausgewählten ES gezählt werden

                    switch (locET[4]) { //Switch Anweisung mit dem Typ der ET
                        //Bei Typ PV-Anlage
                        case "PV-Anlage":
                            AzErzeuger++; //Az-Erzeuger um eins erhöhen
                            @foreach ($etpv as $pv) //Zugriff auf die Echtzeitdaten der PV
                                if ({{ $pv->EnTech_id }} == locET[6] ) //damit nur die PV von diesem ES nimmt
                                {
                                    GesNennleistung += {{ $pv->Leistung }}; //Leistung der PV zur GesNennleistung addieren
                                    GesEnergie += {{ $pv->Energie }}; //Energie der PV zur GesEnergie addieren
                                    GesErzeugerLeistung += {{ $pv->Leistung }}; //Leistung der PV zur GesErzeugerLeistung addieren
                                    GesErzeugerEnergie += {{ $pv->Energie }}; //Energie der PV zur GesErzeugerEnergie addieren
                                }
                            @endforeach
                            break;

                        //Bei Typ Stromnetzbezug
                        case "Stromnetzbezug":
                            AzErzeuger++; //Az-Erzeuger um eins erhöhen
                            @foreach ($etsnb as $s)
                                if ({{ $s->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden 
                                {
                                    GesNennleistung += {{ $s->Leistung }}; //Leistung des Stromnetzbezuges zur GesNennleistung addieren
                                    GesEnergie += {{ $s->Energie }}; //Energie des Stromnetzbezuges zur GesEnergie addieren
                                    GesErzeugerLeistung += {{ $s->Leistung }}; //Leistung des Stromnetzbezuges GesErzeugerLeistung addieren
                                    GesErzeugerEnergie += {{ $s->Energie }}; //Energie des Stromnetzbezuges zur GesErzeugerEnergie addieren
                                }
                            @endforeach
                            break;

                        //Bei Typ Batteriespeicher
                        case "Batteriespeicher":
                            AzSpeicher++; //Az-Speicher um eins erhöhen
                            @foreach ($etbs as $b)
                                if ({{ $b->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                {
                                    GesNennleistung += {{ $b->Leistung }}; //Leistung des Batteriespeichers zur GesNennleistung addieren
                                    GesEnergie += {{ $b->Energie }}; //Energie des Batteriespeichers zur GesEnergie addieren
                                    GesSpeicherKapazität += {{ $b->Speicherkap }}; //Speicherkapazität des Batteriespeichers zur GesSpeicherKapazität addieren
                                }
                            @endforeach
                            break;

                        //Bei Typ Wasserstoff Elektrolyse
                        case "Wasserstoff Elektrolyse":
                            AzVerbraucher++; //Az-Verbraucher um eins erhöhen
                            @foreach ($etwe as $w)
                                if ({{ $w->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                {
                                    GesNennleistung += {{ $w->Leistung }}; //Leistung der Wasserstoff Elektrolyse zur GesNennleistung addieren
                                    GesEnergie += {{ $w->Energie }}; //Energie der Wasserstoff Elektrolyse zur GesEnergie addieren
                                    GesVerbraucherLeistung += {{ $w->Leistung }}; //Leistung der Wasserstoff Elektrolyse zur GesVerbraucherLeistung addieren
                                    GesVerbraucherEnergie += {{ $w->Energie }}; //Energie der Wasserstoff Elektrolyse zur GesVerbraucherEnergie addieren
                                }
                            @endforeach
                            break;

                        //Bei Typ Wasserstoff Brennstoffzelle
                        case "Wasserstoff Brennstoffzelle":
                            AzErzeuger++; //Az-Erzeuger um eins erhöhen
                            @foreach ($etbsz as $b)
                                if ({{ $b->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                {
                                    GesNennleistung += {{ $b->Leistung }}; //Leistung der Wasserstoff Brennstoffzelle zur GesNennleistung addieren
                                    GesEnergie += {{ $b->Energie }}; //Energie der Wasserstoff Brennstoffzelle zur GesEnergie addieren
                                    GesErzeugerLeistung += {{ $b->Leistung }}; //Leistung der Wasserstoff Brennstoffzelle zur GesErzeugerLeistung addieren
                                    GesErzeugerEnergie += {{ $b->Energie }}; //Energie der Wasserstoff Brennstoffzelle zur GesErzeugerEnergie addieren
                                }
                            @endforeach
                            break;

                        //Bei Typ Wasserstoff Speicher
                        case "Wasserstoff Speicher":
                            AzSpeicher++; //Az-Speicher um eins erhöhen
                            @foreach ($etws as $w)
                                if ({{ $w->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                { 
                                    GesNennleistung += {{ $w->Leistung }}; //Leistung der Wasserstoff Speicher zur GesNennleistung addieren
                                    GesEnergie += {{ $w->Energie }}; //Energie der Wasserstoff Speicher zur GesEnergie addieren
                                    GesSpeicherKapazität += {{ $w->Speicherkap }}; //Speicherkapazität der Wasserstoff Speicher zur GesSpeicherKapazität addieren
                                }
                            @endforeach
                            break;

                        //Bei Typ Windkraftanlage
                        case "Windkraftanlage":
                            AzErzeuger++; //Az-Erzeuger um eins erhöhen
                            @foreach ($etwka as $w)
                                if ({{ $w->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                { 
                                    GesNennleistung += {{ $w->Leistung }}; //Leistung der Windkraftanlage zur GesNennleistung addieren
                                    GesEnergie += {{ $w->Energie }}; //Energie der Windkraftanlage zur GesEnergie addieren
                                    GesErzeugerLeistung += {{ $w->Leistung }}; //Leistung der Windkraftanlage zur GesErzeugerLeistung addieren
                                    GesErzeugerEnergie += {{ $w->Energie }}; //Energie der Windkraftanlage zur GesErzeugerEnergie addieren
                                }
                            @endforeach
                            break;

                        //Bei Typ Ladestation
                        case "E-Ladestation":
                            AzVerbraucher++; //Az-Verbraucher um eins erhöhen
                            @foreach ($etel as $e)
                                if ({{ $e->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                {
                                    GesNennleistung += {{ $e->Leistung }}; //Leistung der E-Ladestation zur GesNennleistung addieren
                                    GesEnergie += {{ $e->Energie }}; //Energie der E-Ladestation zur GesEnergie addieren
                                    GesVerbraucherLeistung += {{ $e->Leistung }}; //Leistung der E-Ladestation zur GesVerbraucherLeistung addieren
                                    GesVerbraucherEnergie += {{ $e->Energie }}; //Energie der E-Ladestation zur GesVerbraucherEnergie addieren
                                }
                            @endforeach
                            break;

                        //Bei Typ Hausanschlusszähler
                        case "Hausanschlusszähler":
                            AzVerbraucher++; //Az-Verbraucher um eins erhöhen
                            @foreach ($ethaz as $h)
                                if ({{ $h->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                {
                                    GesNennleistung += {{ $h->Leistung }}; //Leistung des Hausanschlusszähler zur GesNennleistung addieren
                                    GesEnergie += {{ $h->Energie }}; //Energie des Hausanschlusszähler zur GesEnergie addieren
                                    GesVerbraucherLeistung += {{ $h->Leistung }}; //Leistung des Hausanschlusszähler zur GesVerbraucherLeistung addieren
                                    GesVerbraucherEnergie += {{ $h->Energie }}; //Energie des Hausanschlusszähler zur GesVerbraucherEnergie addieren
                                }
                            @endforeach
                            break;

                        //Bei Typ Wärmenetzbezug
                        case "Wärmenetzbezug":
                            AzErzeuger++; //Az-Erzeuger um eins erhöhen
                            @foreach ($etwnb as $w)
                                if ({{ $w->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                {
                                    GesNennleistung += {{ $w->Leistung }}; //Leistung des Wärmenetzbezuges zur GesNennleistung addieren
                                    GesEnergie += {{ $w->Energie }};  //Energie des Wärmenetzbezuges zur GesEnergie addieren
                                    GesErzeugerLeistung += {{ $w->Leistung }}; //Leistung des Wärmenetzbezuges zur GesErzeugerLeistung addieren
                                    GesErzeugerEnergie += {{ $w->Energie }}; //Energie des Wärmenetzbezuges zur GesErzeugerEnergie addieren
                                }
                            @endforeach
                            break;

                        //Bei Typ Biomasseheizkraftwerk
                        case "Biomasseheizkraftwerk":
                            AzVerbraucher++; //Az-Verbraucher um eins erhöhen
                            AzErzeuger++; //Az-Erzeuger um eins erhöhen

                            @foreach ($etbhkw as $b)
                                if ({{ $b->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                {
                                    GesNennleistung += {{ $b->Leistung }}; //Leistung des Biomasseheizkraftwerkes zur GesNennleistung addieren
                                    GesEnergie += {{ $b->Energie }}; //Energie des Biomasseheizkraftwerkes zur GesEnergie addieren
                                    GesVerbraucherLeistung += {{ $b->Leistung }}; //Leistung des Biomasseheizkraftwerkes zur GesVerbraucherLeistung addieren
                                    GesVerbraucherEnergie += {{ $b->Energie }}; //Energie des Biomasseheizkraftwerkes zur GesVerbraucherEnergie addieren
                                    GesErzeugerLeistung += {{ $b->Leistung }}; //Leistung des Biomasseheizkraftwerkes zur GesErzeugerLeistung addieren
                                    GesErzeugerEnergie += {{ $b->Energie }}; //Energie des Biomasseheizkraftwerkes zur GesErzeugerEnergie addieren
                                }
                            @endforeach
                            break;
               
                        //Bei Typ Biomasseheizwerk
                        case "Biomasseheizwerk":
                            AzVerbraucher++; //Az-Verbraucher um eins erhöhen
                            AzErzeuger++; //Az-Erzeuger um eins erhöhen
                            @foreach ($etbmhw as $b)
                                if ({{ $b->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                {
                                    GesNennleistung += {{ $b->Leistung }}; //Leistung des Biomasseheizwerkes zur GesNennleistung addieren
                                    GesEnergie += {{ $b->Energie }}; //Energie des Biomasseheizwerkes zur GesEnergie addieren
                                    GesVerbraucherLeistung += {{ $b->Leistung }}; //Leistung des Biomasseheizwerkes zur GesVerbraucherLeistung addieren
                                    GesVerbraucherEnergie += {{ $b->Energie }}; //Energie des Biomasseheizwerkes zur GesVerbraucherEnergie addieren
                                    GesErzeugerLeistung += {{ $b->Leistung }}; //Leistung des Biomasseheizwerkes zur GesErzeugerLeistung addieren
                                    GesErzeugerEnergie += {{ $b->Energie }}; //Energie des Biomasseheizwerkes zur GesErzeugerEnergie addieren
                                }
                            @endforeach
                            break;

                        //Bei Typ Biomasseheizkessel
                        case "Biomasseheizkessel":
                            AzVerbraucher++; //Az-Verbraucher um eins erhöhen
                            AzErzeuger++; //Az-Erzeuger um eins erhöhen
                            @foreach ($etbmhk as $b)
                                if ({{ $b->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                {
                                    GesNennleistung += {{ $b->Leistung }}; //Leistung des Biomasseheizkessels zur GesNennleistung addieren
                                    GesEnergie += {{ $b->Energie }}; //Energie des Biomasseheizkessels zur GesEnergie addieren
                                    GesVerbraucherLeistung += {{ $b->Leistung }}; //Leistung des Biomasseheizkessels zur GesVerbraucherLeistung addieren
                                    GesVerbraucherEnergie += {{ $b->Energie }}; //Energie des Biomasseheizkessels zur GesVerbraucherEnergie addieren
                                    GesErzeugerLeistung += {{ $b->Leistung }}; //Leistung des Biomasseheizkessels zur GesErzeugerLeistung addieren
                                    GesErzeugerEnergie += {{ $b->Energie }}; //Energie des Biomasseheizkessels zur GesErzeugerEnergie addieren
                                }
                            @endforeach
                            break;

                        //Bei Typ Wärmespeicher
                        case "Wärmespeicher":
                            AzSpeicher++; //Az-Speicher um eins erhöhen
                            @foreach ($etwes as $w)
                                if ({{ $w->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                {
                                    GesNennleistung += {{ $w->Leistung }}; //Leistung des Wärmespeichers zur GesNennleistung addieren
                                    GesEnergie += {{ $w->Energie }}; //Energie des Wärmespeichers zur GesEnergie addieren
                                    //keine Speicherkap sondern TempUnten TempMitte TempOben
                                }
                            @endforeach
                            break;
                
                        //Bei Typ Solarthermieanlage
                        case "Solarthermieanlage":
                            AzErzeuger++; //Az-Erzeuger um eins erhöhen
                            @foreach ($etsth as $s)
                                if ({{ $s->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                {
                                    GesNennleistung += {{ $s->Leistung }}; //Leistung der Solarthermieanlage zur GesNennleistung addieren
                                    GesEnergie += {{ $s->Energie }}; //Energie der Solarthermieanlage zur GesEnergie addieren
                                    GesErzeugerLeistung += {{ $s->Leistung }}; //Leistung der Solarthermieanlage zur GesErzeugerLeistung addieren
                                    GesErzeugerEnergie += {{ $s->Energie }}; //Energie der Solarthermieanlage zur GesErzeugerEnergie addieren
                                }
                            @endforeach
                            break;
               
                        //Bei Typ Wärmepumpe
                        case "Wärmepumpe":
                            AzErzeuger++; //Az-Erzeuger um eins erhöhen
                            @foreach ($etwp as $w)
                                if ({{ $w->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                {
                                    GesNennleistung += {{ $w->Leistung }}; //Leistung der Wärmepumpe zur GesNennleistung addieren
                                    GesEnergie += {{ $w->Energie }}; //Energie der Wärmepumpe zur GesEnergie addieren
                                    GesErzeugerLeistung += {{ $w->Leistung }}; //Leistung der Wärmepumpe zur GesErzeugerLeistung addieren
                                    GesErzeugerEnergie += {{ $w->Energie }}; //Energie der Wärmepumpe zur GesErzeugerEnergie addieren
                                }
                            @endforeach
                            break;

                        //Bei Typ Gebäude Wärmebedarfszähler
                        case "Gebäude Wärmebedarfszähler":
                            AzVerbraucher++; //Az-Verbraucher um eins erhöhen
                            //etgwbz hat keine Leistung oder Energie sondern nur Zählerstand
                            break;
                
                        //Bei Typ Kompressionskältemaschine
                        case "Kompressionskältemaschine":
                            AzVerbraucher++; //Az-Verbraucher um eins erhöhen
                            AzErzeuger++; //Az-Erzeuger um eins erhöhen
                            @foreach ($etkkm as $k)
                                if ({{ $k->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                {
                                    GesNennleistung += {{ $k->Leistung }}; //Leistung der Kompressionskältemaschine zur GesNennleistung addieren
                                    GesEnergie += {{ $k->Energie }}; //Energie der Kompressionskältemaschine zur GesEnergie addieren
                                    GesVerbraucherLeistung += {{ $k->Leistung }}; //Leistung der Kompressionskältemaschine zur GesVerbraucherLeistung addieren
                                    GesVerbraucherEnergie += {{ $k->Energie }}; //Energie der Kompressionskältemaschine zur GesVerbraucherEnergie addieren
                                    GesErzeugerLeistung += {{ $k->Leistung }}; //Leistung der Kompressionskältemaschine zur GesErzeugerLeistung addieren
                                    GesErzeugerEnergie += {{ $k->Energie }}; //Energie der Kompressionskältemaschine zur GesErzeugerEnergie addieren
                                }
                            @endforeach
                            break;
               
                        //Bei Typ Ab oder Adsorbtionskältemaschine
                        case "Ab oder Adsorbtionskältemaschine":
                            AzVerbraucher++; //Az-Verbraucher um eins erhöhen
                            AzErzeuger++; //Az-Erzeuger um eins erhöhen
                            @foreach ($etadabkm as $e)
                                if ({{ $e->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                {
                                    GesNennleistung += {{ $e->Leistung }}; //Leistung der Ab oder Adsorbtionskältemaschine zur GesNennleistung addieren
                                    GesEnergie += {{ $e->Energie }}; //Energie der Ab oder Adsorbtionskältemaschine zur GesEnergie addieren
                                    GesVerbraucherLeistung += {{ $e->Leistung }}; //Leistung der Ab oder Adsorbtionskältemaschine zur GesVerbraucherLeistung addieren
                                    GesVerbraucherEnergie += {{ $e->Energie }}; //Energie der Ab oder Adsorbtionskältemaschine zur GesVerbraucherEnergie addieren
                                    GesErzeugerLeistung += {{ $e->Leistung }}; //Leistung der Ab oder Adsorbtionskältemaschine zur GesErzeugerLeistung addieren
                                    GesErzeugerEnergie += {{ $e->Energie }}; //Energie der Ab oder Adsorbtionskältemaschine zur GesErzeugerEnergie addieren
                                }
                            @endforeach
                            break;
                
                        //Bei Typ Kältespeicher
                        case "Kältespeicher":
                            AzSpeicher++; //Az-Speicher um eins erhöhen
                            @foreach ($etks as $k)
                                if ({{ $k->EnTech_id }} == locET[6] ) //Überprüfung, damit die richtigen Echtzeidaten genommen werden
                                {
                                    GesNennleistung += {{ $k->Leistung }}; //Leistung des Kältespeichers zur GesNennleistung addieren
                                    GesEnergie += {{ $k->Energie }}; //Energie des Kältespeichers zur GesEnergie addieren
                                    GesSpeicherKapazität += {{ $k->Speicherkap }}; //Speicherkapazität des Kältespeichers zur GesSpeicherKapazität addieren
                                }
                            @endforeach
                            break;

                        //Bei Typ Gebäude Kältebedarfszähle
                        case "Gebäude Kältebedarfszähler":
                            AzVerbraucher++; //Az-Verbraucher um eins erhöhen
                            //etgkbz hat keine Leistung oder Energie sondern nur Zählerstand
                            break;


                    }


                }


            }) //foreach für jede ET aus

            //Berechnung des aktuellen Netzbezuges
            AktuellerNetzbezug = GesVerbraucherLeistung - GesErzeugerLeistung;
            if (AktuellerNetzbezug < 0) { //wenn mehr Leistung erzeugt wird als verbraucht wird ist der aktuelle Netzbezug 0
                AktuellerNetzbezug = 0;
            }


            //Hier werden die Input Felder des PopUps mit Daten befüllt 
            DB_Daten_ES.forEach(dbES => {
                if (dbES[3] == id) { //Überprüfung ob ES ID's übereinstimmen
                    $("#BezeichnungAuge").val(dbES[0]); //Input Feld mit der ID BezeichnungESEdit bekommt den Inhalt dbES[0] = Bezeichnung
                    $("#KatastralgemeindeAuge").val(dbES[5]); //Input Feld bekommt Inhalt
                    $("#PostleitzahlAuge").val(dbES[4]); //Input Feld bekommt Inhalt
                    $("#LaengengradAuge").val(dbES[1]); //Input Feld bekommt Inhalt
                    $("#BreitengradAuge").val(dbES[2]); //Input Feld bekommt Inhalt
                    $("#Az-ErzeugungstechnologienAuge").val(AzErzeuger); //Input Feld bekommt Inhalt
                    $("#Az-VerbraucherAuge").val(AzVerbraucher); //Input Feld bekommt Inhalt
                    $("#Az-SpeicherAuge").val(AzSpeicher); //Input Feld bekommt Inhalt
                    $("#Ges-NennleistungAuge").val(GesNennleistung); //Input Feld bekommt Inhalt
                    $("#Ges-EnergieAuge").val(GesEnergie); //Input Feld bekommt Inhalt
                    $("#Ges-VerbraucherLeistungAuge").val(GesVerbraucherLeistung); //Input Feld bekommt Inhalt 
                    $("#Ges-VerbraucherEnergieAuge").val(GesVerbraucherEnergie); //Input Feld bekommt Inhalt
                    $("#Ges-ErzeugerLeistungAuge").val(GesErzeugerLeistung); //Input Feld bekommt Inhalt
                    $("#Ges-ErzeugerEnergieAuge").val(GesErzeugerEnergie); //Input Feld bekommt Inhalt
                    $("#Ges-SpeicherKapazitätAuge").val(GesSpeicherKapazität); //Input Feld bekommt Inhalt
                    $("#AktuellerNetzbezugAuge").val(AktuellerNetzbezug); //Input Feld bekommt Inhalt
                    $("#augeForm")
                }
            })
        }

        //Auge-Funktion zum Anschauen von ET
        function AugefunctionET(id) { //Wird die ID des ET mitgegeben
            $('#PopUpETAuge').modal('show'); //Das PopUpETAuge zum Anschauen öffnen
            DB_Daten_ET.forEach(dbET => { //Hier wird jede einzelne ET nacheinander durchgegangen
                if (dbET[6] == id) { //Überprüfung ob die ID von ET gleich ist wie die mitgegebene
                    $("#IDESAugeET").val(dbET[3]); //Input Feld bekommt Inhalt
                    $("#IDETAugeET").val(dbET[6]); //Input Feld bekommt Inhalt
                    $("#BezeichnungAugeET").val(dbET[0]); //Input Feld bekommt Inhalt
                    $("#TypAugeET").val(dbET[4]); //Input Feld bekommt Inhalt
                    $("#OrtAugeET").val(dbET[5]); //Input Feld bekommt Inhalt
                    $("#LaengengradAugeET").val(dbET[1]); //Input Feld bekommt Inhalt
                    $("#BreitengradAugeET").val(dbET[2]); //Input Feld bekommt Inhalt
                    $("#augeFormET")
                }
            })
        }

        //Funktion zum Erstellen von ET
        function ETerstellen(id) { //Wird die ID des ET mitgegeben
            $('#PopUpETHinzufügen').modal('show'); //Das PopUpETHinzufügen zum Erstellen einer ET öffnen
            DB_Daten_ET.forEach(dbET => { //Hier wird jede einzelne ET nacheinander durchgegangen
                if (dbET[3] == id) { //Überprüfung ob die EnsysID die gleiche ist wie die mitgegebene ID
                    $("#IDES").val(dbET[3]); //Input Feld bekommt Inhalt
                    $("#LaengengradEdit").val(dbET[1]); //Input Feld bekommt Inhalt
                    $("#BreitengradEdit").val(dbET[2]); //Input Feld bekommt Inhalt
                    $("#ETerstellen").attr("action", "/store/" + id)

                }
            })
        }


     
        //Funktion zum Platzieren der ET Marker auf die Map
        function setETMarker(map, id) { //Dafür wird dieser Funktion die map sowie die ID des ET

            for (let i = 0; i < DB_Daten_ET.length; i++) { //mit .length wird die Anzahl der ET ermittelt und anschließend wird diese Schleife so oft gemacht
                const energietechnologie = DB_Daten_ET[i]; //Array mit allen Daten der ET

                let ES_ID = energietechnologie[3]; //Wird die ID des ES vom dieser ET gespeichert
                if (ES_ID != id) { // Überprüfung auf Ungleichheit 
                    continue;
                }

                let options = { //Optionen für den Marker setzen
                    position: { 
                        lat: energietechnologie[1], //Breitengrad-Koordinaten festlegen
                        lng: energietechnologie[2]  //Längengrad-Koordinaten festlegen
                    },
                    map, //Unsere Map auswählen das die Marker auf dieser plaziert werden

                    title: energietechnologie[0], //Hier steht die Bezeichnung der ET wenn man darüber fährt auf der Map (Hover-Effekt) 
                    
                    label: { //Was unter der ET als Text steht
                        text: energietechnologie[0], //Bezeichnung
                        color: 'black', //Farbe
                        fontSize: '15px', //Schriftgröße
                        className: 'marker-position', //Definiert die Position CSS
                    },
                    animation: google.maps.Animation.DROP //Wenn die Marker geladen werden haben sie die Animation das sie von oben herunter fallen
                                                        //verschiedene Moduse: DROP, BOUNCE                        
                }

                switch (energietechnologie[4]) { //Switch mit dem Typ der ET
                    //Je nach Typ wird als Bild das dementsprechende Icon gewählt
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

                    case "Kompressionskältemaschine":
                        options.icon = "/images/icons/Kompressionskältemaschine_icon.png"
                        break;

                    case "Ab oder Adsorbtionskältemaschine":
                        options.icon = "/images/icons/Ab oder Adsorbtionskältemaschine_icon.png"
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
                //
                const markerET = new google.maps.Marker(options); //Neuer ET Marker erstellen mit den Options die oben zuvor festgelegt wurden


                markerET.addListener("click", () => { //Wenn man auf das Icon einer ET drückd, wird an dieses herangezoomt
                    map.setZoom(19); //Zoom-setzen
                    map.setCenter(markerET.getPosition()); //Mitte der Karte mit den Koordinaten des ET Markers setzen
                });
                markersArray.push(markerET);
            }
        }


        //Funktion zum Platzieren der ES Marker auf die Map
        function setESMarker(map) { //Die Map wird mitgegeben

            for (let i = 0; i < DB_Daten_ES.length; i++) { //mit .length wird die Anzahl der ES ermittelt und anschließend wird diese Schleife so oft gemacht
                const energiesysteme = DB_Daten_ES[i]; //Array mit allen Daten der ES

                const markerES = new google.maps.Marker({ //Neuen ES Marker erstellen
                    position: {
                        lat: energiesysteme[1], //Breitengrad-Koordinaten festlegen
                        lng: energiesysteme[2]  //Längengrad-Koordinaten festlegen
                    },
                    map, //Die mitgegebene Map auswählen
                    icon: '/images/icons/esrotneu.png', //Da alle ES das gleiche Icon haben kann diese einfach hier eingebunden werden
                    title: energiesysteme[0], //Bezeichnung des ES (Ist ersichtlich wenn man mit der Maus drüber fährt (Hover-Effekt))
                    label: { //Text der unter dem Icon Steht
                        text: energiesysteme[0], //Bezeichnung
                        color: 'red', //Farbe der Schrift
                        fontWeight: "bold", //Schriftart Fett
                        fontSize: '17px', //Schriftgröße
                        className: 'marker-position', //Damit die Schrift unter dem Icon steht CSS
                    },
                    animation: google.maps.Animation.DROP, //Wenn die Marker geladen werden haben sie die Animation das sie von oben herunter fallen
                                                            //verschiedene Moduse: DROP, BOUNCE
                });

                //Funktion die bei abwählen eines ES die ET wieder von der Map entfernt
                function unsetETMarker(map) {

                    for (var i = 0; i < markersArray.length; i++) { //Wird für jede ET gemacht
                        markersArray[i].setMap(null); //Den Marker von der Map nehmen
                    }
                    markersArray.length = 0; //Danach die länge zurücksetzen
                }


                //Doppelklick um ES auszuwählen, was mit einem Doppelklick auf das ES Icon möglich ist
                markerES.addListener("dblclick", (e) => { //"dbclick" für Doppelklick

                    let latLng = e.latLng.toString(); //In diese Variable werden die Koordinaten des ausgewählten ES gespeichert (ein langer String)
                    breit = parseFloat(latLng.substring(1, latLng.indexOf(","))).toFixed(9); //Aus dem langen String Sub-Strings für den Breitengrad machen
                    lang = parseFloat(latLng.substring(latLng.indexOf(",") + 1, latLng.length)).toFixed(9); //Aus dem langen String Sub-Strings für den Längengrad machen
                    let id; //Zwischen-Variable 
                    DB_Daten_ES.forEach((dbES) => {
                        if (dbES[1].toFixed(9) == breit && dbES[2].toFixed(9) == lang) { //Wenn die Koordinaten übereinstimmen
                            id = dbES[3]; //In die Zwischenvariable wird die ID vom ES gespeichert
                        }
                    });

                    map.setZoom(17); //Wird an das ausgewählte ES gezoomt
                    map.setCenter(markerES.getPosition()); //Die Position des ES wird als Mitte festgelegt
                    markerES.setIcon("/images/icons/esrotneuausgewählt.png"); //Das Icon wird geändert
                    markerES.setAnimation(google.maps.Animation.BOUNCE); //Die Animation des Icons auf BOUNCE ändern, damit man sieht dass es ausgewählt ist
                    print_List_Energietechnologie(id); //Bei Auswahl eines ES wird die Liste rechts auf die dazugehörigen ET geändert

                    activeMarker = true; //Wenn ES ausgewählt dann ist der Boolean activeMarker true
                    activeClick = true;  //Wenn ES ausgewählt dann ist der Boolean activeClick true

                    setETMarker(map, id); //Wenn ES ausgewählt dann werden die dazugehörigen ET ebenso auf die Map plaziert

                    //Bei entsprechender Berechtigung darf man ET hinzufügen
                    @auth //Mann muss angemeldet sein
                        map.setOptions({ draggableCursor: 'url(/images/icons/etgrün.png), move' }); //Der Curser ändert sich auf das Icon grüne ET
                    
                        map.addListener("click", (e1) => { //Ausgefürht wenn Map-Klick um eine ET hinzuzufügen
                            if(activeMarker){ //activeMarker muss true sein,also ein ES muss ausgewählt sein 
                                let latLng = e1.latLng.toString();  //Speichern der Koordinaten des Clickes (ein langer String)
                                langET = parseFloat(latLng.substring(1, latLng.indexOf(","))).toFixed(9); //Substring für Breitengrad der ET
                                breitET = parseFloat(latLng.substring(latLng.indexOf(",")+1, latLng.length)).toFixed(9); //Substring für Längengrad der ET
                                document.getElementById("LaengengradET").setAttribute('value',langET); //Längengrad Koordinaten werden automatisch beim PopUp in das Input Feld geschrieben
                                document.getElementById("BreitengradET").setAttribute('value', breitET); //Breitengrad Koordinaten werden automatisch beim PopUp in das Input Feld geschrieben
                                document.getElementById("IDES").setAttribute('value', id); //ID von ES wird automatisch in das Input Feld geschrieben
                            
                                $('#PopUpETHinzufügen').modal('show'); //PopUpETHinzufügen öffnen
                            }
                        });
                    @endauth
                });

                //Einfacher Klick um ein ES abzuwählen
                markerES.addListener("click", () => { //Klick auf Icon
                    map.setZoom(15); //Herauszoomen
                    map.setCenter(markerES.getPosition()); //Die Position des ES wird als Mitte festgelegt
                    markerES.setIcon("/images/icons/esrotneu.png"); //Icon wieder auf das nicht ausgewählte ES ändern
                    markerES.setAnimation(google.maps.Animation.DROP); //Bounce Animation auf DROP ändern
                    print_List_Energiesysteme(); //Rechts in der Liste wieder die ES anzeigen anstatt den ET
                    map.setOptions({draggableCursor: 'crosshair'}); //Curser von ET wieder auf den normalen ändern
                    $('#PopUpETHinzufügen').modal('hide'); //PopUpETHinzufügen nicht aufrufen!                
                    
                    activeMarker = false; //activeMarker false da das ES abgewählt wird
                    
                        if (activeClick == true) { //Überprüfung ob ES ausgewählt ist wenn ja
                            unsetETMarker(map); //die ET von diesem ES von der Map entfernen
                        }
                });
            }
        }



        //Liste Aktualisieren Funktionen

        //Funktion welche die Liste ET darstellt
        function print_List_Energietechnologie(id) { //ID vom ausgewählten ES
            /*
            Oben im Body sind 3 verschiedene Divs/Tables definiert
            tableDiv = AnfangsTable (Ausgangspunkt) mit den ES welcher anschließend bearbeitet wird um den gewünschten Inhalt bei Auswahl eines ES darstellen zu können
            tableETDiv = Table mit den ET eines ausgewählten ES
            tableESDiv = Table mit ES (gleich wie der Table tableDiv)
            */

            document.getElementById("tableDiv").style.display = "none"; //tableDiv wird ausgeblendet
            document.getElementById("tableETDiv").style.display = "block"; //tableETDiv wird angezeigt
            document.getElementById("tableESDiv").style.display = "none"; //tableESDiv wird ausgeblendet

        
            
            var ETvonES = [];
            let dataForTable = []

            @foreach ($dataEnTech as $d)

            dataForTable = [{{ $d->ensys_id }}, {{ $d->id }}, "{{ $d->Bezeichnung }}", "{{ $d->Typ }}", "{{  $d->Ort}}"];
            
                    @auth
                        @if (Auth::user()->id == $d->user_id || Auth::user()->role == 'Admin')
                    
                        dataForTable.push("<a href=\"/deleteET/{{ $d->id }}\" class=\"btn btn2\" style=\"background-image: url('/images/buttons/delete.png')\"></a>");
                        dataForTable.push("<a href=\"javascript:GrafanafunctionET({{ $d->id }})\" class=\"btn btn2\" style=\"background-image: url('/images/buttons/statistik.png')\"></a>");
                        dataForTable.push("<a href=\"javascript:EditfunctionET({{ $d->id }})\" class=\"btn btn2\" style=\"background-image: url('/images/buttons/stift.png')\"></a>");
                
                        @else
                            dataForTable.push("<a href=\"javascript:GrafanafunctionET({{ $d->id }})\" class=\"btn btn2\" style=\"background-image: url('/images/buttons/statistik.png')\"></a>");
                            dataForTable.push("<a href=\"javascript:AugefunctionET({{ $d->id }})\" class=\"btn btn2\" style=\"background-image: url('/images/buttons/auge.png')\"></a>");
                            dataForTable.push("");
                        @endif
                    @endauth
            
                    @guest
                    dataForTable.push("<a href=\"javascript:GrafanafunctionET({{ $d->id }})\" class=\"btn btn2\" style=\"background-image: url('/images/buttons/statistik.png')\"></a>");
                        dataForTable.push("<a href=\"javascript:AugefunctionET({{ $d->id }})\" class=\"btn btn2\" style=\"background-image: url('/images/buttons/auge.png')\"></a>");
                        dataForTable.push("");
                    @endguest
            
                ETvonES.push(dataForTable);
            @endforeach

            ETvonESFiltered = ETvonES.filter((dt) => {
                return dt[0] == id;
            })

            ETvonESFiltered.every(dt => dt.shift());
            ETvonESFiltered.every(dt => dt.shift());

            tableET.clear().rows.add(ETvonESFiltered).draw();

            document.getElementById("Listuberschrieft").innerHTML = "Energietechnologien"; //Die Überschrift wird auf Energietechnologien geändert 
            document.getElementById("Listimage").src = "/images/icons/etgrün.png"; //Das Image/Icon wird auf das Energietechnologien-Icon geändert
        }


        //Funktion welche die Liste ES wieder darstellt 
        function print_List_Energiesysteme() {

            document.getElementById("tableDiv").style.display = "none"; //tableDiv wird ausgeblendet
            document.getElementById("tableETDiv").style.display = "none"; //tableETDiv wird ausgeblendet
            document.getElementById("tableESDiv").style.display = "block"; //tableESDiv wird angezeigt

            //Es werden alle ES angezeigt somit muss hier nichts ausgeblendet werden

            document.getElementById("Listuberschrieft").innerHTML = "Energiesysteme"; //Die Überschrift wird auf Energiesysteme geändert 
            document.getElementById("Listimage").src = "/images/icons/es.png"; //Das Image/Icon wird auf das Energiesysteme-Icon geändert
        }




        //Funktion um bei einem Klick auf ein ES in der List auch zu diesem auf der Map zu gelangen
        function moveToMarker(id) { //Die ID des ausgewählten ES wird mitgegeben

            let mapOptions = { //Die Map-Options werden dementsprechend angepasst

                center: new google.maps.LatLng('48.14078077082782', '15.14955200012205'), //Ausgangspostion der Map
                zoom: 12, //Zoom Level beim hinspringen zum gewünschten ES
                mapTypeId: "roadmap", //Typ der Map Road Map (weitere: satellite, hybrid, terrain)
                streetViewControl: false, // Street View Männdchen rechts unten ausblenden
                mapId: '23802346582caa31', // MapID von der selbst erstellen Map    
                draggableCursor: 'crosshair', //Curser auf der Map
                scrollwheel: true, //dass Mausscrollen ohne Probleme funktioniert
                fullscreenControl: false, //Vollbild Button entfernen
                zoomControl: false, //rechts unten Zoom Buttons
                scaleControl: true, //Maßstabselement rechts unten anzeigen
                mapTypeControl: true, // Button um zwischen Satellit und Roadmap wechseln
                mapTypeControlOptions: { //Unterfunktionen bei Satellit und Roadmap ausblenden
                    style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                    mapTypeIds: [
                        google.maps.MapTypeId.ROADMAP,
                        google.maps.MapTypeId.SATELLITE
                    ]
                    },
            }

            DB_Daten_ES.forEach(dbES => {
                if (dbES[3] == id) { //Überprüfung auf die Gleichheit der übergebenen ID mit allen ID's und das richtige ES zu bekommen 

                    var searchLatLng = {
                        lat: dbES[1], //Koordinaten des ES speichern 
                        lng: dbES[2] //Koordinaten des ES speichern
                    };

                    //Neue Position auf der Map festlegen
                    mapOptions.center = searchLatLng //Map Zentrum festlegen
                    mapOptions.zoom = 14 //Zoom festlegen
                    var map = new google.maps.Map(document.getElementById('map'), mapOptions); //Übertragen der MapOptions 

              
                    setESMarker(map); //ES Marker neu setzen

                    @auth //Mann muss angemeldet sein um ein ES erstellen zu können
                        map.addListener("click", (e) => { //Ausgefürht wenn Map-Klick -> Um ein ES hinzufügen zu können
                            if(!activeMarker){ //Überprüfung ob e kein ES ausgewählt ist
                                breit = e.latLng.toString().substring(1, 16); //Breitengrad-Koordinaten des Klickes speichern
                                lang = e.latLng.toString().substring(20, 35); //Längengrad-Koordinaten des Klickes speichern
                                document.getElementById("LaengengradES").setAttribute('value',breit); //Koordinaten den Input Feldern hinzufügen(PopUpES)
                                document.getElementById("BreitengradES").setAttribute('value', lang); //Koordinaten den Input Feldern hinzufügen (PopUpES)
                                $('#PopUpESHinzufügen').modal('show'); //PopUpESHinzufügen öffnen
                            }
                        });
                    @endauth
                }
            })
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
