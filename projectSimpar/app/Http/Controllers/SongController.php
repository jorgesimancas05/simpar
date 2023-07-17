<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use App\Models\User;
use App\Models\Genre;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class SongController extends Controller
{
    /**
     * Función para ver las canciones de un album por genero
     */
    public function verCancionesPorGenero(Request $peticion)
    {
        //Id del album a visualizar la información
        $id = $peticion->route("id");

        //Se obtiene el album a partir del id
        $genre = Genre::find($id);

        //Obtenemos las canciones del album
        $songs = Song::where("idGenre", $genre->id)->get();

        $albums = Album::get();

        //Mostramos la pagina del album con las canciones
        return view("genres")->with("genre", $genre)->with("songs", $songs)->with("albums", $albums);
    }

    /**
     * @param Request $request
     * Función para añador canciones al album
     */
    public function addSong(Request $request)
    {

        //Creamos la cancion
        $song = new Song();

        //Establecemos al album la información recogida del formulario
        $song->name = $request->name;

        $artist = Artist::find($request->idArtist);
        $recordCompany = User::find($artist->idRecordCompany);
        $songFile = $request->songFile;
        $songName = preg_replace('/[\s]+/', '',$request->name) . uniqid() . '.' . $songFile->getClientOriginalExtension();
        $songPath = $songFile->storeAs('images/Record Companies/'.$recordCompany->name.'/artists/'.$artist->name.'/albums/'.$request->nameAlbum, $songName, 'public');

        $song->file = "storage/".$songPath;
        $song->idAlbum = $request->idAlbum;
        $song->idArtist = $request->idArtist;
        $song->idRecordCompany = $request->idRecordCompany;
        $song->idGenre = $request->idGenre;

        //insertamos el album a la base de datos
        $song->save();

        //Se redirige a la pagina del artista para mostrar el nuevo album creado
        return redirect()
            ->route('private_artist');
    }

    /**
     * Funcion para eliminar una canción
     */
    public function deleteSong(Request $request)
    {
        //Variable con el id del artista a eliminar
        $idSong = $request->route("id");

        //Artista que se va a eliminar
        $song = Song::findOrFail($idSong);

        $idAlbum = $song->idAlbum;
        //Eliminamos al artista
        $song->delete();

        //Se redirige a la pagina inicial sin el artista eliminado
        /*return redirect()
            ->route('verAlbum', ['id' => $idAlbum]);*/
        return redirect()
            ->route('private_artist');
    }

}
