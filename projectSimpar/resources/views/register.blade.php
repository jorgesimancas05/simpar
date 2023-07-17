<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <form action="{{ route('languageChange') }}" method="POST">
                            @csrf
                            <select name="language" onchange="this.form.submit()">
                                <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                                <option value="es" {{ app()->getLocale() == 'es' ? 'selected' : '' }}>Español</option>
                            </select>
                        </form>
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <img src="../img/logo.png"
                                             style="width: 185px;" alt="logo">
                                    </div>
                                    <h2>{{ trans('messages.label-register') }}</h2>
                                    <form method="POST" class="form-horizontal" action="{{route('validate-register')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="form-label">{{ trans('messages.label-name') }}</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autocomplete="disable">
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" autocomplete="disable">
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">{{ trans('messages.label-password') }}</label>
                                            <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}"  autocomplete="disable">
                                            @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="photo" class="form-label">{{ trans('messages.label-photo') }}</label>
                                            <input id="photo" name="photo" type="file" placeholder="Introduce photo" class="form-control">
                                            @error('photo')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="role" class="form-label">{{ trans('messages.label-role') }}</label>
                                            <select class="form-select" required  name="role" id="role">
                                                <option value="User Listener">{{ trans('messages.option-listener') }}</option>
                                                <option value="Record Company">{{ trans('messages.option-record') }}</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">{{ trans('messages.btn-save') }}</button>
                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div>
                                    <img src="../img/logo.png" style=" height: 525px" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</html>
