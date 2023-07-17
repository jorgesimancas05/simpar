<x-layout>
    <form action="{{ route('languageChange') }}" method="POST">
        @csrf
        <select name="language" onchange="this.form.submit()">
            <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
            <option value="es" {{ app()->getLocale() == 'es' ? 'selected' : '' }}>Español</option>
        </select>
    </form>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">{{ trans('messages.label-edit-artist') }}</h2>
                    <button class="close" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('updateArtist') }}" enctype="multipart/form-data" class="formInmo" autocomplete="off">
                        @csrf
                        <fieldset>
                            <input id="id" name="id" value="{{ $artist->id }}" type="text" class="form-control" hidden>

                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                <input id="name" name="name" type="text" required placeholder="{{ trans('messages.placeholder-name-artist') }}" value="{{ $artist->name }}" class="form-control"/>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
                                <input id="email" name="email" type="text" value="{{ $userArtist->email }}" class="form-control">
                                <input id="idRecordCompany" name="idRecordCompany" type="hidden" value="{{Auth::user()->id}}">
                                <input id="emailDomain" name="emailDomain" type="hidden" value="{{Auth::user()->name}}">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-camera"></i></span>
                                <input id="photo" name="photo" type="file" value="{{ $artist->photo }}" placeholder="{{ trans('messages.placeholder-photo-artist') }}"
                                       class="form-control">
                            </div>
                            <img src="../{{ $artist->photo }}" alt="" style="width: 100px"><br><br>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-info-circle"></i></span>
                                <textarea id="information" name="information" required type="text" placeholder="{{ trans('messages.placeholder-information-artist') }}"
                                          class="form-control">{{ $artist->information }}</textarea>
                            </div>
                            <div class="d-grid gap-2">
                                <input type="submit" class="boton btn btn-primary btn-lg" value="{{ trans('messages.btn-save') }}">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    <br><br><br><br>
</x-layout>
