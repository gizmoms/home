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
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="name" placeholder="Nutzername">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="password" class="form-control" name="password" placeholder="Passwort">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> An mich erinnern
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
                    {!! Form::submit('Login', array('class' => 'btn btn-primary')) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@append