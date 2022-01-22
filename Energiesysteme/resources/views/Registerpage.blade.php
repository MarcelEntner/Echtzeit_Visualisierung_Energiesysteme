@extends('layouts.layout')
@section('title', 'Galerie')
@section('head')
@endsection
@section('content')

<body oncontextmenu="return false">
    <div class="container">
        <div class="row justify-content-center" style="padding-left:15%;">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
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
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

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
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

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
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class=""
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" id="usererstellen">
                                        {{ __('Register') }} 
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    
    <div style="width:40%; margin-left:30%; border: 2px green solid; margin-top: -50px; margin-bottom: -50px; padding: 5px; border-radius: 10px; ">
    <table class="table table-borderless table-hover" id="tableUsers" style="height:300px; width:100%;">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Id</th>
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
                    <td >{{ $u->id }}</td>
                    <td >{{ $u->name }} </td>
                    <td>{{ $u->email }}</td>
                    <td><?php 
                        if($u->role == '' ){ 
                                echo 'Mitarbeiter';
                        } else{ 
                            echo '<b>'.  $u->role .'</b>';  
                        } 
                        ?> 
                    </td>
                    <td> <a href="/deleteuser/{{ $u->id }}" class="btn btn2" style="background-image: url('/images/buttons/delete.png')"></a> </td>
                </tr>

            @endforeach
        </tbody>
    </table>
    </div>

    <script>
        $('#tableUsers').DataTable({
                    "columnDefs": [{
                            "orderable": false,
                            "targets": 5
                        }, //Um die Sortierfunktion bei den Icon  zu deaktivieren
                        
                        
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