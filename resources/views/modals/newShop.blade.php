
<div id="new-shop-modal" class="modal fade" role="dialog" tabindex="-1" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="cursor icon-body" data-target="new-shop" title="neuen Laden erstellen">Laden hinzufügen <i class="glyphicon glyphicon-pencil icon"></i></h3>
            </div>
            <form ng-submit="submitShop()">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <input name="newShop[name]" type="text" class="form-control" ng-model="newShop.name" ng-required placeholder="Name">
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <input name="newShop[city]"
                                       type="text"
                                       class="form-control"
                                       list="cities"
                                       ng-model="newShop.city"
                                       ng-required placeholder="Ort">
                                <datalist id="cities">
                                    <option ng-repeat="city in cityList" value="{% city.name %}">
                                </datalist>
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <select name="newShop[country_id]" id="countries" class="form-control"
                                        ng-options="country as country.name for country in countryList track by country.id"
                                        ng-model="newShop.countrySelected">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {!! Form::submit('Speichern', array('class' => 'btn btn-primary right')) !!}
                    <button type="button" class="btn btn-default right" data-dismiss="modal">Abbrechen</button>
                </div>
            </form>
        </div>
    </div>
</div>