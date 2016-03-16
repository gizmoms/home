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
        items: [],
        tags: []
    };

    $scope.products = {
        items: []
    };

    $scope.newShop = {};

    $scope.newProduct =  {
        newStockProduct: false,
        newUnit: false,
        newCategory: false,
        category: ''
    };

    var spacebar = 32;
    $scope.keys = [$mdConstant.KEY_CODE.ENTER, $mdConstant.KEY_CODE.COMMA, spacebar];

    $scope.addItem = function() {
        $scope.id = $scope.id+1;
        $scope.newPurchase.items.push({
            id: $scope.id,
            qty: 1,
            single_price: $scope.products.items.single_price,
            description: 'Produkt',
            cost: 0.00,
            productList: $scope.products,
            productFirstSelect: $scope.productData
        });
    };

    $scope.removeItem = function(index) {
        $scope.newPurchase.items.splice(index, 1);
        $scope.id = $scope.id-1;
        for(var i=index;i<=$scope.newPurchase.items.length;i++) {
            $scope.newPurchase.items[i].id -= 1;
        }
    };

    $scope.total = function() {
        var total = 0;
        angular.forEach($scope.newPurchase.items, function(item) {
            total += item.qty * item.single_price;
        });
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

    $http.get('/getCountries').then(function(countriesResponse) {
        $scope.countryList = countriesResponse.data.countryList;
        $scope.newShop.countrySelected = $scope.countryList[80];
    });

    $http.get('/getCategories', {cache: true}).then(function(categoriesResponse) {
        $scope.categoryList = categoriesResponse.data.categoryList;
    });

    $scope.getProductDetails = function() {
         $http.get('/getProductsNames').then(function(productsNamesResponse) {
            $scope.productsNames = productsNamesResponse.data.productsNames;
            $scope.unitList = productsNamesResponse.data.unitList;
            $scope.productsList = productsNamesResponse.data.products;
             console.log($scope.productsList);
        });
    }

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
                            single_price: product.single_price
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

    $scope.updateSinglePrice = function(item, selected) {
        item.single_price = selected.single_price;
        if(selected.id == 'newProduct')
        {
            $scope.getProductDetails();
            $("#new-product-modal").modal();
        }
    };

    $scope.updateNewProductUnit = function() {
        if($scope.newProduct.newStockProduct == false) {
            console.log($scope.productsList);
            var result = $.grep($scope.productsList, function(e){ return e.name == $scope.newProduct.name; });
            $scope.newProduct.unit = result[0].unit.name;
            $scope.newProduct.newUnit = false;
        }
    };

    $scope.updateCategory = function(){
        if($scope.newProduct.newCategory == false) {
            var result = $.grep($scope.productsList, function(e){ return e.name == $scope.newProduct.name;});
            console.log('###');
            console.log(result);
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
        console.log($scope.newPurchase);
        /*
        $http({
            url: '/savePurchase',
            method: "POST",
            data: { 'shopId' : $scope.newPurchase.shopSelected.id, 'products' : $scope.newPurchase.items, 'date' : $scope.bought_at }
        }).then(
            $scope.purchaseMessage = 'Speichern erfolgreich'
        )*/
    };

    $scope.submitShop = function() {
        $scope.newShop.countrySelected = $scope.newShop.countrySelected.id;
        $http({
            url: '/newShop',
            method: "POST",
            data: { 'newShop': $scope.newShop }
        }).then(
            function(newShop){
                $scope.purchaseMessage = 'Speichern erfolgreich'
            }
        )
    };

    $scope.submitProduct = function() {
        $scope.newProduct.shopId = $scope.newPurchase.shopSelected.id;
        console.log($scope.newProduct);
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
                    $scope.purchaseMessage = newProductResponse.data.message
                    var item = $scope.newPurchase.items[$scope.newPurchase.items.length -1];
                    item.productList = newProductResponse.data.productList
                    item.productFirstSelect = {
                        availableOptions: newProductResponse.data.productList,
                        selectedOptions: item.productList[5]
                    };
                    item.single_price = newProductResponse.data.newProduct.single_price;
                    item.productList.id = newProductResponse.data.newProduct.id;
                    item.productList.name = newProductResponse.data.newProduct.name;
                    item.productList.unit = newProductResponse.data.newProduct.unitName;
                    item.productList.single_price = newProductResponse.data.newProduct.single_price;
                } else if(newProductResponse.data.success == false) {
                    alert('blaaaa');
                }
            }
        )
    };

    function isNotInArray(value, array) {
        return array.indexOf(value) == -1;
    }
});