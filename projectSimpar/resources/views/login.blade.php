<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../login.css">
    <title>Login Simpar</title>
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
                                    Jorge Simancas Paredes 2ºDAW
                                    <img src="../img/logo.png"
                                         style="width: 185px;" alt="logo">
                                </div>

                                <form method="POST" action="{{route('login-sesion')}}">
                                    @csrf
                                    <b>{{ trans('messages.label-login') }}</b>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example11">{{ trans('messages.label-username') }}</label>
                                        <input type="email" id="emailInput" name="email" value="{{ old('email') }}" class="form-control"
                                               placeholder="{{ trans('messages.placeholder-email') }}" />
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example22">{{ trans('messages.label-password') }}</label>
                                        <input type="password" id="passwordInput" name="password" value="{{ old('password') }}" class="form-control" required
                                               placeholder="password" />
                                        @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="text-center pt-1 mb-5 pb-1">
                                        <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">{{ trans('messages.botton-login') }}</button>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center pb-4">
                                        <p class="mb-0 me-2">{{ trans('messages.question-register') }}</p>
                                        <a href="{{route('register')}}" class="btn btn-outline-danger">{{ trans('messages.botton-create-user') }}</a>
                                    </div>

                                </form>

                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center gradient-custom-2 login-logo">
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
<script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</script>
</html>
