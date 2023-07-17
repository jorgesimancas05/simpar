<x-layout>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                                {{Auth::user()->name}} <img class="icon-animated" src="storage/images/Design/musica.gif">
                            @endauth</h5>
                        {{--                        Añadir este campo a la tabla de usuarios--}}
                        {{--                        <p class="text-muted mb-1">Country: @auth {{Auth::user()->country}} @endauth</p>--}}
                    </div>
                </div>
                <div class="card mb-4 mb-lg-0">
                    <div class="card-body p-0">
                        <h2>{{ trans('messages.label-information') }}</h2>
                        <div class="row">
                            <div class="col-10">
                                <h5>{{ trans('messages.label-count-albums') }}</h5>
                                <h4>{{ $countAlbums }}</h4>
                                <hr>
                            </div>
                            <div class="col-10">
                                <h5>{{ trans('messages.label-count-songs') }}</h5>
                                <h4>{{ $countSongs }}</h4>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        @include('nuevo_album')
                        <h2>{{ trans('messages.label-albums') }}</h2>
                        <div class="row">
                            @foreach ($albums as $album)
                                <div class="col-6 col-md-3 col-sm-4 albums">
                                    <a class="btn btn-success" href="{{ route('editarAlbum', ['id' => $album->id]) }}"><i
                                            class="fa fa-pencil"></i></a>
                                    <a class="btn btn-danger" href="{{ route('eliminarAlbum', ['id' => $album->id]) }}"><i
                                            class="fa fa-trash-o"></i></a>
                                    <a href="{{ route('verAlbum', ['id' => $album->id]) }}">
                                        <img src="{{ $album->cover }}"><br>
                                        <h2>{{ $album->name }}</h2>
                                    </a>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <h2>{{ trans('messages.label-songs') }}</h2>
                        <audio id="audio" preload="auto" tabindex="0" controls="">
                            <source src="https://s3-us-west-2.amazonaws.com/allmetalmixtapes/Saxon%20-%201984%20-%20Crusader/01%20-%20Crusader%20Prelude.mp3">
                        </audio>
                        <ul class="list-group" id="playlist">
                            @foreach ($songs as $song)
                                <li class="list-group-item">

                                        @foreach ($albums as $album)
                                            @if($song->idAlbum == $album->id)
                                            <a href="../../{{$song->file}}">
                                                <img class="album-cover-individual" style="width: 50px; height: 50px" src="../../{{ $album->cover }}">
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
    </div>
</section>
</body>
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
        console.log("entra")
        $("#formModal").modal('show');
    });
    $(".close").click(function (){
        $("#formModal").modal('hide');
    });
</script>
</html>
</x-layout>
