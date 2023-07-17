<x-layout>
    <div class="row">
        <div class="col-12 col-xl-4 p-5 cover-genre">
            <img class="album-cover-individual" src="../../{{$genre->photo}}" alt="">
            <audio id="audio" preload="auto" tabindex="0" controls="">
                <source
                    src="https://s3-us-west-2.amazonaws.com/allmetalmixtapes/Saxon%20-%201984%20-%20Crusader/01%20-%20Crusader%20Prelude.mp3">
            </audio>
        </div>
        <div class="col-12 col-xl-8 p-5">
            <ul class="list-group" id="playlist">
                @foreach ($songs as $song)

                    @foreach ($albums as $album)
                        @if($song->idAlbum == $album->id)
                            <li class="list-group-item">
                                <a href="../../{{$song->file}}">
                                    <img class="album-cover-individual" style="width: 50px; height: 50px"
                                         src="../../{{ $album->cover }}">

                                    {{ $song->name }}
                                </a>
                            </li>
                        @endif
                    @endforeach

                @endforeach
            </ul>
        </div>
    </div>
</x-layout>
