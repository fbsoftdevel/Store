<?php
    include 'view_header.php';
?>
<body>
<div id="product_container">
    <script>
        var app = angular.module('modProduct', ['angularUtils.directives.dirPagination']);
        app.controller('productController', function ($scope, $http) {
            $scope.showCreateForm = function () {
                $scope.clearForm();
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
                    
                'groupRef' : $scope.groupRef,
                'productName' : $scope.productName,
                'productDescription' : $scope.productDescription,
                'productImage' : $scope.productImage,
                'discount' : $scope.discount,
                'buyPrice' : $scope.buyPrice,
                'sellPrice' : $scope.sellPrice
                
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
                    'groupRef' : $scope.groupRef,
                    'productName' : $scope.productName,
                    'productDescription' : $scope.productDescription,
                    'productImage' : $scope.productImage,
                    'discount' : $scope.discount,
                    'buyPrice' : $scope.buyPrice,
                    'sellPrice' : $scope.sellPrice
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
            }
        });
        $(document).ready(function () {
            // initialize modal
            $('.modal-trigger').leanModal();
        });
    </script>
    <div class="container" ng-app="modProduct" ng-controller="productController">
        <div class="row">
            <div class="col s12">
                <h4>Products</h4>
                <input type="text" ng-model="search" class="form-control" placeholder="Search Product..."/>
                <table class="hoverable bordered">
                    <thead>
                        <tr>
                            <th class="text-align-center">DBID</th>
                            <th class="width-20-pct">Group Reference</th>
                            <th class="width-20-pct">Product Name</th>
                            <th class="width-15-pct">Product Description</th>                                                       
                            <th class="width-15-pct">Product Image</th>
                            <th class="width-15-pct">Discount</th>
                            <th class="width-15-pct">Buy Price</th>
                            <th class="width-15-pct">Sell Price</th>
                            <th class="width-15-pct">Created</th>
                            <th class="width-15-pct">Modified</th>
                            <th class="text-align-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody ng-init="getAll()">
                        <tr dir-paginate="d in products | filter:search | orderBy:sortKey:reverse | itemsPerPage:5" pagination-id="productx">
                            <td class="text-align-center">{{d.dbid}}</td>
                            <td>{{d.groupRef}}</td>
                            <td>{{d.productName}}</td>
                            <td>{{d.productDescription}}</td>
                            <td>{{d.productImage}}</td>
                            <td>{{d.discount}}</td>
                            <td>{{d.buyPrice}}</td>
                            <td>{{d.sellPrice}}</td>
                            <td class="width-15-pct">{{d.created}}</td>
                            <td class="width-15-pct">{{d.modified}}</td>
                            <td>
                                <a ng-click="readOne(d.dbid)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">edit</i>Edit</a>
                                <a ng-click="deleteProduct(d.dbid)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">delete</i>Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <dir-pagination-controls pagination-id="productx" boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="dir_pagination.tpl.html"></dir-pagination-controls>
                <div id="modal-product-form" class="modal">
                    <div class="modal-content">
                        <h4 id="modal-product-title">Create new Product</h4>
                        <div class="row">
                            <div class="input-field col s12">
                                <input ng-model="groupRef" type="text" class="validate" id="form-name" placeholder="Type Group reference here..."/>
                                <label for="groupRef">Group reference</label>
                            </div>
                            <div class="input-field col s12">
                                <input ng-model="productName" type="text" class="validate" id="form-name" placeholder="Type Product Name here..."/>
                                <label for="productName">Product Name</label>
                            </div>
                            <div class="input-field col s12">
                                <input ng-model="productDescription" type="text" class="validate" id="form-name" placeholder="Type Product description here..."/>
                                <label for="productDescription">Product description</label>
                            </div>
                             <div class="input-field col s12">
                                <input ng-model="productImage" type="text" class="validate" id="form-name" placeholder="Type Product images reference here..."/>
                                <label for="productImage">Product Image</label>
                            </div>
                            <div class="input-field col s12">
                                <input ng-model="discount" type="text" class="validate" id="form-name" placeholder="Type Discount here..."/>
                                <label for="discount">Discount</label>
                            </div>                            
                            <div class="input-field col s12">
                                <input ng-model="buyPrice" type="text" class="validate" id="form-name" placeholder="Type Buy price reference here..."/>
                                <label for="buyPrice">Buy Price</label>
                            </div>
                            <div class="input-field col s12">
                                <input ng-model="sellPrice" type="text" class="validate" id="form-name" placeholder="Type Sell price Name here..."/>
                                <label for="sellPrice">Sell Price</label>
                            </div>                           
                            <div class="input-field col s12">
                                <a id="btn-create-product" class="waves-effect waves-light btn margin-bottom-1em" ng-click="createProduct()"><i class="material-icons left">add</i>Create</a> 
                                <a id="btn-update-product" class="waves-effect waves-light btn margin-bottom-1em" ng-click="updateProduct()"><i class="material-icons left">edit</i>Save Changes</a> 
                                <a class="modal-action modal-close waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">close</i>Close</a>
                            </div>
                        </div>
                    </div>            
                </div>
                <div class="fixed-action-btn" style="bottom:45px; right:24px;">
                    <a class="waves-effect waves-light btn modal-trigger btn-floating btn-large red" href="#modal-product-form" ng-click="showCreateForm()"><i class="large material-icons">add</i></a>
                </div>
            </div>
        </div>
    </div> 
</div>
</body>
<?php
    include 'view_footer.php';