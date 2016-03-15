@section('jquery_files')
    $('#login').on('shown.bs.modal', function () {
        $('input[name="name"]').focus()
    })
@append

@section('modals')
    <div id="login" class="modal fade" role="dialog" tabindex="-1" >
        <div class="modal-dialog modal-login">
            <div class="modal-content">
                {!! Form::open(array('url' => '/authenticate')) !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Nutzername">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Passwort">
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">
                                        <span class="checkbox-material">
                                            <span class="check"></span>
                                        </span>
                                        An mich erinnern
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
                    <button type="submit" class="btn btn-primary" >Einloggen</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@append