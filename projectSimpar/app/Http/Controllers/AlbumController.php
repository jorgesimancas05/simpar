<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Genre;
use App\Models\Song;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

use Illuminate\Http\Request;
use App\Models\Album;
use Illuminate\Support\Facades\Validator;

class AlbumController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     *Funcion index para visualizar los albums que estan en la base de datos
     */
    public function index()
    {
        $albums = Album::get();

        return view("albums")
            ->with("albums", $albums);
    }

    /**
     * Funcion que recibe los parametros de un formulario para añadir un nuevo album en la base de datos
     */
    public function agregarAlbum(Request $request)
    {
        // Las condiciones que debe cumplir el formulario
        $reglas = [
            'cover' => 'required|file|mimes:png,jpg',
        ];

        // Mensajes de error
        $mensajes = [
            'cover.required' => 'La portada es obligatoria.',
            'cover.file' => 'La portada debe ser una imagen',
            'cover.mimes' => 'La portada debe ser un png o un jpg',
        ];

        // Validar los datos ingresados
        $validador = Validator::make($request->all(), $reglas, $mensajes);

        // Comprobar si la validación falla volver a la vista anterior con los mensajes de error
        if ($validador->fails()) {
            return redirect()->back()->withErrors($validador)->withInput();
        }
        //Creamos el album
        $album = new Album;

        //Establecemos al album la información recogida del formulario
        $album->name = $request->name;
        $album->idArtist = $request->idArtist;
        $album->idRecordCompany = $request->idRecordCompany;

        // Recogemos al artista del album
        $artist = Artist::findOrFail($request->idArtist);

        // Y su compañia
        $recordCompany = User::findOrFail($artist->idRecordCompany);

        // Parte en la que asignamos y creamos la ruta para el album
        $image = $request->cover;
        $imageName = preg_replace('/[\s]+/', '', $request->name) . uniqid() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('images/Record Companies/' . $recordCompany->name . '/artists/' . $request->nameArtist . '/albums/' . $request->name, $imageName, 'public');

        $album->cover = "storage/" . $imagePath;
        $album->publication = $request->publication;

        // Insertamos el album a la base de datos
        $album->save();

        //Se redirige a la pagina del artista para mostrar el nuevo album creado
        return redirect()
            ->route('private_artist');
    }

    /**
     * Función para ver las canciones de un album
     */
    public function verAlbum(Request $request)
    {
        //Id del album a visualizar la información
        $id = $request->route("id");

        //Se obtiene el album a partir del id
        $album = Album::findOrFail($id);

        //Obtenemos las canciones del album
        $songs = Song::where("idAlbum", $album->id)->get();

        //Obtenemos los generos para poder introducir canciones
        $genres = Genre::get();

        //Mostramos la pagina del album con las canciones
        return view("album")
            ->with("album", $album)->with("songs", $songs)->with("genres", $genres);
    }

    /**
     * Función para ver el contenido y la información de todos los Albumes
     */
    public function verTodosAlbum(Request $request)
    {

        //Se obtiene a los artistas
        $albums = Album::get();

        //Mostramos la pagina para ver todos los albums
        return view("fullAlbum")->with("albums", $albums);
    }

    public function editarAlbum(Request $request)
    {
        //Variable con el id del artista a modificar
        $id = $request->route("id");

        //Variable con la informacion del artista a modificar
        $album = Album::findOrFail($id);

        //Redirigimos al formulario y enviamos la informacion del artista
        return view("editar_album")
            ->with("album", $album);
    }

    public function updateAlbum(Request $request)
    {

        //Creamos el album
        $album = Album::findOrFail($request->id);

        //Establecemos al album la información recogida del formulario
        $album->name = $request->name;
        $album->idArtist = $request->idArtist;
        $album->idRecordCompany = $request->idRecordCompany;

        $recordCompany = User::findOrFail($album->idRecordCompany);
        if (!empty($request->cover)) {
            $image = $request->cover;
            $imageName = preg_replace('/[\s]+/', '', $request->name) . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images/Record Companies/' . $recordCompany->name . '/artists/' . $request->nameArtist . '/albums/' . $request->name, $imageName, 'public');
            $album->cover = "storage/" . $imagePath;
        }
        $album->publication = $request->publication;

        // Insertamos el album a la base de datos
        $album->save();

        //Se redirige a la pagina del artista para mostrar el nuevo album creado
        return redirect()
            ->route('private_artist');
    }

    /**
     * Funcion para eliminar a un artista de la base de datos
     */
    public function eliminarAlbum(Request $request)
    {
        $idAlbum = $request->route("id");

        //Album que se va a eliminar
        $album = Album::findOrFail($idAlbum);

        //Eliminamos al artista
        $album->delete();

        Song::where('idAlbum', $idAlbum)->delete();

        //Se redirige a la pagina inicial sin el album eliminado
        return redirect()
            ->route('private_artist');
    }
}
