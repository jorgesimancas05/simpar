<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Genre;
use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    /**
     * @param Request $request
     * función para registrarse y crear usuarios
     */
    public function register(Request $request)
    {
        $reglas = [
            'email' => 'required|unique:users,email',
            'password' => 'required|min:5',
            'photo' => 'required|file|mimes:png,jpg',
        ];

        // Definir los mensajes de error personalizados
        $mensajes = [
            'email.required' => 'El campo es obligatorio.',
            'email.unique' => 'El campo ya existe en la base de datos.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 5 caracteres.',
            'photo.required' => 'La foto es obligatoria.',
            'photo.file' => 'La foto debe ser una imagen',
            'photo.mimes' => 'La foto debe ser un png o un jpg',
        ];

        // Validar los datos ingresados
        $validador = Validator::make($request->all(), $reglas, $mensajes);

        // Comprobar si la validación falla
        if ($validador->fails()) {
            return redirect()->back()->withErrors($validador)->withInput();
        }

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;

        $image = $request->photo;
        $imageName = $request->name . uniqid() . '.' . $image->getClientOriginalExtension();
        if ($request->role == 'Record Company') {
            $imagePath = $image->storeAs('images/Record Companies/' . $request->name, $imageName, 'public');
        }else{
            $imagePath = $image->storeAs('images/User Listener', $imageName, 'public');
        }

        $user->photo = "storage/".$imagePath;

        $user->save();

        Auth::login($user);

        $role = $user->role;
        switch ($role) {
            case 'User Listener':
                $artists = Artist::get()->chunk(4);
                $albums = Album::get()->chunk(4);
                $genres = Genre::get();
                return view("private")->with("artists", $artists)->with("albums", $albums)->with("genres", $genres);
                break;
            case 'Record Company':
                return redirect()->intended(route('inicio'));
                break;
            default:
                return redirect('login');
                break;
        }
    }

    /**
     * @param Request $request
     * función para iniciar sesion
     */
    public function login(Request $request)
    {
        //Validacion del usuario

        $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $role = $user->role;
                switch ($role) {
                    case 'User Listener':
                        $artists = Artist::get()->chunk(4);
                        $albums = Album::get()->chunk(4);
                        $genres = Genre::get();
                        return view("private")->with("artists", $artists)->with("albums", $albums)->with("genres", $genres);
                        break;
                    case 'Record Company':
                        return redirect()->intended(route('inicio'));
                        break;
                    case 'User Artist':
                        return redirect()->intended(route('private_artist'));
                        break;
                    default:
                        return redirect('login');
                        break;
                }
        }
        return redirect()->back()->withErrors([
            'email' => 'El correo no es valido',
            'password' => 'La contraseña es incorrecta.',
        ]);

    }

    /**
     * @param Request $request
     * Funcion para cerrar sesion
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route("login"));

    }
}
