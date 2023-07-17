<button id="btnModal" class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm">
    {{ trans('messages.btn-add-album') }}
</button>

<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">{{ trans('messages.btn-add-new-album') }}</h2>
                <button class="close" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('agregarAlbum') }}" enctype="multipart/form-data" class="formInmo" autocomplete="off">
                    @csrf
                    <fieldset>
                        <input id="idArtist" name="idArtist" type="hidden" value="{{Auth::user()->id}}">
                        <input id="idRecordCompany" name="idRecordCompany" type="hidden" value="{{$artist->idRecordCompany}}">
                        <input id="publication" name="publication" type="hidden" value="{{now()}}">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-compact-disc"></i></span>
                            <input id="name" name="name" type="text" required placeholder="{{ trans('messages.placeholder-name-album') }}"
                                   class="form-control">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-image"></i></span>
                            <input id="cover" name="cover" type="file" placeholder="Introduce Cover"
                                   class="form-control">
                            @error('cover')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
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
