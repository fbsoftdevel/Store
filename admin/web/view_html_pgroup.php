<?php
include 'view_header.php';
?>
<div id="pgroup_container" ng-app="modProductGroup">
    <div class="container" ng-controller="ProductGroupCtrl">
        <div class="row">
            <div class="col s12">
                <h4>Product Groups</h4>
                <input type="text" ng-model="search" class="form-control" placeholder="Search Product group..."/>
                <table class="hoverable bordered">
                    <thead>
                        <tr>
                            <th class="text-align-center">DBID</th>
                            <th class="width-20-pct">Store Reference</th>
                            <th class="width-20-pct">Group Name</th>
                            <th class="width-15-pct">Discount</th>
                            <th class="width-15-pct">Group Description</th>
                            <th class="width-15-pct">Created</th>
                            <th class="width-15-pct">Modified</th>
                            <th class="text-align-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody ng-init="getAll()">
                        <tr dir-paginate="d in productGroups | filter:search | orderBy:sortKey:reverse | itemsPerPage:5" pagination-id="groupx">
                            <td class="text-align-center">{{d.dbid}}</td>
                            <td>{{d.storeRef}}</td>
                            <td>{{d.groupName}}</td>
                            <td>{{d.discount}}</td>
                            <td>{{d.groupDescription}}</td>
                            <td class="width-15-pct">{{d.created}}</td>
                            <td class="width-15-pct">{{d.modified}}</td>
                            <td>
                                <a ng-click="readOne(d.dbid)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">edit</i>Edit</a>
                                <a ng-click="deleteProductGroup(d.dbid)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">delete</i>Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <dir-pagination-controls pagination-id="groupx" boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="dir_pagination.tpl.html"></dir-pagination-controls>
                <div id="modal-productgroup-form" class="modal">
                    <div class="modal-content">
                        <h4 id="modal-productgroup-title">Create new Product group</h4>
                        <div class="row">
                            <div class="input-field col s12">
                                <select ng-model="storeRef">
                                    <option value="" disabled selected>Choose your store...</option>     
                                    <option ng-repeat="store in stores" value="{{store.store_name}}">{{store.store_name}}</option>
                                </select>
                                <label for="storeRef">Store reference</label>
                            </div>
                            <div class="input-field col s12">
                                <input ng-model="groupName" type="text" class="validate" id="form-name" placeholder="Type Group Name here..."/>
                                <label for="groupName">Group Name</label>
                            </div>
                            <div class="input-field col s12">
                                <input ng-model="discount" type="text" class="validate" id="form-name" placeholder="Type Discount here..."/>
                                <label for="discount">Discount</label>
                            </div>
                            <div class="input-field col s12">
                                <textarea ng-model="groupDescription" class="materialize-textarea" placeholder="Type Group description here..."></textarea>
                                <label for="groupDescription">Group description</label>
                            </div>
                            <div class="input-field col s12">
                                <a id="btn-create-productgroup" class="waves-effect waves-light btn margin-bottom-1em" ng-click="createProductGroup()"><i class="material-icons left">add</i>Create</a> 
                                <a id="btn-update-productgroup" class="waves-effect waves-light btn margin-bottom-1em" ng-click="updateProductGroup()"><i class="material-icons left">edit</i>Save Changes</a> 
                                <a class="modal-action modal-close waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">close</i>Close</a>
                            </div>
                        </div>
                    </div>            
                </div>
                <div class="fixed-action-btn" style="bottom:45px; right:24px;">
                    <a class="waves-effect waves-light btn modal-trigger btn-floating btn-large red" href="#modal-productgroup-form" ng-click="showCreateForm()"><i class="large material-icons">add</i></a>
                </div>
            </div>
        </div>
    </div> 
</div>
<?php
include 'view_footer.php';
