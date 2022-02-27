@extends('layouts.layout')
@section('title', 'Registerpage')
@section('head')
@endsection
@section('content')

<body oncontextmenu="return false">
        <div class="row justify-content-center" style="margin:auto; margin-top:-1%;">
            <div class="col-md-13">
                <div class="card">
                    <div class="card-header">{{ __('Neuen Benutzer anlegen') }}</div>

                    <div class="card-body" style="width:500px;" >
                        <form action="{{ route('createnewuser') }}" method="POST" id="usererstellen"
                        enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                
                                <div class="col-md-6">
                                    <input id="name" type="text" class=""
                                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Adresse') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class=""
                                        name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Passwort') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                         
                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Rolle') }}</label>

                                <div class="col-md-6">
                                
                                <label for="css">Mitarbeiter</label>
                                <input type="radio" id="Mitarbeiter" name="roleueberpruefung" value="Mitarbeiter" checked><br>
                                <label for="html">Admin</label>
                                <input type="radio" id="Admin" name="roleueberpruefung" value="Admin">
                                </div>
                            </div>
                            <br>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success" id="usererstellen"> 
                                        {{ __('Neuen Benutzer erstellen') }} 
                                    </button>

                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <br>
    <br>
    <br>
    
    <div style="width:40%; border: 1px lightgrey solid; margin-left:32%;margin-top:-60px; padding: 5px; border-radius: 10px; ">
    <table class="table table-borderless table-hover" id="tableUsers" style="height:70px; width:100%;">
        <thead>
            <tr>
                <th scope="col" style="width:20px;"></th>
                <th scope="col"></th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $u)
                <tr>
                    <td style="background-image: url('/images/Users/user.png');background-repeat: no-repeat;"></td>
                    <td ></td>
                    <td >{{ $u->name }} </td>
                    <td>{{ $u->email }}</td>
                    <td><?php 
                        if($u->role == 'Mitarbeiter' ){ 
                                echo $u->role;
                        } else{ 
                            echo '<b>'.  $u->role .'</b>';  
                        } 
                        ?> 
                    </td>

                    <?php
                    $users = DB::table('users')->where('role', '=' , 'Admin')->count();                  
                    ?>

                    @if($users > 1)
                        <td> <a href="/deleteuser/{{ $u->id }}" class="btn btn2" style="background-image: url('/images/buttons/delete.png')"></a> </td>
                    @else 
                        <td> </td>
                    @endif
                </tr>

            @endforeach
        </tbody>
    </table>
    </div>

    <script>
        $('#tableUsers').DataTable({
                    "columnDefs": [{
                            "orderable": false,
                            "targets": 0
                        }, //Um die Sortierfunktion bei dem Mülleimer-Icon  zu deaktivieren
                        {
                            "orderable": false,
                            "targets": 1
                        }, //Um die Sortierfunktion bei dem Mülleimer-Icon  zu deaktivieren
                        {
                            "orderable": false,
                            "targets": 5
                        }, //Um die Sortierfunktion bei dem Mülleimer-Icon  zu deaktivieren
                       
                        
                        
                    ],
                    lengthChange: false, //Auswahl wieviele Pro Seite man sehen möchte, False da immer max. 5 angezeigt werden
    
                    lengthMenu: [5], //Wieviele User pro Seite angezeigt werden
                    language: {
                        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json" //Sprache des DataTables z.B. der Buttenbeschriftung
                    }
    
                });
    </script>
    
</body>


@endsection
@section('foooter')