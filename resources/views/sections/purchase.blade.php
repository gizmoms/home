@section('jquery_files')
    $('.money').circliful();

    $('#new-purchase-slide, #new-purchase-close').click(function(){
        $(this).slideAddNewForm();
    });
@append

@section('js_files')
    <script src="{{ asset('/js/app.js') }}"></script>
@append

<div class="row row-fluid">
    <div class="col-sm-10 col-sm-offset-1">
        <div class="purchase">
            <div class="heading">
                <h1><a><i class="fa fa-arrow-left icon icon-small" title="vorheriger Monat"></i></a> März <i class="glyphicon glyphicon-cog icon icon-small" title="bearbeiten"></i></h1>
            </div>

            <div class="purchase-content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <h3 id="new-purchase-slide" class="cursor icon-body" data-target="new-purchase" data-text="Neuer Einkauf" title="Neuen Einkauf hinzufügen">Neuen Einkauf hinzufügen <i class="glyphicon glyphicon-pencil icon"></i></h3>
                            </div>
                        </div>
                        <div class="row" id="new-purchase">
                            <div class="col-sm-8 col-sm-offset-2">
                                <div class="new"  >
                                    <form ng-submit="submit()">
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <select name="shop_id" id="shops" class="form-control"
                                                            ng-options="shop as shop.name for shop in shopList track by shop.id"
                                                            ng-model="shopSelected"
                                                            ng-change="updateProducts()">
                                                        <option value="">Wähle einen Laden</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4 col-sm-offset-2">
                                                    <md-datepicker ng-model="bought_at" ng-required md-placeholder="Datum" ></md-datepicker>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <h5 class="md-title">Tags hinzufügen (Enter zum Übernehmen)</h5>
                                                    <md-chips
                                                            ng-model="tags"
                                                            md-separator-keys="PurchaseForm.keys"
                                                            placeholder="Tags eintragen"></md-chips>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" ng-if="shopSelected && shopSelected.id != 'newShop'">
                                            <div class="col-sm-12">
                                                <div class="product-table">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th class="a-center" width="7%">#</th>
                                                                <th class="a-left" width="45%">Produkt</th>
                                                                <th class="a-right" width="10%">Anzahl</th>
                                                                <th class="a-right" width="15%">Einzelpreis</th>
                                                                <th class="a-right" width="16%">Gesamtpreis</th>
                                                                <th class="a-center" width="7%"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr ng-repeat="item in invoice.items">
                                                                <td>{% item.id %}</td>
                                                                <td>
                                                                    <select name="products[{%item.id%}][product]"
                                                                            class="form-control add-product"
                                                                            ng-model="item.productList"
                                                                            ng-options="product as product.name for product in item.productFirstSelect.availableOptions track by product.id"
                                                                            ng-change="updateSinglePrice(item, item.productList)"
                                                                            required>
                                                                        <option value="">Produkt wählen</option>
                                                                    </select>
                                                                </td>
                                                                <td><input name="products[{%item.id%}][menge]" type="number" class="form-control" ng-model="item.qty" ng-required></td>
                                                                <td><input name="products[{%item.id%}][single_price]" type="number" step="0.01" min="0" class="form-control" ng-model="item.single_price"  ng-required ></td>
                                                                <td name="products[{%item.id%}][gesamtpreis]" class="a-right" ng-model="item.cost">{%item.qty * item.single_price | currency:"€ "%}</td>
                                                                <td>
                                                                    <a href ng-click="removeItem($index)" title="entfernen"><i class="glyphicon glyphicon-remove"></i></a>
                                                                </td>
                                                            </tr>
                                                            <tr class="cursor" title="Produkt hinzufügen">
                                                                <td></td>
                                                                <td colspan="5"><a href ng-click="addItem()" class="btn btn-small"><i class="fa fa-plus blue"></i> Produkt hinzufügen</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="6"></td>
                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="3"></td>
                                                                <td class="a-right">Gesamt</td>
                                                                <td class="a-right">{% total() | currency:"€ "%}</td>
                                                                <td></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-6">
                                                <div class="footer">
                                                    {!! Form::submit('Speichern', array('class' => 'btn btn-primary right')) !!}
                                                    <button type="button" id="new-purchase-close" class="btn btn-default right" data-dismiss="form" data-target="new-purchase" data-icon="new-purchase-slide">Abbrechen</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('modals.newProduct')
@include('modals.newShop')