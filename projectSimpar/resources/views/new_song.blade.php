<button id="btnModal" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalForm">
    {{ trans('messages.btn-add-song') }}
</button>

<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">{{ trans('messages.btn-add-new-song') }}</h2>
                <button class="close" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('addSong') }}" enctype="multipart/form-data" class="formInmo" autocomplete="off">
                    @csrf
                    <fieldset>
                        <input id="idAlbum" name="idAlbum" type="hidden" value="{{$album->id }}">
                        <input id="idRecordCompany" name="idRecordCompany" type="hidden" value="{{$album->idRecordCompany}}">
                        <input id="nameAlbum" name="nameAlbum" type="hidden" value="{{$album->name }}">
                        <input id="idArtist" name="idArtist" type="hidden" value="{{$album->idArtist }}">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-music"></i></span>
                            <input id="name" name="name" type="text" required placeholder="{{ trans('messages.placeholder-name-song') }}"
                                   class="form-control">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="far fa-file-audio"></i></span>
                            <input id="songFile" name="songFile" type="file" placeholder="{{ trans('messages.placeholder-file-song') }}"
                                   class="form-control">
                            @error('songFile')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-icons"></i></span>
                            <select id="idGenre" name="idGenre" class="form-select" aria-label="Default select example">
                                @foreach ($genres as $genre)
                                    <option value="{{$genre->id}}">{{$genre->name}}</option>
                                @endforeach
                            </select>
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
