<x-layout>
    <form action="{{ route('languageChange') }}" method="POST">
        @csrf
        <select name="language" onchange="this.form.submit()">
            <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
            <option value="es" {{ app()->getLocale() == 'es' ? 'selected' : '' }}>Español</option>
        </select>
    </form>
    <div class="row">
        <div class="col-4 p-5">
            <h1>{{$album->name }}</h1>
            @auth
                @if (auth()->user()->role === 'User Artist')
                    @include('new_song')
                @endif
            @endauth
            <img class="album-cover-individual" src="../../{{ $album->cover }}">
            <p>{{ trans('messages.label-publication') }}: {{ $album->publication }}</p>
            <audio id="audio" preload="auto" tabindex="0" controls="">
                <source src="https://s3-us-west-2.amazonaws.com/allmetalmixtapes/Saxon%20-%201984%20-%20Crusader/01%20-%20Crusader%20Prelude.mp3">
            </audio>
        </div>
        <div class="col-8 p-5">
            <ul class="list-group" id="playlist">
            @foreach ($songs as $song)
                        <li class="list-group-item">
                            @auth
                                @if (auth()->user()->role === 'User Artist')
                                    <a class="btn btn-danger" href="{{ route('deleteSong', ['id' => $song->id]) }}"><i
                                            class="fa fa-trash-o"></i></a>
                                @endif
                            @endauth
                            <a href="../../{{$song->file}}">
                                {{ $song->name }}
                            </a>
                        </li>
            @endforeach
            </ul>
        </div>
    </div>
    <script>
        init();

        function init(){
            var audio = document.getElementById('audio');
            var playlist = document.getElementById('playlist');
            var tracks = playlist.getElementsByTagName('a');
            audio.volume = 0.10;
            //audio.play();

            //Agregamos los eventos a los links que nos permitirán cambiar de canción
            for(var track in tracks) {
                var link = tracks[track];
                if(typeof link === "function" || typeof link === "number") continue;
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    var song = this.getAttribute('href');
                    run(song, audio, this);
                });
            }
            //agregamos evento para reproducir la siguiente canción en la lista
            //si la canción es la ultima reproducir la primera otra vez
            audio.addEventListener('ended',function(e) {
                for(var track in tracks) {
                    var link = tracks[track];
                    var nextTrack = parseInt(track) + 1;
                    if(typeof link === "function" || typeof link === "number") continue;
                    if(!this.src) this.src = tracks[0];
                    if(track == (tracks.length - 1)) nextTrack = 0;
                    console.log(nextTrack);
                    if(link.getAttribute('href') === this.src) {
                        var nextLink = tracks[nextTrack];
                        run(nextLink.getAttribute('href'), audio, nextLink);
                        break;
                    }
                }
            });
        }

        function run(song, audio, link){
            var parent = link.parentElement;
            //quitar el active de todos los elementos de la lista
            var items = parent.parentElement.getElementsByTagName('li');
            for(var item in items) {
                if(items[item].classList)
                    items[item].classList.remove("active");
            }

            //agregar active a este elemento
            parent.classList.add("active");

            //tocar la cancion
            audio.src = song;
            audio.load();
            audio.play();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
            crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <script>
        $("#btnModal").click(function (){
            $("#formModal").modal('show');
        });
        $(".close").click(function (){
            $("#formModal").modal('hide');
        });
    </script>
</x-layout>
