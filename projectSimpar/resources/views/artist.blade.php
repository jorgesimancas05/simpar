<x-layout>
    <form action="{{ route('languageChange') }}" method="POST">
        @csrf
        <select name="language" onchange="this.form.submit()">
            <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
            <option value="es" {{ app()->getLocale() == 'es' ? 'selected' : '' }}>Español</option>
        </select>
    </form>
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <h3>{{ $artist->name }}</h3>
                            <img src="../../{{$artist->photo}}"
                                 alt="avatar"
                                 class="rounded-circle img-fluid" style="width: 250px;">
                        </div>
                    </div>
                </div>
                <div class="d-none col-lg-8 d-lg-block">
                    <div class="card mb-4 information-artist">
                        <div class="card-body">
                            <h2>{{ trans('messages.label-biography') }}</h2>
                            <p>{{$artist->information}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card mb-4">
                        <h2>{{ trans('messages.label-albums') }}</h2>
                        <div class="card-body row">
                            @foreach ($albums as $album)
                                <div class="col-6 col-md-4 col-lg-6 albums">
                                    <a href="{{ route('verAlbum', ['id' => $album->id]) }}">
                                        <img src="../../{{ $album->cover }}" class="d-block w-100">
                                        <h5>{{ $album->name }}</h5>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h2>{{ trans('messages.label-songs') }}</h2>
                            <audio id="audio" preload="auto" tabindex="0" controls="">
                                <source
                                    src="https://s3-us-west-2.amazonaws.com/allmetalmixtapes/Saxon%20-%201984%20-%20Crusader/01%20-%20Crusader%20Prelude.mp3">
                            </audio>
                            <div class="row">
                                <ul class="list-group" id="playlist">
                                    @foreach ($songs as $song)
                                        <li class="list-group-item">

                                                @foreach ($albums as $album)
                                                    @if($song->idAlbum == $album->id)
                                                    <a href="../../{{$song->file}}">
                                                        <img class="album-cover-individual"
                                                             style="width: 50px; height: 50px"
                                                             src="../../{{ $album->cover }}">
                                                        {{ $song->name }}
                                                    </a>
                                                    @endif
                                                @endforeach
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-block col-lg-8 d-lg-none">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h2>{{ trans('messages.label-information') }}</h2>
                            <p>{{$artist->information}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-layout>
