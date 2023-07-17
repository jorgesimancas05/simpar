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
                    <h2 class="modal-title" id="exampleModalLabel">{{ trans('messages.label-edit-album') }}</h2>
                    <button class="close" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('updateAlbum') }}" enctype="multipart/form-data" class="formInmo" autocomplete="off">
                        @csrf
                        <fieldset>
                            <input id="id" name="id" value="{{ $album->id }}" type="text" class="form-control" hidden>

                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                <input id="name" name="name" type="text" required placeholder="{{ trans('messages.placeholder-name-artist') }}" value="{{ $album->name }}" class="form-control"/>
                            </div>
                            <div class="input-group mb-3">
                                <input id="idRecordCompany" name="idRecordCompany" type="hidden" value="{{$album->idRecordCompany}}">
                                <input id="idArtist" name="idArtist" type="hidden" value="{{Auth::user()->id}}">

                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-camera"></i></span>
                                <input id="cover" name="cover" type="file" value="{{ $album->cover }}" placeholder="{{ trans('messages.placeholder-photo-artist') }}"
                                       class="form-control">
                            </div>
                            <img src="../{{ $album->cover }}" alt="" style="width: 100px"><br><br><br>
                            <input id="publication" name="publication" type="hidden" value="{{$album->publication}}">
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
