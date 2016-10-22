<?php
    include 'view_header.php';
?>
<body>
    <script type="text/javascript">
    $(document).ready(function () {
            // initialize modal
            $('.modal-trigger').leanModal();
            $('select').material_select();
        });    
    </script>
<div id="pgroup_container">
    
    <div class="container" ng-app="modProductGroup" ng-controller="productGroupController">
        <div class="row">
            <div class="col s12">                
               <div id="modal-productgroup-form" class="modal">
                    <div class="modal-content">
                        <h4 id="modal-productgroup-title">Create new Product group</h4>
                        <div class="row">
                            <div class="input-field col s12">
                                <select ng-model="storeRef" class="validate">
                                    <option value="" disabled selected>Choose your Store...</option>
                                </select>
                                <!--<input ng-model="storeRef" type="text" class="validate" id="form-name" placeholder="Type Store reference here..."/>-->
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
                                <input ng-model="groupDescription" type="text" class="validate" id="form-name" placeholder="Type Group description here..."/>
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
</body>
<?php
    include 'view_footer.php';