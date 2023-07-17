    <button id="btnModal" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalForm">
        {{ trans('messages.btn-add-artist') }}
    </button>

    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">{{ trans('messages.btn-add-new-artist') }}</h2>
                    <button class="close" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('createNewArtist') }}" enctype="multipart/form-data" class="formInmo" autocomplete="off">
                        @csrf
                        <fieldset>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                <input id="name" name="name" type="text" required placeholder="{{ trans('messages.placeholder-name-artist') }}" class="form-control"/>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
                                <input id="email" name="email" type="text" class="form-control" readonly>
                                <input id="idRecordCompany" name="idRecordCompany" type="hidden" value="{{Auth::user()->id}}">
                                <input id="emailDomain" name="emailDomain" type="hidden" value="{{Auth::user()->name}}">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                                <input id="password" name="password" type="text" value="{{ old('password') }}" placeholder="{{ trans('messages.placeholder-password-artist') }}"
                                       class="form-control">
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-camera"></i></span>
                                <input id="photo" name="photo" type="file" placeholder="{{ trans('messages.placeholder-photo-artist') }}"
                                       class="form-control">
                                @error('photo')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-info-circle"></i></span>
                                <textarea id="information" name="information" type="text" required placeholder="{{ trans('messages.placeholder-information-artist') }}"
                                          class="form-control"></textarea>
                            </div>
                            <div class="d-grid gap-2">
                                <input type="submit" class="boton btn btn-primary btn-lg" value="{{ trans('messages.btn-save') }}">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        var input1 = document.getElementById('name');
        var input2 = document.getElementById('email');
        var input3 = document.getElementById('emailDomain');

        input1.addEventListener('keyup', function() {
            // Obtener el valor del primer input
            var valor_input1 = input1.value;
            var valor_input3 = replaceAccentSpecialLetters(input3.value.replace(/[^a-zA-Zá-úÁ-Ú0-9]/g, ''));
            // Procesar la información si es necesario
            var valor_input2 = valor_input1.replace(/[^a-zA-Zá-úÁ-Ú0-9]/g, '').toLowerCase()+"@"+valor_input3.toLowerCase()+".com"; // Ejemplo: convertir a mayúsculas

            // Asignar el valor al segundo input
            input2.value = replaceAccentSpecialLetters(valor_input2);
        });

        function replaceAccentSpecialLetters(text) {
            const vocalesConTilde = 'áéíóúñçÁÉÍÓÚÑÇ';
            const vocalesSinTilde = 'aeiouncAEIOUNC';
            let nuevoTexto = '';

            for (let i = 0; i < text.length; i++) {
                const indice = vocalesConTilde.indexOf(text.charAt(i));
                if (indice != -1) {
                    nuevoTexto += vocalesSinTilde.charAt(indice);
                } else {
                    nuevoTexto += text.charAt(i);
                }
            }

            return nuevoTexto;
        }

    </script>
