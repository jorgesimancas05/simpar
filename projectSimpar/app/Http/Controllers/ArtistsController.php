<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Song;
use App\Models\User;
use App\Models\Artist;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ArtistsController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Funcion index para visualizar la vista de Record Company
     *
     * @author Jorge Simancas <jorgesimancas.p@gmail.com>
     */
    public function index()
    {
        // Visualizar los artistas de la commapñia logueada
        $artists = Artist::where("idRecordCompany", Auth::user()->id)->get();

        //Conteo de datos
        $countArtists = Artist::where("idRecordCompany", Auth::user()->id)->count();

        $countAlbums = Album::where("idRecordCompany", Auth::user()->id)->count();

        $countSongs = Song::where("idRecordCompany", Auth::user()->id)->count();

        return view("artists")
            ->with("artists", $artists)->with("countArtists", $countArtists)->with("countAlbums", $countAlbums)->with("countSongs", $countSongs);
    }

    public function privateArtistView()
    {
        //Visualizar los album del artista logueado
        $albums = Album::where("idArtist", Auth::user()->id)->get();

        //Visualizar información del artista
        $artist = Artist::findOrFail(Auth::user()->id);

        //Visualizar las canciones del artista logueado
        $songs = Song::where("idArtist", Auth::user()->id)->get();

        // Conteo de datos
        $countAlbums = Album::where("idArtist", Auth::user()->id)->count();

        $countSongs = Song::where("idArtist", Auth::user()->id)->count();

        return view("private_artist")
            ->with("albums", $albums)->with("songs", $songs)->with("artist", $artist)->with("countAlbums", $countAlbums)->with("countSongs", $countSongs);
    }

    /**
     * Funcion que recibe los parametros de un formulario para añadir un nuevo artista en la base de datos
     *
     * @author Jorge Simancas <jorgesimancas.p@gmail.com>
     */
    public function createNewArtist(Request $request)
    {
        // Condiciones que debe cumplir
        $reglas = [
            'password' => 'required|min:5',
            'photo' => 'required|file|mimes:png,jpg',
        ];

        // Mensajes de error al fallar una condición
        $mensajes = [
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
        // Al crear un artista a la vez se crea tambien un usuario
        $userArtist = new User();

        $userArtist->name = $request->name;
        $userArtist->email = $request->email;
        $userArtist->password = Hash::make($request->password);
        $userArtist->role = 'User Artist';

        $image = $request->photo;
        $imageName = preg_replace('/[\s]+/', '',$request->name) . uniqid() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('images/Record Companies/'.$request->emailDomain.'/artists/'.$request->name, $imageName, 'public');

        $userArtist->photo = "storage/".$imagePath;

        $userArtist->save();

        //Creamos al artista
        $artist = new Artist;

        //Establecemos al artista la información recogida del formulario
        $artist->id = $userArtist->id;
        $artist->name = $request->name;
        $artist->idRecordCompany = $request->idRecordCompany;
        $artist->photo = "storage/".$imagePath;
        $artist->information = $request->information;

        //insertamos el artista a la base de datos
        $artist->save();

        //Se redirige a la pagina inicial para mostrar el nuevo artista creado
        return redirect()
            ->route('inicio');
    }

    /**
     * Funcion para mostrar un formulario con los valores del artista a modificar
     */
    public function editarArtista(Request $request)
    {
        //Variable con el id del artista a modificar
        $id = $request->route("id");

        //Variable con la informacion del artista a modificar
        $artist = Artist::findOrFail($id);

        $userArtist = User::findOrFail($id);

        //Redirigimos al formulario y enviamos la informacion del artista
        return view("editar_artista")
            ->with("artist", $artist)->with("userArtist", $userArtist);
    }

    /**
     * Despues de modificar alguno de los campos del artista deberemos hacer un update a la base de datos
     */
    public function updateArtist(Request $request)
    {
        //Variable con el id del artista a actualizar
        $idArtist = $request->id;

        $userArtist = User::findOrFail($idArtist);

        $userArtist->name = $request->name;
        $userArtist->email = $request->email;
        $userArtist->role = 'User Artist';

        if (!empty($request->photo)) {
            $image = $request->photo;
            $imageName = preg_replace('/[\s]+/', '', $request->name) . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images/Record Companies/' . $request->emailDomain . '/artists/' . $request->name, $imageName, 'public');
            $userArtist->photo = "storage/".$imagePath;
        }

        $userArtist->save();

        //Artista que se va a modificar
        $artist = Artist::findOrFail($idArtist);

        //Establecemos al artista la información recogida del formulario
        $artist->id = $request->id;
        $artist->name = $request->name;
        //la compañia debera ser recogida por un hidden que se indicara por cada compañia que se loge
        $artist->idRecordCompany = $request->idRecordCompany;
        if (!empty($request->photo)) {
            $artist->photo = "storage/" . $imagePath;
        }
        $artist->information = $request->information;

        //insertamos el artista a la base de datos
        $artist->save();

        //Se redirige a la pagina inicial para mostrar el artista actualizado
        return redirect()
            ->route('inicio');
    }

    /**
     * Función para ver el contenido y la información de un artista en concreto
     */
    public function verArtista(Request $request)
    {
        //Id del artista a visualizar la información
        $id = $request->route("id");

        //Se obtiene al artista a partir del id
        $artist = Artist::findOrFail($id);

        //Obtenemos los albums del artista
        $albums = Album::where("idArtist", $artist->id)->get();

        //Obtenemos las canciones del artista
        $songs = Song::where("idArtist", $artist->id)->get();

        //Mostramos la pagina principal del artista donde podremos ver informacion suya y su contenido
        return view("artist")
            ->with("artist", $artist)->with("albums", $albums)->with("songs", $songs);
    }

    /**
     * Función para ver el contenido y la información de todos los Artistas
     */
    public function verTodosArtista(Request $request)
    {

        //Se obtiene a los artistas
        $artists = Artist::get();

        //Mostramos la pagina con todos los artistas
        return view("fullArtist")->with("artists", $artists);
    }

    /**
     * Funcion para eliminar a un artista de la base de datos
     */
    public function eliminarArtista(Request $request)
    {
        //Variable con el id del artista a eliminar
        $idArtist = $request->route("id");

        //Artista que se va a eliminar
        $artist = Artist::findOrFail($idArtist);

        //Eliminamos al artista
        $artist->delete();

        Album::where('idArtist', $idArtist)->delete();

        Song::where('idArtist', $idArtist)->delete();

        //Se redirige a la pagina inicial sin el artista eliminado
        return redirect()
            ->route('inicio');
    }
}
