<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\User;

use Illuminate\Support\Facades\Hash;


class CreateUser extends Controller
{

    public function createUser(Request $request){


        $User= User::where('email', $request['email'])->get();
      
        // dd($User);
        
        if (count($User) == 0){
            User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'role' => $request['roleueberpruefung'],
            ]);
            return redirect('/Registerpage');
        } else {
          
            return redirect('/Registerpage');
        }
      
            
        

        

    }


    public function destroy($id){
        
        $user = User::find($id);


        if ($user == null) {
            dd("Konnte nicht gelöscht werden");
        } else {
            $user->delete();
            return redirect('/Registerpage');
        }
    }



    }
    

