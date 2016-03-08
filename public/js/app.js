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


customInterpolationApp.controller('PurchaseForm', function ($scope, $http) {
    $scope.id = 0;

    $scope.invoice = {
        items: []
    };

    $scope.products = {
        items: []
    };

    $scope.newShop = {};

    $scope.newProduct =  {};

    $scope.addItem = function() {
        $scope.id = $scope.id+1;
        $scope.invoice.items.push({
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
        $scope.invoice.items.splice(index, 1);
        $scope.id = $scope.id-1;
        for(var i=index;i<=$scope.invoice.items.length;i++) {
            $scope.invoice.items[i].id -= 1;
        }
    };

    $scope.total = function() {
        var total = 0;
        angular.forEach($scope.invoice.items, function(item) {
            total += item.qty * item.single_price;
        });
        return total;
    };

    $http.get('/getShops').then(function(shopsResponse) {
        $scope.shopList = shopsResponse.data.shopList;
        $scope.shopList.unshift({
            id: 'newShop',
            name: 'Laden hinzufügen'
        });
        $scope.shopSelected = "";
    });

    $http.get('/getCountries').then(function(countriesResponse) {
        $scope.countryList = countriesResponse.data.countryList;
        $scope.newShop.countrySelected = $scope.countryList[80];
    });

    $http.get('/getProductsNames').then(function(productsNamesResponse) {
        $scope.productsNames = productsNamesResponse.data.productsNames;
        $scope.unitList = productsNamesResponse.data.unitList;
        $scope.productsList = productsNamesResponse.data.products;
        console.log($scope.productsList);
    });

    $scope.updateProducts = function() {
        if($scope.shopSelected.id == 'newShop')
        {
            $("#new-shop-modal").modal();
        } else {
            $http({
                url: '/getProducts',
                method: "POST",
                data: { 'shopId' : $scope.shopSelected.id }
            }).then(
                function(productsResponse) {
                    $scope.productList = productsResponse.data.productList;
                    $scope.productData = {
                        availableOptions: productsResponse.data.productList,
                        selectedOptions: $scope.productList[0]
                    };
                    $scope.productData.availableOptions.unshift({
                        id: 'newProduct',
                        name: 'Produkt hinzufügen'
                    });
                    angular.forEach(productsResponse.data.productList, function(product) {
                        $scope.products.items.push({
                            id: product.id,
                            name: product.name,
                            unit: product.unit,
                            single_price: product.single_price
                        });
                    });
                    angular.forEach($scope.invoice.items, function(item) {
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
            $("#new-product-modal").modal();
        }
    };

    $scope.updateNewProductUnit = function() {
        console.log('#####');
        var result = $.grep($scope.productList, function(e){ return e.name == $scope.newProduct.name; });
        $scope.newProduct.unit = result[0].unit;
        console.log(result);
    };

    $scope.submit = function(){
        $http({
            url: '/savePurchase',
            method: "POST",
            data: { 'shopId' : $scope.shopSelected.id, 'products' : $scope.invoice.items, 'date' : $scope.bought_at }
        }).then(
            $scope.purchaseMessage = 'Speichern erfolgreich'
        )
    };

    $scope.submitShop = function() {
        $scope.newShop.countrySelected = $scope.newShop.countrySelected.id;
        console.log($scope.newShop);
        $http({
            url: '/newShop',
            method: "POST",
            data: { 'newShop': $scope.newShop }
        }).then(
            function(newShop){
                console.log(newShop);
                $scope.purchaseMessage = 'Speichern erfolgreich'
            }
        )
    };
});