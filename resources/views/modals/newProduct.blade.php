@section('jquery_files')
    $(".categories").select2();
@append

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
                                       ng-change="checkNewStockProduct()"
                                       ng-required="true"
                                       list="productsNames"
                                       placeholder="Name"
                                       autocomplete="off">
                                <datalist id="productsNames">
                                    <option ng-repeat="productName in productsList" value="{% productName.name %}">
                                </datalist>
                            </div>
                            <div class="col-md-4 col-md-offset-1">
                                <input name="newProduct[unit]"
                                       type="text"
                                       class="form-control"
                                       ng-model="newProduct.unit"
                                       ng-change="checkNewUnit()"
                                       ng-required="true"
                                       list="productsUnits"
                                       placeholder="Einheit"
                                       autocomplete="off">
                                <datalist id="productsUnits">
                                    <option ng-repeat="unit in unitList" value="{% unit %}">
                                </datalist>
                            </div>
                        </div>
                        <div class="form-group" ng-if="newProduct.newUnit || newProduct.newStockProduct">
                            <div class="col-md-4 col-md-offset-1" ng-if="newProduct.newStockProduct">
                                <select name="categories_id" class="categories"
                                        multiple="multiple"
                                        ng-options="category as category.name for category in categoryList track by category.id"
                                        ng-model="categorySelected"
                                        ng-change="updateCategories()">
                                </select>
                            </div>
                            <div class="col-md-4 col-md-offset-1" ng-if="newProduct.newUnit">
                                <input name="newProduct[newUnitCode]"
                                       type="string"
                                       class="form-control"
                                       ng-model="newProduct.newUnitCode"
                                       ng-required="{% newProduct.newUnit %}"
                                       placeholder="Abkürzung Einheit">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-1">
                                <input name="newProduct[singlePrice]"
                                       type="number"
                                       step="0.01"
                                       min="0"
                                       class="form-control"
                                       ng-model="newProduct.singlePrice"
                                       ng-required="true"
                                       placeholder="Einzelpreis">
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