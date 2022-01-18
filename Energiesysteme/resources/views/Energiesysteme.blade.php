@extends('layouts.layout')
@section('title', 'Energiesysteme')
@section('head')
@endsection
@section('content')

    <!-- Google Maps API Informationen -->
    <!-- ca. Zeile 1300 : API Key einbinden -->
    <!-- ca. Zeile 1175 : Eigene designte Map einbinden -->
    <!-- ca. Zeile : Map Key einbinden -->




    <body oncontextmenu="return false">
        <!-- Rechtsklick auf der Web-Seite nicht möglich -->


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
                        <br>


                        <!-- DataTable  Th und Td gleiche Anzahl, ansonsten funktioniert er nicht-->

                        <!-- Gesamte DataTable Div -->
                        <div style="height: 41vh; width:100%;">

                            <!-- DataTable ES Ausgangspunkt-->
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

                                                <td onclick="moveToMarker({{ $d->id }})">{{ $d->id }}</td>
                                                <td onclick="moveToMarker({{ $d->id }})">{{ $d->Bezeichnung }}</td>
                                                <td onclick="moveToMarker({{ $d->id }})">
                                                    {{ $d->Katastralgemeinden }}</td>
                                                <td onclick="moveToMarker({{ $d->id }})">{{ $d->Postleitzahl }}
                                                </td>

                                                @auth
                                                    <?php
                                                    $userID = Auth::user();
                                                    ?>

                                                    <!-- Wenn man nicht angemeldet ist darf man die ES nicht verwalten-->
                                                    <!-- Nur der Ersteller eines ES darf dieses auch bearbeiten || Admin (Rolle Admin) darf alle -->

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
                                                        <!-- Wenn man  angemeldet ist aber nicht das ES erstellt hat oder nicht Admin ist -->

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

                                                <!-- Wenn man nicht angemeldet ist-->

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

                            <!-- DataTable ET -->
                            <div id="tableETDiv" style="display: none;">
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

                                                    <!-- Wenn man nicht angemeldet ist darf man die ES nicht verwalten-->
                                                    <!-- Nur der Ersteller eines ES darf dieses auch bearbeiten || Admin (Rolle Admin) darf alle -->
                                                    @if (Auth::user()->id == $d->user_id || Auth::user()->role == 'Admin')

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
                                                        <!-- Wenn man  angemeldet ist aber nicht das ES erstellt hat oder nicht Admin ist -->
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

                                                <!-- Wenn man nicht angemeldet ist-->
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



                            <!-- DataTable ES nach Aktualisierung des DataTablesES -->
                            <div id="tableESDiv" style="display: none">
                                <table class="table table-borderless table-hover" id="tableES">
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
                                                <td onclick="moveToMarker({{ $d->id }})">{{ $d->id }}</td>
                                                <td onclick="moveToMarker({{ $d->id }})">{{ $d->Bezeichnung }}
                                                </td>
                                                <td onclick="moveToMarker({{ $d->id }})">
                                                    {{ $d->Katastralgemeinden }}</td>
                                                <td onclick="moveToMarker({{ $d->id }})">{{ $d->Postleitzahl }}
                                                </td>

                                                @auth
                                                    <!-- Wenn man nicht angemeldet ist darf man die ES nicht verwalten-->
                                                    <!-- Nur der Ersteller eines ES darf dieses auch bearbeiten || Admin (Rolle Admin) darf alle -->
                                                    @if (Auth::user()->id == $d->user_id || Auth::user()->role == 'Admin')

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
                                                        <!-- Wenn man  angemeldet ist aber nicht das ES erstellt hat oder nicht Admin ist -->

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
                                                <!-- Wenn man nicht angemeldet ist-->

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
                                        aria-label="Bezeichnung" aria-describedby="basic-addon1" placeholder="MicroGridLab">
                                </div>
                                <!--Input Feld Katastralgemeinde -->
                                <div class="input-group mb-3" style="margin-top:5%">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                        <img src="/images/pop-up/katastralgemeinde.png" style="margin-right:10px;">
                                        Katastralgemeinde</span>
                                    <input type="text" class="form-control3" id="KatastralgemeindenES"
                                        name="KatastralgemeindenES" aria-label="Katastralgemeinden"
                                        aria-describedby="basic-addon1" placeholder="Wieselburg">
                                </div>
                                <!--Input Feld Postleitzahl -->
                                <div class="input-group mb-3" style="margin-top:5%">
                                    <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                        <img src="/images/pop-up/postleitzahl.png" style="margin-right:10px;">
                                        Postleitzahl</span>
                                    <input type="text" class="form-control3" id="PostleitzahlES" name="PostleitzahlES"
                                        aria-label="Postleitzahl" aria-describedby="basic-addon1" placeholder="3250">
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
                                <div class="input-group mb-3" style="margin-top:2%">
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
                                        placeholder="Bezeichung" aria-label="BezeichnungET" aria-describedby="basic-addon1">
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
                                        aria-label="OrtET" aria-describedby="basic-addon1">
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
                                        placeholder="..." aria-label="BeschreibungET" aria-describedby="basic-addon1">
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
                                    aria-label="Bezeichnung" aria-describedby="basic-addon1">
                            </div>
                            <!--Input Feld Katastralgemeinde Änderbar -->
                            <div class="input-group mb-3" style="margin-top:5%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/katastralgemeinde.png" style="margin-right:10px;">
                                    Katastralgemeinde</span>
                                <input type="text" class="form-control3" id="KatastralgemeindeESEdit"
                                    name="Katastralgemeinden" value="" aria-label="Katastralgemeinden"
                                    aria-describedby="basic-addon1">
                            </div>
                            <!--Input Feld Postleitzahl Änderbar -->
                            <div class="input-group mb-3" style="margin-top:5%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/postleitzahl.png" style="margin-right:10px;">
                                    Postleitzahl</span>
                                <input type="text" class="form-control3" id="PostleitzahlESEdit" name="Postleitzahl"
                                    value="" aria-label="Postleitzahl" aria-describedby="basic-addon1">
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
                        <h5 class="modal-title modal2-title" id="exampleModalLongTitle">Energietechnologie <img
                                src="/images/icons/etgrün2.png"></h5>
                        </h5>
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
                            <div class="input-group mb-3" style="margin-top:2%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/id.png" style="margin-right:10px;">
                                    ID Energiesystem</span>
                                <input type="text" class="form-control3" id="IdEditES" name="idEditES" value=""
                                    aria-label="ID-ES" aria-describedby="basic-addon1" readonly
                                    style="background-color:#e9ecef;">
                            </div>
                            <!--Input Feld ID Energietechnologie Readonly -->
                            <div class="input-group mb-3" style="margin-top:2%">
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
                                    value="" aria-label="BezeichnungEditET" aria-describedby="basic-addon1">
                            </div>
                            <!--Input Feld Typ Readonly -->
                            <div class="input-group mb-3" style="margin-top:2%; width:445px;">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/typ.png" style="margin-right:10px;">
                                    Typ</span>
                                <input type="text" class="form-control3" id="TypEditET" name="BezeichnungEditET" value=""
                                    aria-label="BezeichnungEditET" aria-describedby="basic-addon1" readonly
                                    style="background-color:#e9ecef;">
                            </div>
                            <!--Input Feld Ort Änderbar -->
                            <div class="input-group mb-3" style="margin-top:2%">
                                <span class="input-group-text" id="basic-addon1" style="margin-left:3%">
                                    <img src="/images/pop-up/ort.png" style="margin-right:10px;">
                                    Ort </span>
                                <input type="text" class="form-control3" id="OrtEditET" name="OrtEditET" value=""
                                    aria-label="OrtEditET" aria-describedby="basic-addon1">
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
                        <!-- Grafana Statistiken-->
                        <!--Grafana Statistik iframe
                                        <iframe src="http://192.168.1.5:3000/d-solo/zlzP3wmgk/raumklimav2?orgId=1&from=1639334652637&to=1639507452638&panelId=2" width="800" height="1000" frameborder="0"></iframe> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- ES Grafana Ende -->



        <!-- ET Grafana -->
        <div class="modal modal2 fade" id="PopUpETGrafana" tabindex="-1" role="dialog"
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
                        <!-- Grafana Statistiken-->
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
            //DataTanble ES Ausgangslage
            $('#table').DataTable({
                "columnDefs": [{
                        "orderable": false,
                        "targets": 4 //Auf 4 kommt man weil man beim zählen bei 0 beginnt ( 0 = ID, 1 = Bezeichnung, 2 = Katastralgemeinde, 3 = Postleitzahl 4 = Mülleimer )
                    }, //Um die Sortierfunktion bei den Icon  zu deaktivieren
                    {
                        "orderable": false,
                        "targets": 5
                    }, //Um die Sortierfunktion bei den Icon Statistiken zu deaktivieren
                    {
                        "orderable": false,
                        "targets": 6
                    } //Um die Sortierfunktion bei den Icon Stift/Auge zu deaktivieren
                ],
                lengthChange: false, //Auswahl wieviele Pro Seite man sehen möchte, False da immer max. 5 angezeigt werden

                lengthMenu: [5], //Wieviele ES/ET pro Seite angezeigt werden 
                language: {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json" //Sprache des DataTables z.B. der Buttenbeschriftung
                }

            });

            //DataTanble ET
            $('#tableET').DataTable({
                "columnDefs": [{
                        "orderable": false,
                        "targets": 5
                    }, //Um die Sortierfunktion bei den Icon Mülleimer zu deaktivieren
                    {
                        "orderable": false,
                        "targets": 6
                    }, //Um die Sortierfunktion bei den Icon Statistiken zu deaktivieren
                    {
                        "orderable": false,
                        "targets": 7
                    } //Um die Sortierfunktion bei den Icon Stift/Auge zu deaktivieren
                ],
                lengthChange: false, //Auswahl wieviele Pro Seite man sehen möchte, False da immer max. 5 angezeigt werden

                lengthMenu: [
                100], //Wieviele ES/ET pro Seite angezeigt werden, kann nicht 5 sein, da hier sonst nach allen ET in der DB sortiert und wir mit CSS nur die richtigen einblenden und dann stimmt die Anzeige nicht
                language: {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json" //Sprache des DataTables z.B. der Buttenbeschriftung
                }
            });

            //DataTanble ES, bei aktualisierung des ES DataTables
            $('#tableES').DataTable({
                "columnDefs": [{
                        "orderable": false,
                        "targets": 4
                    }, //Um die Sortierfunktion bei den Icon Mülleimer zu deaktivieren
                    {
                        "orderable": false,
                        "targets": 5
                    }, //Um die Sortierfunktion bei den Icon Statistiken zu deaktivieren
                    {
                        "orderable": false,
                        "targets": 6
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
        var activeMarker = false;
        var activeClick = false;
        var markersArray = [];

        function initAutocomplete() {
            //Hier werden die Map Optionen definiert
            let mapOptions = {
                center: new google.maps.LatLng('48.14078077082782', '15.14955200012205'), //Ausgangspostion der Map beim Laden (Wieselburg)
                zoom: 12, //Zoom Level beim Laden der Map
                mapTypeId: "roadmap", //Typ der Map Road Map (weitere: satellite, hybrid, terrain)
                streetViewControl: false, // Street View Männdchen rechts unten ausblenden
                mapId: '23802346582caa31', // MapID von der selbst erstellen Map                     Enter Map: 23802346582caa31 Kronstana Map: 396ac7c2d5bcd46
                draggableCursor: 'crosshair', //Curser auf der Map
                scrollwheel: true, //dass Mausscrollen ohne Probleme funktioniert
                fullscreenControl: false, //Vollbild Button entfernen
                scaleControl: true,  //Maßstabselement rechts unten anzeigen
                zoomControl: false, //rechts unten Zoom Buttons
                mapTypeControl: true,  // Button um zwischen Satellit und Roadmap wechseln
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
                            setMarkers(map);
                            @auth //Gast darf keine ES erstellen
                                map.addListener("click", (e) => { //Ausgefürht wenn Map-Klick -> Um ein ES hinzufügen zu können
                                    if(!activeMarker){ //Überprüfung ob e kein ES ausgewählt ist
                                        breit = e.latLng.toString().substring(1, 16); //Breitengrad-Koordinaten des Klickes speichern
                                        lang = e.latLng.toString().substring(20, 35); //Längengrad-Koordinaten des Klickes speichern
                                        document.getElementById("LaengengradES").setAttribute('value',breit); //Koordinaten den Input Feldern hinzufügen (PopUpES)
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

            //Genereller 
            @auth //Gast darf keine ES erstellen
                map.addListener("click", (e) => { //Ausgefürht wenn Map-Klick
                if(!activeMarker){
                breit = e.latLng.toString().substring(1, 16);
                lang = e.latLng.toString().substring(20, 35);
                document.getElementById("LaengengradES").setAttribute('value',breit); //Koordinaten den Input Feldern hinzufügen
                document.getElementById("BreitengradES").setAttribute('value', lang);
            
                $('#PopUpESHinzufügen').modal('show'); //Pop Up ES erstellen Aufruf
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
    
    <!-- key=.....&callback= initAutocomplete Funktion wird aufgerufen-->
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDboUvk9ElphosPEFC-Am9XzHFsmnOZR7I&libraries=places&callback=initAutocomplete">
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
        $sql = 'SELECT id, Bezeichnung, Laengengrad, Breitengrad, Postleitzahl, Katastralgemeinden FROM EnSys'; // ES
        $es_select = DB::table('EnSys')->get(); // ES Select mit Laravel
    
        $sql2 = 'SELECT id, ensys_id, Typ, Bezeichnung, Ort, Breitengrad, Laengengrad  FROM EnTech'; // ET
        $et_select = DB::table('EnTech')->get(); //ET Select mit Laravel
    
        //SQL für die Erzeuger, Verbraucher, Speicher Anzeige beim ES
    
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
    }
    
    ?>



    <script>
        function editfunction(id) {
            $('#PopUpESEditieren').modal('show');

            //Gesamt Variablen
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
            var AktuellerNetzbezug = 0; //öffentliche Stromnetz = Differenz von GesVerbraucherLeistung & GesErzeugerLeistung








            locationsET.forEach(locET => {



                if (locET[3] == id) { //Damit nur ET aus dem ausgewählten ES gezählt werden

                    switch (locET[4]) {
                        case "PV-Anlage":
                            AzErzeuger++;

                            @foreach ($etpv as $pv)
                                if ({{ $pv->EnTech_id }} == locET[6] ) //damit nur die PV von diesem ES nimmt
                                {
                                GesNennleistung += {{ $pv->Leistung }};
                                GesEnergie += {{ $pv->Energie }};
                                GesErzeugerLeistung += {{ $pv->Leistung }};
                                GesErzeugerEnergie += {{ $pv->Energie }};
                                }
                            @endforeach
                            break;

                        case "Stromnetzbezug":
                            AzErzeuger++;

                            @foreach ($etsnb as $s)
                                if ({{ $s->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $s->Leistung }};
                                GesEnergie += {{ $s->Energie }};
                                AktuellerNetzbezug += {{ $s->Leistung }};
                                GesErzeugerLeistung += {{ $s->Leistung }};
                                GesErzeugerEnergie += {{ $s->Energie }};
                                }
                            @endforeach
                            break;

                        case "Batteriespeicher":
                            AzSpeicher++;
                            @foreach ($etbs as $b)
                                if ({{ $b->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $b->Leistung }};
                                GesEnergie += {{ $b->Energie }};
                                GesSpeicherKapazität += {{ $b->Speicherkap }};
                                }
                            @endforeach
                            break;

                        case "Wasserstoff Elektrolyse":
                            AzVerbraucher++;

                            @foreach ($etwe as $w)
                                if ({{ $w->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $w->Leistung }};
                                GesEnergie += {{ $w->Energie }};
                                GesVerbraucherLeistung += {{ $w->Leistung }};
                                GesVerbraucherEnergie += {{ $w->Energie }};
                                }
                            @endforeach
                            break;

                        case "Wasserstoff Brennstoffzelle":
                            AzErzeuger++;
                            @foreach ($etbsz as $b)
                                if ({{ $b->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $b->Leistung }};
                                GesEnergie += {{ $b->Energie }};
                                GesErzeugerLeistung += {{ $b->Leistung }};
                                GesErzeugerEnergie += {{ $b->Energie }};
                                }
                            @endforeach
                            break;

                        case "Wasserstoff Speicher":
                            AzSpeicher++;

                            @foreach ($etws as $w)
                                if ({{ $w->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $w->Leistung }};
                                GesEnergie += {{ $w->Energie }};
                                GesSpeicherKapazität += {{ $w->Speicherkap }};
                                }
                            @endforeach
                            break;

                        case "Windkraftanlage":
                            AzErzeuger++;

                            @foreach ($etwka as $w)
                                if ({{ $w->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $w->Leistung }};
                                GesEnergie += {{ $w->Energie }};
                                GesErzeugerLeistung += {{ $w->Leistung }};
                                GesErzeugerEnergie += {{ $w->Energie }};
                                }
                            @endforeach
                            break;

                        case "E-Ladestation":
                            AzVerbraucher++;

                            @foreach ($etel as $e)
                                if ({{ $e->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $e->Leistung }};
                                GesEnergie += {{ $e->Energie }};
                                GesVerbraucherLeistung += {{ $e->Leistung }};
                                GesVerbraucherEnergie += {{ $e->Energie }};
                                }
                            @endforeach
                            break;

                        case "Hausanschlusszähler":
                            AzVerbraucher++;

                            @foreach ($ethaz as $h)
                                if ({{ $h->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $h->Leistung }};
                                GesEnergie += {{ $h->Energie }};
                                GesVerbraucherLeistung += {{ $h->Leistung }};
                                GesVerbraucherEnergie += {{ $h->Energie }};
                            
                                }
                            @endforeach
                            break;

                        case "Wärmenetzbezug":
                            AzErzeuger++;

                            @foreach ($etwnb as $w)
                                if ({{ $w->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $w->Leistung }};
                                GesEnergie += {{ $w->Energie }};
                                GesErzeugerLeistung += {{ $w->Leistung }};
                                GesErzeugerEnergie += {{ $w->Energie }};
                                }
                            @endforeach
                            break;

                        case "Biomasseheizkraftwerk":
                            AzVerbraucher++;
                            AzErzeuger++;

                            @foreach ($etbhkw as $b)
                                if ({{ $b->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $b->Leistung }};
                                GesEnergie += {{ $b->Energie }};
                                GesVerbraucherLeistung += {{ $b->Leistung }};
                                GesVerbraucherEnergie += {{ $b->Energie }};
                                GesErzeugerLeistung += {{ $b->Leistung }};
                                GesErzeugerEnergie += {{ $b->Energie }};
                            
                                }
                            @endforeach

                            break;

                        case "Biomasseheizwerk":
                            AzVerbraucher++;
                            AzErzeuger++;
                            @foreach ($etbmhw as $b)
                                if ({{ $b->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $b->Leistung }};
                                GesEnergie += {{ $b->Energie }};
                                GesVerbraucherLeistung += {{ $b->Leistung }};
                                GesVerbraucherEnergie += {{ $b->Energie }};
                                GesErzeugerLeistung += {{ $b->Leistung }};
                                GesErzeugerEnergie += {{ $b->Energie }};
                            
                                }
                            @endforeach
                            break;

                        case "Biomasseheizkessel":
                            AzVerbraucher++;
                            AzErzeuger++;
                            @foreach ($etbmhk as $b)
                                if ({{ $b->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $b->Leistung }};
                                GesEnergie += {{ $b->Energie }};
                                GesVerbraucherLeistung += {{ $b->Leistung }};
                                GesVerbraucherEnergie += {{ $b->Energie }};
                                GesErzeugerLeistung += {{ $b->Leistung }};
                                GesErzeugerEnergie += {{ $b->Energie }};
                            
                                }
                            @endforeach
                            break;

                        case "Wärmespeicher":
                            AzSpeicher++;

                            @foreach ($etwes as $w)
                                if ({{ $w->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $w->Leistung }};
                                GesEnergie += {{ $w->Energie }};
                                //keine Speicherkap sondern TempUnten TempMitte TempOben
                            
                                }
                            @endforeach
                            break;

                        case "Solarthermieanlage":
                            AzErzeuger++;

                            @foreach ($etsth as $s)
                                if ({{ $s->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $s->Leistung }};
                                GesEnergie += {{ $s->Energie }};
                                GesErzeugerLeistung += {{ $s->Leistung }};
                                GesErzeugerEnergie += {{ $s->Energie }};
                            
                                }
                            @endforeach
                            break;

                        case "Wärmepumpe":
                            AzErzeuger++;

                            @foreach ($etwp as $w)
                                if ({{ $w->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $w->Leistung }};
                                GesEnergie += {{ $w->Energie }};
                                GesErzeugerLeistung += {{ $w->Leistung }};
                                GesErzeugerEnergie += {{ $w->Energie }};
                            
                                }
                            @endforeach
                            break;

                        case "Gebäude Wärmebedarfszähler":
                            AzVerbraucher++;
                            //etgwbz hat keine Leistung nur Zählerstand

                            break;

                        case "Kompressionskältemaschine":
                            AzVerbraucher++;
                            AzErzeuger++;

                            @foreach ($etkkm as $k)
                                if ({{ $k->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $k->Leistung }};
                                GesEnergie += {{ $k->Energie }};
                                GesVerbraucherLeistung += {{ $k->Leistung }};
                                GesVerbraucherEnergie += {{ $k->Energie }};
                                GesErzeugerLeistung += {{ $k->Leistung }};
                                GesErzeugerEnergie += {{ $k->Energie }};
                            
                            
                                }
                            @endforeach
                            break;

                        case "Ab oder Adsorbtionskältemaschine":
                            AzVerbraucher++;
                            AzErzeuger++;

                            @foreach ($etadabkm as $e)
                                if ({{ $e->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $e->Leistung }};
                                GesEnergie += {{ $e->Energie }};
                                GesVerbraucherLeistung += {{ $e->Leistung }};
                                GesVerbraucherEnergie += {{ $e->Energie }};
                                GesErzeugerLeistung += {{ $e->Leistung }};
                                GesErzeugerEnergie += {{ $e->Energie }};
                            
                            
                                }
                            @endforeach
                            break;

                        case "Kältespeicher":
                            AzSpeicher++;

                            @foreach ($etks as $k)
                                if ({{ $k->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $k->Leistung }};
                                GesEnergie += {{ $k->Energie }};
                                GesSpeicherKapazität += {{ $k->Speicherkap }};
                            
                                }
                            @endforeach
                            break;

                        case "Gebäude Kältebedarfszähler":
                            AzVerbraucher++;
                            //etgkbz hat keine Leistung nur Zählerstand

                            break;


                    }


                }


            }) //foreach aus


            AktuellerNetzbezug = GesVerbraucherLeistung - GesErzeugerLeistung;
            if (AktuellerNetzbezug < 0) {
                AktuellerNetzbezug = 0;
            }


            locations.forEach(loc => {
                if (loc[3] == id) {
                    $("#BezeichnungESEdit").val(loc[0]);
                    $("#KatastralgemeindeESEdit").val(loc[5]);
                    $("#PostleitzahlESEdit").val(loc[4]);
                    $("#LaengengradESEdit").val(loc[1]);
                    $("#BreitengradESEdit").val(loc[2]);
                    $("#Az-Erzeugungstechnologien").val(AzErzeuger);
                    $("#Az-Verbraucher").val(AzVerbraucher);
                    $("#Az-Speicher").val(AzSpeicher);
                    $("#Ges-Nennleistung").val(GesNennleistung);
                    $("#Ges-Energie").val(GesEnergie);
                    $("#Ges-VerbraucherLeistung").val(GesVerbraucherLeistung);
                    $("#Ges-VerbraucherEnergie").val(GesVerbraucherEnergie);
                    $("#Ges-ErzeugerLeistung").val(GesErzeugerLeistung);
                    $("#Ges-ErzeugerEnergie").val(GesErzeugerEnergie);
                    $("#Ges-SpeicherKapazität").val(GesSpeicherKapazität);
                    $("#AktuellerNetzbezug").val(AktuellerNetzbezug);
                    $("#editForm").attr("action", "/edit/" + id)
                }
            })

        }


        function GrafanafunctionES() {
            $('#PopUpESGrafana').modal('show');

        }


        function augefunction(id) {
            $('#PopUpESAuge').modal('show');


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
            var AktuellerNetzbezug = 0; //öffentliche Stromnetz = Differenz von GesVerbraucherLeistung & GesErzeugerLeistung



            locationsET.forEach(locET => {



                if (locET[3] == id) { //Damit nur ET aus dem ausgewählten ES gezählt werden

                    switch (locET[4]) {
                        case "PV-Anlage":
                            AzErzeuger++;

                            @foreach ($etpv as $pv)
                                if ({{ $pv->EnTech_id }} == locET[6] ) //damit nur die PV von diesem ES nimmt
                                {
                                GesNennleistung += {{ $pv->Leistung }};
                                GesEnergie += {{ $pv->Energie }};
                                GesErzeugerLeistung += {{ $pv->Leistung }};
                                GesErzeugerEnergie += {{ $pv->Energie }};
                                }
                            @endforeach
                            break;

                        case "Stromnetzbezug":
                            AzErzeuger++;

                            @foreach ($etsnb as $s)
                                if ({{ $s->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $s->Leistung }};
                                GesEnergie += {{ $s->Energie }};
                                AktuellerNetzbezug += {{ $s->Leistung }};
                                GesErzeugerLeistung += {{ $s->Leistung }};
                                GesErzeugerEnergie += {{ $s->Energie }};
                            
                                }
                            @endforeach
                            break;

                        case "Batteriespeicher":
                            AzSpeicher++;
                            @foreach ($etbs as $b)
                                if ({{ $b->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $b->Leistung }};
                                GesEnergie += {{ $b->Energie }};
                                GesSpeicherKapazität += {{ $b->Speicherkap }};
                                }
                            @endforeach
                            break;

                        case "Wasserstoff Elektrolyse":
                            AzVerbraucher++;

                            @foreach ($etwe as $w)
                                if ({{ $w->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $w->Leistung }};
                                GesEnergie += {{ $w->Energie }};
                                GesVerbraucherLeistung += {{ $w->Leistung }};
                                GesVerbraucherEnergie += {{ $w->Energie }};
                                }
                            @endforeach
                            break;

                        case "Wasserstoff Brennstoffzelle":
                            AzErzeuger++;
                            @foreach ($etbsz as $b)
                                if ({{ $b->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $b->Leistung }};
                                GesEnergie += {{ $b->Energie }};
                                GesErzeugerLeistung += {{ $b->Leistung }};
                                GesErzeugerEnergie += {{ $b->Energie }};
                            
                                }
                            @endforeach
                            break;

                        case "Wasserstoff Speicher":
                            AzSpeicher++;

                            @foreach ($etws as $w)
                                if ({{ $w->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $w->Leistung }};
                                GesEnergie += {{ $w->Energie }};
                                GesSpeicherKapazität += {{ $w->Speicherkap }};
                                }
                            @endforeach
                            break;

                        case "Windkraftanlage":
                            AzErzeuger++;

                            @foreach ($etwka as $w)
                                if ({{ $w->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $w->Leistung }};
                                GesEnergie += {{ $w->Energie }};
                                GesErzeugerLeistung += {{ $w->Leistung }};
                                GesErzeugerEnergie += {{ $w->Energie }};
                            
                                }
                            @endforeach
                            break;

                        case "E-Ladestation":
                            AzVerbraucher++;

                            @foreach ($etel as $e)
                                if ({{ $e->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $e->Leistung }};
                                GesEnergie += {{ $e->Energie }};
                                GesVerbraucherLeistung += {{ $e->Leistung }};
                                GesVerbraucherEnergie += {{ $e->Energie }};
                                }
                            @endforeach
                            break;

                        case "Hausanschlusszähler":
                            AzVerbraucher++;

                            @foreach ($ethaz as $h)
                                if ({{ $h->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $h->Leistung }};
                                GesEnergie += {{ $h->Energie }};
                                GesVerbraucherLeistung += {{ $h->Leistung }};
                                GesVerbraucherEnergie += {{ $h->Energie }};
                            
                                }
                            @endforeach
                            break;

                        case "Wärmenetzbezug":
                            AzErzeuger++;

                            @foreach ($etwnb as $w)
                                if ({{ $w->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $w->Leistung }};
                                GesEnergie += {{ $w->Energie }};
                                GesErzeugerLeistung += {{ $w->Leistung }};
                                GesErzeugerEnergie += {{ $w->Energie }};
                                }
                            @endforeach
                            break;

                        case "Biomasseheizkraftwerk":
                            AzVerbraucher++;
                            AzErzeuger++;

                            @foreach ($etbhkw as $b)
                                if ({{ $b->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $b->Leistung }};
                                GesEnergie += {{ $b->Energie }};
                                GesVerbraucherLeistung += {{ $b->Leistung }};
                                GesVerbraucherEnergie += {{ $b->Energie }};
                                GesErzeugerLeistung += {{ $b->Leistung }};
                                GesErzeugerEnergie += {{ $b->Energie }};
                                }
                            @endforeach

                            break;

                        case "Biomasseheizwerk":
                            AzVerbraucher++;
                            AzErzeuger++;
                            @foreach ($etbmhw as $b)
                                if ({{ $b->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $b->Leistung }};
                                GesEnergie += {{ $b->Energie }};
                                GesVerbraucherLeistung += {{ $b->Leistung }};
                                GesVerbraucherEnergie += {{ $b->Energie }};
                                GesErzeugerLeistung += {{ $b->Leistung }};
                                GesErzeugerEnergie += {{ $b->Energie }};
                                }
                            @endforeach
                            break;

                        case "Biomasseheizkessel":
                            AzVerbraucher++;
                            AzErzeuger++;
                            @foreach ($etbmhk as $b)
                                if ({{ $b->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $b->Leistung }};
                                GesEnergie += {{ $b->Energie }};
                                GesVerbraucherLeistung += {{ $b->Leistung }};
                                GesVerbraucherEnergie += {{ $b->Energie }};
                                GesErzeugerLeistung += {{ $b->Leistung }};
                                GesErzeugerEnergie += {{ $b->Energie }};
                            
                                }
                            @endforeach
                            break;

                        case "Wärmespeicher":
                            AzSpeicher++;

                            @foreach ($etwes as $w)
                                if ({{ $w->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $w->Leistung }};
                                GesEnergie += {{ $w->Energie }};
                                //keine Speicherkap sondern TempUnten TempMitte TempOben
                            
                                }
                            @endforeach
                            break;

                        case "Solarthermieanlage":
                            AzErzeuger++;

                            @foreach ($etsth as $s)
                                if ({{ $s->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $s->Leistung }};
                                GesEnergie += {{ $s->Energie }};
                                GesErzeugerLeistung += {{ $s->Leistung }};
                                GesErzeugerEnergie += {{ $s->Energie }};
                            
                            
                                }
                            @endforeach
                            break;

                        case "Wärmepumpe":
                            AzErzeuger++;

                            @foreach ($etwp as $w)
                                if ({{ $w->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $w->Leistung }};
                                GesEnergie += {{ $w->Energie }};
                                GesErzeugerLeistung += {{ $w->Leistung }};
                                GesErzeugerEnergie += {{ $w->Energie }};
                            
                            
                                }
                            @endforeach
                            break;

                        case "Gebäude Wärmebedarfszähler":
                            AzVerbraucher++;
                            //etgwbz hat keine Leistung nur Zählerstand

                            break;

                        case "Kompressionskältemaschine":
                            AzVerbraucher++;
                            AzErzeuger++;

                            @foreach ($etkkm as $k)
                                if ({{ $k->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $k->Leistung }};
                                GesEnergie += {{ $k->Energie }};
                                GesVerbraucherLeistung += {{ $k->Leistung }};
                                GesVerbraucherEnergie += {{ $k->Energie }};
                                GesErzeugerLeistung += {{ $k->Leistung }};
                                GesErzeugerEnergie += {{ $k->Energie }};
                                }
                            @endforeach
                            break;

                        case "Ab oder Adsorbtionskältemaschine":
                            AzVerbraucher++;
                            AzErzeuger++;

                            @foreach ($etadabkm as $e)
                                if ({{ $e->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $e->Leistung }};
                                GesEnergie += {{ $e->Energie }};
                                GesVerbraucherLeistung += {{ $e->Leistung }};
                                GesVerbraucherEnergie += {{ $e->Energie }};
                                GesErzeugerLeistung += {{ $e->Leistung }};
                                GesErzeugerEnergie += {{ $e->Energie }};
                                }
                            @endforeach
                            break;

                        case "Kältespeicher":
                            AzSpeicher++;

                            @foreach ($etks as $k)
                                if ({{ $k->EnTech_id }} == locET[6] )
                                {
                                GesNennleistung += {{ $k->Leistung }};
                                GesEnergie += {{ $k->Energie }};
                                GesSpeicherKapazität += {{ $k->Speicherkap }};
                            
                                }
                            @endforeach
                            break;

                        case "Gebäude Kältebedarfszähler":
                            AzVerbraucher++;
                            //etgkbz hat keine Leistung nur Zählerstand

                            break;


                    }


                }


            }) //foreach aus


            AktuellerNetzbezug = GesVerbraucherLeistung - GesErzeugerLeistung;
            if (AktuellerNetzbezug < 0) {
                AktuellerNetzbezug = 0;
            }



            locations.forEach(loc => {
                if (loc[3] == id) {
                    $("#BezeichnungAuge").val(loc[0]);
                    $("#KatastralgemeindeAuge").val(loc[5]);
                    $("#PostleitzahlAuge").val(loc[4]);
                    $("#LaengengradAuge").val(loc[1]);
                    $("#BreitengradAuge").val(loc[2]);
                    $("#Az-ErzeugungstechnologienAuge").val(AzErzeuger);
                    $("#Az-VerbraucherAuge").val(AzVerbraucher);
                    $("#Az-SpeicherAuge").val(AzSpeicher);
                    $("#Ges-NennleistungAuge").val(GesNennleistung);
                    $("#Ges-EnergieAuge").val(GesEnergie);
                    $("#Ges-VerbraucherLeistungAuge").val(GesVerbraucherLeistung);
                    $("#Ges-VerbraucherEnergieAuge").val(GesVerbraucherEnergie);
                    $("#Ges-ErzeugerLeistungAuge").val(GesErzeugerLeistung);
                    $("#Ges-ErzeugerEnergieAuge").val(GesErzeugerEnergie);
                    $("#Ges-SpeicherKapazitätAuge").val(GesSpeicherKapazität);
                    $("#AktuellerNetzbezugAuge").val(AktuellerNetzbezug);
                    $("#augeForm")
                }
            })

        }


        function augefunctionET(id) {
            $('#PopUpETAuge').modal('show');
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
            $('#PopUpETHinzufügen').modal('show');
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
            $('#PopUpETEditieren').modal('show');
            locationsET.forEach(locEt => {
                if (locEt[6] == id) {
                    $("#IdEditES").val(locEt[3]);
                    $("#IdEditET").val(locEt[6]);
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
            $('#PopUpETGrafana').modal('show');

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
                    
                        $('#PopUpETHinzufügen').modal('show'); //Pop Up ET erstellen Aufruf
                    
                    
                    
                    
                    
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
                    $('#PopUpETHinzufügen').modal('hide'); //Pop Up ET erstellen Aufruf                  
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



        function moveToMarker(id) {

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

            locations.forEach(loc => {
                if (loc[3] == id) {

                    var searchLatLng = {
                        lat: loc[1],
                        lng: loc[2]
                    };

                    // NEW POSITION
                    mapOptions.center = searchLatLng
                    mapOptions.zoom = 12
                    var map = new google.maps.Map(document.getElementById('map'), mapOptions);

                    setMarkers(map);
                    @auth //Gast darf keine ES erstellen
                        map.addListener("click", (e) => { //Ausgefürht wenn Map-Klick
                        if(!activeMarker){
                        breit = e.latLng.toString().substring(1, 16);
                        lang = e.latLng.toString().substring(20, 35);
                        document.getElementById("LaengengradES").setAttribute('value',breit); //Koordinaten den Input Feldern hinzufügen
                        document.getElementById("BreitengradES").setAttribute('value', lang);
                        $('#PopUpESHinzufügen').modal('show'); //Pop Up ES erstellen Aufruf
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
