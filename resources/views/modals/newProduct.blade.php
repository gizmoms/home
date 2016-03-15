@section('js_files')
    <script type="text/ng-template" id="template-category">
        <div class="left-panel">
            <span ng-bind-html="$highlight($getDisplayText())"></span>
            <span>({%list.name%})</span>
        </div>
    </script>
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
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group is-empty">
                                <input name="newProduct[name]"
                                       type="text"
                                       class="form-control"
                                       ng-model="newProduct.name"
                                       ng-keyup="checkNewStockProduct()"
                                       ng-change="checkNewStockProduct()"
                                       ng-required="true"
                                       list="productsNames"
                                       placeholder="Name"
                                       autocomplete="off">
                                <datalist id="productsNames">
                                    <option ng-repeat="productName in productsList" value="{% productName.name %}">
                                </datalist>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
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
                    </div>
                    <div class="row" ng-if="newProduct.newStockProduct">
                        <div class="col-md-10 col-md-offset-1" ng-if="newProduct.newStockProduct">
                            <div class="form-group is-empty">
                                <input name="newProduct[category]"
                                       type="text"
                                       class="form-control"
                                       ng-model="newProduct.category"
                                       ng-change="checkNewCategory()"
                                       ng-required="true"
                                       list="categories"
                                       placeholder="Kategorie"
                                       autocomplete="off">
                                <datalist id="categories">
                                    <option ng-repeat="category in categoryList" value="{% category.name %}">
                                </datalist>
                            </div>
                        </div>
                    </div>
                    <div class="row" ng-if="newProduct.newUnit">
                        <div class="col-md-10 col-md-offset-1" ng-if="newProduct.newUnit">
                            <div class="form-group">
                                <input name="newProduct[newUnitCode]"
                                       type="string"
                                       class="form-control"
                                       ng-model="newProduct.newUnitCode"
                                       ng-required="{% newProduct.newUnit %}"
                                       placeholder="Abkürzung Einheit">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <input name="newProduct[singlePrice]"
                                       type="number"
                                       step="0.01"
                                       min="0"
                                       class="form-control a-right"
                                       ng-model="newProduct.singlePrice"
                                       ng-required="true"
                                       placeholder="Einzelpreis">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary right">Speichern</button>
                    <button type="button" class="btn btn-default right" data-dismiss="modal">Abbrechen</button>
                </div>
            </form>
        </div>
    </div>
</div>