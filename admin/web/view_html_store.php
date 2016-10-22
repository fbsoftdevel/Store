<?php
include 'view_header.php';
?>
<div id="store_container">
    <script>
        var appS = angular.module('modStorePoint', ['angularUtils.directives.dirPagination']);
        appS.controller('storeController', function ($scope, $http) {
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
                    'dbid' : $scope.dbid,
                    'storeName' : $scope.storeName,
                    'storeLocation' : $scope.storeLocation
                }).success(function(data, status, headers, config){
                    Materialize.toast(data, 4000);
                        $('#modal-storepoint-form').closeModal();
                        $scope.clearForm();
                        $scope.getAll();
                    });
                };
            $scope.deleteStorePoint = function (dbid) {
                if (confirm("Are you sure?")){
                        $http.post('../controller/deleteStorePoint.php', {
                            'dbid': dbid
                        }).success(function (data, status, headers, config) {
                            Materialize.toast(data, 4000);
                            $scope.getAll();
                        });
                }
            };
            });
            $(document).ready(function () {
                // initialize modal
                $('.modal-trigger').leanModal();
            });
    </script>
    <div class="container" ng-app="modStorePoint" ng-controller="storeController">
        <div class="row">
            <div class="col s12">
                <h4>Store Points</h4>
                <input type="text" ng-model="search" class="form-control" placeholder="Search Store point..."/>
                <table class="hoverable bordered">
                    <thead>
                        <tr>
                            <th class="text-align-center">DBID</th>
                            <th class="width-20-pct">Store Name</th>
                            <th class="width-20-pct">Location</th>
                            <th class="width-15-pct">Created</th>
                            <th class="width-15-pct">Modified</th>
                            <th class="text-align-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody ng-init="getAll()">
                        <tr dir-paginate="d in storeNames | filter:search | orderBy:sortKey:reverse | itemsPerPage:5" pagination-id="storex">
                            <td class="text-align-center">{{d.dbid}}</td>
                            <td>{{d.storeName}}</td>
                            <td>{{d.storeLocation}}</td>
                            <td class="width-15-pct">{{d.created}}</td>
                            <td class="width-15-pct">{{d.modified}}</td>
                            <td>
                                <a ng-click="readOne(d.dbid)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">edit</i>Edit</a>
                                <a ng-click="deleteStorePoint(d.dbid)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">delete</i>Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <dir-pagination-controls pagination-id="storex" boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="dir_pagination.tpl.html"></dir-pagination-controls>
                <div id="modal-storepoint-form" class="modal">
                    <div class="modal-content">
                        <h4 id="modal-storepoint-title">Create new Store Point</h4>
                        <div class="row">
                            <div class="input-field col s12">
                                <input ng-model="storeName" type="text" class="validate" id="form-name" placeholder="Type Store name here..."/>
                                <label for="storeName">Store Name</label>
                            </div>
                            <div class="input-field col s12">
                                <input ng-model="storeLocation" type="text" class="validate" id="form-name" placeholder="Type Store location here..."/>
                                <label for="storeLocation">Store Location</label>
                            </div>
                            <div class="input-field col s12">
                                <a id="btn-create-storepoint" class="waves-effect waves-light btn margin-bottom-1em" ng-click="createStorePoint()"><i class="material-icons left">add</i>Create</a> 
                                <a id="btn-update-storepoint" class="waves-effect waves-light btn margin-bottom-1em" ng-click="updateStorePoint()"><i class="material-icons left">edit</i>Save Changes</a> 
                                <a class="modal-action modal-close waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">close</i>Close</a>
                            </div>
                        </div>
                    </div>            
                </div>
                <div class="fixed-action-btn" style="bottom:45px; right:24px;">
                    <a class="waves-effect waves-light btn modal-trigger btn-floating btn-large red" href="#modal-storepoint-form" ng-click="showCreateForm()"><i class="large material-icons">add</i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'view_footer.php';