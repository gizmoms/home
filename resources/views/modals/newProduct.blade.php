
<div id="new-product-modal" class="modal fade" role="dialog" tabindex="-1" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="cursor icon-body" data-target="new-product" title="Produkt hinzufügen">Produkt hinzufügen <i class="glyphicon glyphicon-pencil icon"></i></h3>
            </div>
            <form ng-submit="submitProduct()">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-1">
                                <select name="newProduct[name]" id="newProduct-name-select" class="form-control"
                                        ng-options="name as name.name for name in productNameList track by name.id"
                                        ng-model="newProduct.name"
                                        ng-required>
                                </select>
                                <input name="newProduct[name]" id="newProduct-name-input" type="text" class="form-control" ng-model="newProduct.name" ng-required placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-1">
                                <input name="newShop[street]" type="text" class="form-control" ng-model="newShop.street" ng-required placeholder="Straße">
                            </div>
                            <div class="col-md-4 col-md-offset-1">
                                <input name="newShop[streetnumber]" type="text" class="form-control" ng-model="newShop.streetnumber" ng-required placeholder="Straßennummer">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-1">
                                <input name="newShop[city]" type="text" class="form-control" ng-model="newShop.city" ng-required placeholder="Ort">
                            </div>
                            <div class="col-md-4 col-md-offset-1">
                                <input name="newShop[zip]" type="text" class="form-control" ng-model="newShop.zip" ng-required placeholder="PLZ">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-1">
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