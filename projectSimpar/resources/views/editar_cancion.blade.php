<x-layout>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">{{ trans('messages.edit-song') }}</h2>
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
                                <input id="name" name="name" type="text" placeholder="Introduce Nombre Artista" value="{{ $artist->name }}" class="form-control"/>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                                <input id="email" name="email" type="text" value="{{ $userArtist->email }}" class="form-control">
                                <input id="idRecordCompany" name="idRecordCompany" type="hidden" value="{{Auth::user()->id}}">
                                <input id="emailDomain" name="emailDomain" type="hidden" value="{{Auth::user()->name}}">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                                <input id="photo" name="photo" type="file" value="{{ $artist->photo }}" placeholder="Introduce photo"
                                       class="form-control">
                            </div>
                            <img src="../{{ $artist->photo }}" alt="" style="width: 100px">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                                <input id="information" name="information" value="{{ $artist->information }}" type="text" placeholder="Introduce Information Artista"
                                       class="form-control">
                            </div>
                            <div class="d-grid gap-2">
                                <input type="submit" class="boton btn btn-primary btn-lg" value="Guardar">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
</x-layout>
