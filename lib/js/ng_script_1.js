(function () {
    var appPGroup = angular.module('modProductGroup', ['angularUtils.directives.dirPagination']);
    var ProductGroupCtrl = function ($scope, uiStorePoint, $http, $log) {
        var init = function () {
            uiStorePoint.getStoreAsArray().then(loadStoreSelect, onError);
        };
        var loadStoreSelect = function (data) {
            $scope.stores = data;
        };
        var onError = function (reason) {
            Materialize.toast('Could not fetch the data: ' + reason);
        };
        init();
        $scope.showCreateForm = function () {
            $scope.clearForm();
            $('select').material_select();
            $('#modal-productgroup-title').text('Create new Product group');
            $('#btn-update-productgroup').hide();
            $('#btn-create-productgroup').show();
        };
        $scope.clearForm = function () {
            $scope.dbid = "";
            $scope.storeRef = "";
            $scope.groupName = "";
            $scope.discount = "";
            $scope.groupDescription = "";
        };
        $scope.createProductGroup = function () {
            $http.post('../controller/createProductGroup.php', {
                'storeRef': $scope.storeRef,
                'groupName': $scope.groupName,
                'discount': $scope.discount,
                'groupDescription': $scope.groupDescription
            }
            ).success(function (data, status, header, config) {
                Materialize.toast(data, 4000);
                $('#modal-productgroup-form').closeModal();
                $scope.clearForm();
                $scope.getAll();
            });
        };
        $scope.getAll = function () {            
            $http.get("../controller/readProductGroups.php").success(function (response) {
                $scope.productGroups = response.records;                
            });
        };
        $scope.readOne = function (dbid) {
            $('#modal-productgroup-title').text("Edit Product group");
            $('#btn-update-productgroup').show();
            $('#btn-create-productgroup').hide();
            $http.post('../controller/readOneProductGroup.php', {
                'dbid': dbid
            }).success(function (data, status, headers, config) {
                $scope.dbid = data[0]["dbid"];
                $scope.storeRef = data[0]["storeRef"];
                $scope.groupName = data[0]["groupName"];
                $scope.discount = data[0]["discount"];
                $scope.groupDescription = data[0]["groupDescription"];
                $('#modal-productgroup-form').openModal();
            }).error(function (data, status, header, config) {
                Materialize.toast('Unable to retrieve record.', 4000);
            });
        };
        $scope.updateProductGroup = function () {
            $http.post('../controller/updateProductGroup.php', {
                'dbid': $scope.dbid,
                'storeRef': $scope.storeRef,
                'groupName': $scope.groupName,
                'discount': $scope.discount,
                'groupDescription': $scope.groupDescription
            }).success(function (data, status, headers, config) {
                Materialize.toast(data, 4000);
                $('#modal-productgroup-form').closeModal();
                $scope.clearForm();
                $scope.getAll();
            });
        };
        $scope.deleteProductGroup = function (dbid) {
            if (confirm("Are you sure?")) {
                $http.post('../controller/deleteProductGroup.php', {
                    'dbid': dbid
                }).success(function (data, status, headers, config) {
                    Materialize.toast(data, 4000);
                    $scope.getAll();
                });
            }
        }
    };
    appPGroup.controller('ProductGroupCtrl', ProductGroupCtrl);

    var appStore = angular.module('modStorePoint', ['angularUtils.directives.dirPagination']);
    var StoreController = function ($scope, $http) {
        var init = function () {
        };
        var onError = function (reason) {
            Materialize.toast(reason);
        };
        init();
        $scope.showCreateForm = function () {
            $scope.clearForm();            
            $('#modal-storepoint-title').text('Create new Store Point');
            $('#btn-update-storepoint').hide();
            $('#btn-create-storepoint').show();
        };
        $scope.clearForm = function () {
            $scope.dbid = "";
            $scope.storeName = "";
            $scope.storeLocation = "";
        };
        $scope.createStorePoint = function () {
            $http.post('../controller/createStorePoint.php', {
                'storeName': $scope.storeName,
                'storeLocation': $scope.storeLocation
            }
            ).success(function (data, status, header, config) {
                console.log(data);
                Materialize.toast(data, 4000);
                $('#modal-storepoint-form').closeModal();
                $scope.clearForm();
                $scope.getAll();
            });
        };
        $scope.getAll = function () {
            $http.get("../controller/readStorePoints.php").success(function (response) {
                $scope.storeNames = response.records;
            });
        };
        $scope.readOne = function (dbid) {
            $('#modal-storepoint-title').text("Edit Store point");
            $('#btn-update-storepoint').show();
            $('#btn-create-storepoint').hide();
            $http.post('controller/readOneStorePoint.php', {
                'dbid': dbid
            }).success(function (data, status, headers, config) {
                $scope.dbid = data[0]["dbid"];
                $scope.storeName = data[0]["storeName"];
                $scope.storeLocation = data[0]["storeLocation"];

                $('#modal-storepoint-form').openModal();
            }).error(function (data, ststus, header, config) {
                Materialize.toast('Unable to retrieve record.', 4000);
            });
        };
        $scope.updateStorePoint = function () {
            $http.post('../controller/updateStorePoint.php', {
                'dbid': $scope.dbid,
                'storeName': $scope.storeName,
                'storeLocation': $scope.storeLocation
            }).success(function (data, status, headers, config) {
                Materialize.toast(data, 4000);
                $('#modal-storepoint-form').closeModal();
                $scope.clearForm();
                $scope.getAll();
            });
        };
        $scope.deleteStorePoint = function (dbid) {
            if (confirm("Are you sure?")) {
                $http.post('../controller/deleteStorePoint.php', {
                    'dbid': dbid
                }).success(function (data, status, headers, config) {
                    Materialize.toast(data, 4000);
                    $scope.getAll();
                });
            }
        };
    };
    appStore.controller('StoreController', StoreController);
     
    var appProduct = angular.module('modProduct', ['angularUtils.directives.dirPagination']);
    var ProductCtrl = function ($scope, uiProductGroup, $http) {
        var init = function () {
            uiProductGroup.getProductGroupAsArray().then(loadPGroupSelect, onError);
        };
        var loadPGroupSelect = function(data){
            $scope.groups = data;
        };
        var onError = function (reason) {
            Materialize.toast(reason);
        };
        init();
        $scope.showCreateForm = function () {
            $scope.clearForm();
            $('select').material_select();
            $('#modal-product-title').text('Create new Product');
            $('#btn-update-product').hide();
            $('#btn-create-product').show();
        };
        $scope.clearForm = function () {
            $scope.dbid = "";
            $scope.groupRef = "";
            $scope.productName = "";
            $scope.productDescription = "";
            $scope.productImage = "";
            $scope.discount = "";
            $scope.buyPrice = "";
            $scope.sellPrice = "";
        };
        $scope.createProduct = function () {
            $http.post('../controller/createProduct.php', {

                'groupRef': $scope.groupRef,
                'productName': $scope.productName,
                'productDescription': $scope.productDescription,
                'productImage': $scope.productImage,
                'discount': $scope.discount,
                'buyPrice': $scope.buyPrice,
                'sellPrice': $scope.sellPrice

            }
            ).success(function (data, status, header, config) {
                console.log(data);
                Materialize.toast(data, 4000);
                $('#modal-product-form').closeModal();
                $scope.clearForm();
                $scope.getAll();
            });
        };
        $scope.getAll = function () {
            $http.get("../controller/readProduct.php").success(function (response) {
                $scope.products = response.records;
            });
        };
        $scope.readOne = function (dbid) {
            $('#modal-product-title').text("Edit Product");
            $('#btn-update-product').show();
            $('#btn-create-product').hide();
            $http.post('../controller/readOneProduct.php', {
                'dbid': dbid
            }).success(function (data, status, headers, config) {

                $scope.dbid = data[0]["dbid"];
                $scope.groupRef = data[0]["groupRef"];
                $scope.productName = data[0]["productName"];
                $scope.productDescription = data[0]["productDescription"];
                $scope.productImage = data[0]["productImage"];
                $scope.discount = data[0]["discount"];
                $scope.buyPrice = data[0]["buyPrice"];
                $scope.sellPrice = data[0]["sellPrice"];

                $('#modal-product-form').openModal();
            }).error(function (data, status, header, config) {
                Materialize.toast('Unable to retrieve record.', 4000);
            });
        };
        $scope.updateProduct = function () {
            $http.post('../controller/updateProduct.php', {
                'dbid': $scope.dbid,
                'groupRef': $scope.groupRef,
                'productName': $scope.productName,
                'productDescription': $scope.productDescription,
                'productImage': $scope.productImage,
                'discount': $scope.discount,
                'buyPrice': $scope.buyPrice,
                'sellPrice': $scope.sellPrice
            }).success(function (data, status, headers, config) {
                Materialize.toast(data, 4000);
                $('#modal-product-form').closeModal();
                $scope.clearForm();
                $scope.getAll();
            });
        };
        $scope.deleteProduct = function (dbid) {
            if (confirm("Are you sure?")) {
                $http.post('../controller/deleteProduct.php', {
                    'dbid': dbid
                }).success(function (data, status, headers, config) {
                    Materialize.toast(data, 4000);
                    $scope.getAll();
                });
            }
        };
    };
    appProduct.controller('ProductCtrl', ProductCtrl);
    
    var modProductImage = angular.module('modProductImage', ['angularUtils.directives.dirPagination']);
    var ProductImageCtrl = function ($scope, $http){
        $scope.showCreateForm = function () {
                $scope.clearForm();
                $('#modal-productimage-title').text('Create new Product group');
                $('#btn-update-productimage').hide();
                $('#btn-create-productimage').show();
            };
            $scope.clearForm = function () {
                $scope.dbid = "";
                $scope.imagePath = "";
                $scope.productReference = "";
                $scope.sorting = "";
                $scope.description = "";
            };
            $scope.createProductImage = function () {
                $http.post('../controller/createProductImage.php', {
                    'imagePath': $scope.imagePath,
                    'productReference': $scope.productReference,
                    'sorting': $scope.sorting,
                    'description': $scope.description
                }
                ).success(function (data, status, header, config) {
                    console.log(data);
                    Materialize.toast(data, 4000);
                    $('#modal-productimage-form').closeModal();
                    $scope.clearForm();
                    $scope.getAll();
                });
            };
            $scope.getAll = function () {
                $http.get("../controller/readProductImage.php").success(function (response) {
                    $scope.productImages = response.records;
                });
            };
            $scope.readOne = function (dbid) {
                $('#modal-productimage-title').text("Edit Product image");
                $('#btn-update-productimage').show();
                $('#btn-create-productimage').hide();
                $http.post('../controller/readOneProductImage.php', {
                    'dbid': dbid
                }).success(function (data, status, headers, config) {
                    $scope.dbid = data[0]["dbid"];
                    $scope.imagePath = data[0]["imagePath"];
                    $scope.productReference = data[0]["productReference"];
                    $scope.sorting = data[0]["sorting"];
                    $scope.description = data[0]["description"];

                    $('#modal-productimage-form').openModal();
                }).error(function (data, status, header, config) {
                    Materialize.toast('Unable to retrieve record.', 4000);
                });
            };
            $scope.updateProductImage = function () {
                $http.post('../controller/updateProductImage.php', {
                    'dbid': $scope.dbid,
                    'imagePath': $scope.imagePath,
                    'productReference': $scope.productReference,
                    'sorting': $scope.sorting,
                    'description': $scope.description
                }).success(function (data, status, headers, config) {
                    Materialize.toast(data, 4000);
                    $('#modal-productimage-form').closeModal();
                    $scope.clearForm();
                    $scope.getAll();
                });
            };
            $scope.deleteProductImage = function (dbid) {
                if (confirm("Are you sure?")) {
                    $http.post('../controller/deleteProductImage.php', {
                        'dbid': dbid
                    }).success(function (data, status, headers, config) {
                        Materialize.toast(data, 4000);
                        $scope.getAll();
                    });
                }
            };
    };
    modProductImage.controller('ProductImageCtrl', ProductImageCtrl);
}());


