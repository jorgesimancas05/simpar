<!doctype html>
<head>
<title>SIMPAR</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/x-icon" href="../img/logo.ico">
    @auth
    @if (auth()->user()->role === 'User Listener')
        <link rel="stylesheet" href="../style.css"/>
    @elseif (auth()->user()->role === 'User Artist')
        <link rel="stylesheet" href="../styleArtist.css"/>
    @elseif (auth()->user()->role === 'Record Company')
        <link rel="stylesheet" href="../styleRecordCompany.css"/>
    @endif
    @endauth
</head>
<body style="font-family: Open Sans, sans-serif">
<nav style="background-color: #e5e7eb; display: flex">
    <img src="../img/logo.png" alt="" style="width: 100px">
    <p>@auth
            {{Auth::user()->role}}:
            [{{Auth::user()->email}}]
        @endauth</p>
</nav>
    {{$slot}}
<footer style="background-color: #e5e7eb; height: 30px;">
    <p>Jorge Simancas Paredes 2º DAW || IES TRASSIERRA</p>
</footer>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
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
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js"></script>
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
