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
        <link rel="stylesheet" href="../style-artists-for-users.css"/>
    </head>
    <body>

    <section>
        <form action="{{ route('languageChange') }}" method="POST">
            @csrf
            <select name="language" onchange="this.form.submit()">
                <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                <option value="es" {{ app()->getLocale() == 'es' ? 'selected' : '' }}>Español</option>
            </select>
        </form>
        <div class="container py-5">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <h1>{{ trans('messages.label-albums') }}</h1>
                        <div class="card-body row">
                            @foreach ($albums as $album)
                                <div class="col-4 col-md-3 col-lg-2 albums">
                                    <a href="{{ route('verAlbum', ['id' => $album->id]) }}">
                                        <img src="{{ $album->cover }}" class="d-block w-100">
                                        <h5 class="name-artist-view-users">{{ $album->name }}</h5>
                                    </a>
                                </div>
                            @endforeach
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
    </html>
</x-layout>
