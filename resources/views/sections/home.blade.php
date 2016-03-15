@section('jquery_files')
    $('#g-search').focus();
@stop

<div class="container">
    <div class="row row-fluid">
        <div class="col-sm-10 col-sm-offset-1 content-section">
            @if(Auth::user())
                <div class="searchbar">
                    {!! Form::open(array('url' => 'http://www.google.com/search', 'method' => 'get', 'class' => 'form-horizontal')) !!}
                        <div class="input-group">
                            {!! Form::text('q', '', ['class' => 'frm', 'id' => 'g-search', 'maxlength' => '255', 'placeholder' => 'Google Suche']) !!}
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default grey-bg">
                                    <span class="glyphicon glyphicon-search white" title="abschicken"></span>
                                </button>
                            </span>
                        </div>
                    {!! Form::close() !!}
                </div>
            @else
                <div class="welcome">
                    <h1>Willkommen auf meiner Seite</h1>
                    <h3>Bitte logge dich ein.</h3>
                </div>
            @endif
        </div>
    </div>
</div>
@if(Auth::user())
    <div class="row row-fluid">
        <div class="col-sm-12">
            <div class="bookmarks">
                <div class="bookmarks-section">
                    <div class="category">
                        <h3>Kategorie</h3>
                        <div class="box box-big"></div>
                        <div class="box box-small"></div>
                        <div class="box box-small-wide"></div>
                        <div class="box box-small"></div>
                        <div class="box box-small"></div>
                        <div class="box box-small-wide"></div>
                    </div>
                    <div class="category">
                        <h3>Kategorie</h3>
                        <div class="box box-big"></div>
                        <div class="box box-small"></div>
                        <div class="box box-small-wide"></div>
                        <div class="box box-small"></div>
                        <div class="box box-small"></div>
                        <div class="box box-small-wide"></div>
                    </div>
                </div>
                <div class="bookmarks-section">
                    <div class="category">
                        <h3>Kategorie 2</h3>
                        <div class="box box-big"></div>
                        <div class="box box-small"></div>
                        <div class="box box-small-wide"></div>
                        <div class="box box-small"></div>
                        <div class="box box-small"></div>
                        <div class="box box-small-wide"></div>
                    </div>
                    <div class="category">
                        <h3>Kategorie</h3>
                        <div class="box box-big"></div>
                        <div class="box box-small"></div>
                        <div class="box box-small-wide"></div>
                        <div class="box box-small"></div>
                        <div class="box box-small"></div>
                        <div class="box box-small-wide"></div>
                        <div class="box box-big-wide"></div>
                    </div>
                    <div class="category">
                        <h3>Kategorie</h3>
                        <div class="box box-big"></div>
                        <div class="box box-small"></div>
                        <div class="box box-small-wide"></div>
                        <div class="box box-small"></div>
                        <div class="box box-small"></div>
                        <div class="box box-small-wide"></div>
                    </div>
                </div>
                <div class="bookmarks-section">
                    <div class="category">
                        <h3>Kategorie 3</h3>
                        <div class="box box-big"></div>
                        <div class="box box-small"></div>
                        <div class="box box-small-wide"></div>
                        <div class="box box-small"></div>
                        <div class="box box-small"></div>
                        <div class="box box-small-wide"></div>
                    </div>
                </div>
                <div class="bookmarks-section">
                    <div class="category">
                        <h3>Kategorie 4</h3>
                        <div class="box box-big"></div>
                        <div class="box box-small"></div>
                        <div class="box box-small-wide"></div>
                        <div class="box box-small"></div>
                        <div class="box box-small"></div>
                        <div class="box box-small-wide"></div>
                        <div class="box box-big-wide"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif