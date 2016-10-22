<?php
    include 'view_header.php';
?>
<body>
<div id="pimage_container">
    <script>
        var app = angular.module('modProductImage', ['angularUtils.directives.dirPagination']);
        app.controller('productImageController', function ($scope, $http) {
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
            }
        });
        $(document).ready(function () {
            // initialize modal
            $('.modal-trigger').leanModal();
        });
    </script>
    <div class="container" ng-app="modProductImage" ng-controller="productImageController">
        <div class="row">
            <div class="col s12">
                <h4>Product Groups</h4>
                <input type="text" ng-model="search" class="form-control" placeholder="Search Product images..."/>
                <table class="hoverable bordered">
                    <thead>
                        <tr>
                            <th class="text-align-center">DBID</th>
                            <th class="width-20-pct">Image path</th>
                            <th class="width-20-pct">Product Ref.</th>
                            <th class="width-15-pct">Sorting</th>
                            <th class="width-15-pct">Description</th>
                            <th class="width-15-pct">Created</th>
                            <th class="width-15-pct">Modified</th>
                            <th class="text-align-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody ng-init="getAll()">
                        <tr dir-paginate="d in productImages | filter:search | orderBy:sortKey:reverse | itemsPerPage:5" pagination-id="imagex">
                            <td class="text-align-center">{{d.dbid}}</td>
                            <td>{{d.imagePath}}</td>
                            <td>{{d.productReference}}</td>
                            <td>{{d.sorting}}</td>
                            <td>{{d.description}}</td>
                            <td class="width-15-pct">{{d.created}}</td>
                            <td class="width-15-pct">{{d.modified}}</td>
                            <td>
                                <a ng-click="readOne(d.dbid)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">edit</i>Edit</a>
                                <a ng-click="deleteProductImage(d.dbid)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">delete</i>Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <dir-pagination-controls pagination-id="imagex" boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="dir_pagination.tpl.html"></dir-pagination-controls>
                <div id="modal-productimage-form" class="modal">
                    <div class="modal-content">
                        <h4 id="modal-productimage-title">Create new Product image</h4>
                        <div class="row">
                            <div class="input-field col s12">
                                <input ng-model="imagePath" type="text" class="validate" id="form-name" placeholder="Load image here..."/>
                                <label for="imagePath">Image Path</label>
                            </div>
                            <div class="input-field col s12">
                                <input ng-model="productReference" type="text" class="validate" id="form-name" placeholder="Type Product reference here..."/>
                                <label for="productReference">Product Ref.</label>
                            </div>
                            <div class="input-field col s12">
                                <input ng-model="sorting" type="text" class="validate" id="form-name" placeholder="Type Sorting here..."/>
                                <label for="sorting">Sorting</label>
                            </div>
                            <div class="input-field col s12">
                                <input ng-model="description" type="text" class="validate" id="form-name" placeholder="Type Description here..."/>
                                <label for="description">Description</label>
                            </div>
                            <div class="input-field col s12">
                                <a id="btn-create-productimage" class="waves-effect waves-light btn margin-bottom-1em" ng-click="createProductImage()"><i class="material-icons left">add</i>Create</a> 
                                <a id="btn-update-productimage" class="waves-effect waves-light btn margin-bottom-1em" ng-click="updateProductImage()"><i class="material-icons left">edit</i>Save Changes</a> 
                                <a class="modal-action modal-close waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">close</i>Close</a>
                            </div>
                        </div>
                    </div>            
                </div>
                <div class="fixed-action-btn" style="bottom:45px; right:24px;">
                    <a class="waves-effect waves-light btn modal-trigger btn-floating btn-large red" href="#modal-productimage-form" ng-click="showCreateForm()"><i class="large material-icons">add</i></a>
                </div>
            </div>
        </div>
    </div> 
</div>
</body>
<?php
    include 'view_footer.php';