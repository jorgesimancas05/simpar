<x-layout>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
              crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
              integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
              crossorigin="anonymous">
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                                    {{Auth::user()->name}} <img class="icon-animated"
                                                                src="storage/images/Design/disco.gif">
                                @endauth</h5>
                        </div>
                    </div>
                    <div class="card mb-4 mb-lg-0">
                        <div class="card-body p-0">
                            <h2>{{ trans('messages.label-information') }}</h2>
                            <div class="row">
                                <div class="col-10">
                                    <h5>{{ trans('messages.label-count-artists') }}</h5>
                                    <h4>{{$countArtists}}</h4>
                                    <hr>
                                </div>
                                <div class="col-10">
                                    <h5>{{ trans('messages.label-count-albums') }}</h5>
                                    <h4>{{$countAlbums}}</h4>
                                    <hr>
                                </div>
                                <div class="col-10">
                                    <h5>{{ trans('messages.label-count-songs') }}</h5>
                                    <h4>{{$countSongs}}</h4>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            @error('error')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @include('nuevo_artista')
                            <h2>{{ trans('messages.label-artists') }}</h2>
                            <div class="row">
                                @foreach ($artists as $artist)
                                    <div class="col-12 row artists m-2">
                                        <div class="col-3">
                                            <a href="{{ route('verArtista', ['id' => $artist->id]) }}">
                                                <img src="{{ $artist->photo }}"><br>
                                                <h2>{{ $artist->name }}</h2>
                                            </a>
                                        </div>
                                        <div class="col-6 information-artist-record-view" style="background-color: #F1EDEC">
                                            <h5>{{ trans('messages.label-biography') }}</h5>
                                            <p>{{$artist->information}}</p>
                                        </div>
                                        <div class="col-3">
                                            <a class="btn btn-success" href="{{ route('editarArtista', ['id' => $artist->id]) }}"><i
                                                    class="fa fa-pencil"></i></a>
                                            <a class="btn btn-danger" href="{{ route('eliminarArtista', ['id' => $artist->id]) }}"><i
                                                    class="fa fa-trash-o"></i></a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
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
        $("#btnModal").click(function () {
            $("#formModal").modal('show');
        });
        $(".close").click(function () {
            $("#formModal").modal('hide');
        });
    </script>
    </html>
</x-layout>
