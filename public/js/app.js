'use strict';
var customInterpolationApp = angular.module('customInterpolationApp', ['ngMaterial']);

customInterpolationApp.config(function($interpolateProvider, $mdDateLocaleProvider) {
    $interpolateProvider.startSymbol('{%');
    $interpolateProvider.endSymbol('%}');
    $mdDateLocaleProvider.months = ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'];
    $mdDateLocaleProvider.shortMonths = ['Jan', 'Feb', 'Mrz', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez'];
    $mdDateLocaleProvider.days = ['Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag', 'Sonntag'];
    $mdDateLocaleProvider.shortDays = ['Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa', 'So'];
    $mdDateLocaleProvider.parseDate = function(dateString) {
        var m = moment(dateString, 'YYYY-MM-DD', true);
        return m.isValid() ? m.toDate() : new Date(NaN);
    };
});


customInterpolationApp.controller('PurchaseForm', function ($scope, $http, $mdConstant) {
    $scope.id = 0;

    $scope.newPurchase = {
        shopList: $scope.shopList(),
        shopSelected: '',
        boughtAt: '',
        tags: [],
        products: [],
        total: 0.00,
        productList: $scope.productList()
    };

    $scope.newProduct =  {
        name: '',
        unitName: '',
        unitList: $scope.unitList(),
        newUnit: false,
        categoryName: '',
        categoryList: $scope.categoryList(),
        newCategory: false,
        shopID: '',
        singlePrice: ''
    };

    var spacebar = 32;
    $scope.keys = [$mdConstant.KEY_CODE.ENTER, $mdConstant.KEY_CODE.COMMA, spacebar];

    $scope.addItem = function() {
        $scope.updateProducts();
        $scope.id = $scope.id+1;
        $scope.newPurchase.products.push({
            id: $scope.id,
            productId: '',
            productName: '',
            productQty: 1,
            productQtyStep: $scope.products.items.single_amount,
            productSinglePrice: $scope.products.items.single_price,
            productCost: 0.00,
            productList: $scope.productList()
        });
    };

    $scope.removeItem = function(index) {
        $scope.newPurchase.products.splice(index, 1);
        $scope.id = $scope.id-1;
        for(var i=index;i<=$scope.newPurchase.products.length;i++) {
            $scope.newPurchase.products[i].id -= 1;
        }
    };

    $scope.total = function() {
        var total = 0;
        angular.forEach($scope.newPurchase.products, function(product) {
            total += product.productQty * product.productSinglePrice;
        });
        $scope.newPurchase.total = total;
        return total;
    };

    $http.get('/getShops').then(function(shopsResponse) {
        $scope.shopList = shopsResponse.data.shopList;
        $scope.shopList.unshift({
            id: 'newShop',
            name: 'neuen Markt hinzufügen'
        });
        $scope.newPurchase.shopSelected = "";
    });

    $http.get('/getCategories', {cache: true}).then(function(categoriesResponse) {
        $scope.categoryList = categoriesResponse.data.categoryList;
    });

    $scope.getProductDetails = function() {
         $http.get('/getProductsNames').then(function(productsNamesResponse) {
            $scope.productsNames = productsNamesResponse.data.productsNames;
            $scope.unitList = productsNamesResponse.data.unitList;
            $scope.productsList = productsNamesResponse.data.products;
        });
    };

    $scope.updateProducts = function() {
        if($scope.newPurchase.shopSelected.id == 'newShop')
        {
            $("#new-shop-modal").modal();
        } else {
            $http({
                url: '/getProducts',
                method: "POST",
                data: { 'shopId' : $scope.newPurchase.shopSelected.id }
            }).then(
                function(productsResponse) {
                    $scope.productList = productsResponse.data.productList;
                    $scope.productData = {
                        availableOptions: productsResponse.data.productList,
                        selectedOptions: $scope.productList[0]
                    };
                    $scope.productData.availableOptions.unshift({
                        id: 'newProduct',
                        name: 'neues Produkt hinzufügen'
                    });
                    angular.forEach(productsResponse.data.productList, function(product) {
                        $scope.products.items.push({
                            id: product.id,
                            name: product.name,
                            unit: product.unit,
                            single_price: product.single_price,
                            single_amount: product.single_amount
                        });
                    });
                    angular.forEach($scope.newPurchase.items, function(item) {
                        item.productList = $scope.products;
                        item.productFirstSelect = $scope.productData;
                    });
                    return $scope.products.items;
                }
            )
        }
    };

    $scope.updateItem = function(item, selected) {
        item.single_price = selected.single_price;
        item.name = selected.name;
        item.productId = selected.id;
        item.step = selected.single_amount;
        if(selected.id == 'newProduct')
        {
            $scope.getProductDetails();
            $("#new-product-modal").modal();
        }
    };

    $scope.updateNewProductUnit = function() {
        if($scope.newProduct.newStockProduct == false) {
            var result = $.grep($scope.productsList, function(e){ return e.name == $scope.newProduct.name; });
            $scope.newProduct.unit = result[0].unit.name;
            $scope.newProduct.newUnit = false;
        }
    };

    $scope.updateCategory = function(){
        if($scope.newProduct.newCategory == false) {
            var result = $.grep($scope.productsList, function(e){ return e.name == $scope.newProduct.name;});
            $scope.newProduct.category = result[0].category.name;
        }
    };

    $scope.checkNewUnit = function() {
        if(isNotInArray($scope.newProduct.unit, $scope.unitList)) {
            $scope.newProduct.newUnit = true;
        } else {
            $scope.newProduct.newUnit = false;
        }
    };

    $scope.checkNewStockProduct = function() {
        var result = $.grep($scope.productsList, function(e){ return e.name == $scope.newProduct.name; });
        if(result.length <= 0) {
            $scope.newProduct.newStockProduct = true;
        } else {
            $scope.newProduct.newStockProduct = false;
            $scope.updateNewProductUnit();
            $scope.updateCategory();
            $scope.newProduct.productId = result[0].id;
        }
    };

    $scope.checkNewCategory = function() {
        var result = $.grep($scope.categoryList, function(e){ return e.name == $scope.newProduct.category; });
        if(result.length <= 0) {
            $scope.newProduct.newCategory = true;
        } else {
            $scope.newProduct.newCategory = false;
        }
    };

    $scope.submitPurchase = function(){
        $http({
            url: '/savePurchase',
            method: "POST",
            data: { 'newPurchase': $scope.newPurchase }
        }).then(
        )
    };

    $scope.submitShop = function() {
        $scope.newShop.countryId = $scope.newShop.countrySelected.id;
        $http({
            url: '/newShop',
            method: "POST",
            data: { 'newShop': $scope.newShop }
        }).then(
            function(newShopResponse){
                if(newShopResponse.data.success == true){
                    $("#new-shop-modal").modal('hide');
                    $scope.purchaseMessage = newShopResponse.data.message;
                    $scope.shopList = newShopResponse.data.shopList;
                    $scope.shopList.unshift({
                        id: 'newShop',
                        name: 'neuen Markt hinzufügen'
                    });
                    $scope.newPurchase.shopSelected = $scope.shopList[$scope.shopList.length-1];
                    console.log($scope.newPurchase.shopSelected);
                    $scope.updateProducts();
                }
            }
        )
    };

    $scope.submitProduct = function() {
        $scope.newProduct.shopId = $scope.newPurchase.shopSelected.id;
        if($scope.newProduct.newUnit == false) {
            var unitIndex = $scope.unitList.indexOf($scope.newProduct.unit);
            $scope.newProduct.unitId = unitIndex +1;
        }
        $http({
            url: '/newProduct',
            method: "POST",
            data: { 'newProduct': $scope.newProduct }
        }).then(
            function(newProductResponse){
                if(newProductResponse.data.success == true){
                    $("#new-product-modal").modal('hide');
                    $scope.purchaseMessage = newProductResponse.data.message;
                    var item = $scope.newPurchase.items[$scope.newPurchase.items.length -1];
                    item.productList = newProductResponse.data.productList;
                    item.productFirstSelect = {
                        availableOptions: newProductResponse.data.productList,
                        selectedOptions: item.productList[5]
                    };
                    item.single_price = newProductResponse.data.newProduct.single_price;
                    item.productList = item.productFirstSelect.availableOptions[item.productFirstSelect.availableOptions.length -1];
                    item.productId = newProductResponse.data.newProduct.id;
                } else if(newProductResponse.data.success == false) {
                }
            }
        )
    };

    function isNotInArray(value, array) {
        return array.indexOf(value) == -1;
    }
});