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
                                <input name="newProduct[name]"
                                       type="text"
                                       class="form-control"
                                       ng-model="newProduct.name"
                                       ng-change="updateNewProductUnit()"
                                       ng-required
                                       list="productsNames"
                                       placeholder="Name">
                                <datalist id="productsNames">
                                    <option ng-repeat="productName in productsList" value="{% productName.name %}">
                                </datalist>
                            </div>
                            <div class="col-md-4 col-md-offset-1">
                                <input name="newProduct[unit]" type="text" class="form-control" ng-model="newProduct.unit" ng-required list="productsUnits" placeholder="Einheit">
                                <datalist id="productsUnits">
                                    <option ng-repeat="unit in unitList" value="{% unit %}">
                                </datalist>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-1">
                                <input name="newProduct[singlePrice]" type="number" step="0.01" min="0" class="form-control" ng-model="newProduct.singlePrice" ng-required placeholder="Einzelpreis">
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