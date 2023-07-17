<x-layout>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style-artists-for-users.css"/>
</head>
<body>

<section>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <form method="POST" action="{{route('logout')}}">
                        @csrf
                        <button type="submit" class="btn btn-danger">{{ trans('messages.botton-logout') }}</button>
                    </form>
                    <div class="card-body text-center">
                        <img src="@auth
                                {{Auth::user()->photo}}
                            @endauth"
                             alt="avatar"
                             class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="my-3">@auth
                                {{Auth::user()->name}} <img class="icon-animated" src="storage/images/Design/auriculares.gif">
                            @endauth</h5>
                    </div>
                </div>
                <div class="card mb-4 mb-lg-0">
                    <div class="card-body p-0">
                        <h2>{{ trans('messages.label-genres') }}</h2>
                        <div class="row">
                            @foreach ($genres as $genre)
                                <div class="col-6">
                                    <a href="{{ route('verCancionesPorGenero', ['id' => $genre->id]) }}"
                                       class="col-10 p-2 m-2 btn btn-primary">{{ $genre->name }}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <h2>{{ trans('messages.label-artists') }}</h2>
                        <a href="{{ route('verTodosArtista', ['artists' => $artists]) }}">{{ trans('messages.label-all-artists') }}</a>
                        <div class="row">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    @foreach ($artists as $index => $grupo)
                                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}" class="@if ($loop->first) active @endif"></li>
                                    @endforeach
                                </ol>
                                <div class="carousel-inner">
                                    @foreach ($artists as $grupo)
                                        <div class="carousel-item @if ($loop->first) active @endif">
                                            <div class="row">
                                                @foreach ($grupo as $artist)
                                                    <div class="col-6 col-md-3 col-sm-3 artists">
                                                        <a href="{{ route('verArtista', ['id' => $artist->id]) }}">
                                                            <img src="{{ $artist->photo }}" class="d-block w-100">
                                                            <div class="carousel-caption d-none d-md-block">
                                                                <h5 class="name-artist-view-users">{{ $artist->name }}</h5>
                                                            </div>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Anterior</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Siguiente</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <h2>{{ trans('messages.label-albums') }}</h2>
                        <a href="{{ route('verTodosAlbum', ['albums' => $albums]) }}">{{ trans('messages.label-all-albums') }}</a>
                        <div class="row">
                            <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    @foreach ($albums as $index => $grupo)
                                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}" class="@if ($loop->first) active @endif"></li>
                                    @endforeach
                                </ol>
                                <div class="carousel-inner">
                                    @foreach ($albums as $grupo)
                                        <div class="carousel-item @if ($loop->first) active @endif">
                                            <div class="row">
                                                @foreach ($grupo as $album)
                                                    <div class="col-6 col-md-3 col-sm-3 albums">
                                                        <a href="{{ route('verAlbum', ['id' => $album->id]) }}">
                                                            <img src="{{ $album->cover }}" class="d-block w-100">
                                                                <h5 class="name-artist-view-users">{{ $album->name }}</h5>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Anterior</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Siguiente</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
</x-layout>
