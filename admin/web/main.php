
<?php
include_once 'view_header.php';
?>
<div class="row card-panel brown lighten-5 brown lighten-2">
    <div class="col s12">
        <ul class="tabs">
            <li class="tab col s3 card-panel brown darken-1"><a href="#store_container"><span class="brown-text text-lighten-5">STORE</span></a></li>
            <li class="tab col s3 card-panel brown darken-1"><a class="active" href="#pgroup_container"><span class="brown-text text-lighten-5">GROUPS</span></a></li>
            <li class="tab col s3 card-panel brown darken-1"><a href="#product_container"><span class="brown-text text-lighten-5">PRODUCTS</span></a></li>
            <li class="tab col s3 card-panel brown darken-1"><a href="#pimage_container"><span class="brown-text text-lighten-5">IMAGES</span></a></li>
        </ul>
    </div>
</div>
<div id="store_container">
    <div class="container" ng-controller="StoreController">
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
<div id="pgroup_container">
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
<div id="product_container">    
    <div class="container" ng-controller="ProductCtrl">
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
                                <select ng-model="groupRef">
                                    <option value="" disabled selected>Choose your Group reference...</option>     
                                    <option ng-repeat="group in groups" value="{{group.group_name}}">{{group.group_name}}</option>
                                </select>
                                <label for="storeRef">Store reference</label>
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
<div id="pimage_container">
    <div class="container" ng-controller="ProductImageCtrl">
        <div class="row">
            <div class="col s12">
                <h4>Product Images</h4>
                <input type="text" ng-model="search" class="form-control" placeholder="Search Product images..."/>
                <table class="hoverable bordered">
                    <thead>
                        <tr>
                            <th class="text-align-center">DBID</th>
                            <th class="width-20-pct">Image Name</th>
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
                            <div class="file-field input-field col s12">
                                <div class="btn">
                                    <span>File</span>
                                    <input type="file">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="=text" ng-model="imagePath" placeholder="Load image here...">
                                </div>                                
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
<?php
include_once 'view_footer.php';
