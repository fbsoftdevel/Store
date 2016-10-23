(function(){
    var uiStorePoint = function($http){
        var getStoreAsArray = function(){
            return $http.get('../../wrapper/json/store_point.php')
                    .then(function(response){
                        return response.data;
            });
        };
        return{
            getStoreAsArray:getStoreAsArray
        };
    };
    var modulePg = angular.module("modProductGroup");
    modulePg.factory("uiStorePoint", uiStorePoint);
    
    var uiProductGroup = function($http){
        var getProductGroupAsArray = function(){
            return $http.get('../../wrapper/json/products_group.php')
                    .then(function(response){
                        return response.data;
            });
        };
        return{
          getProductGroupAsArray:getProductGroupAsArray  
        };
    };
    var moduleP = angular.module("modProduct");
    moduleP.factory("uiProductGroup", uiProductGroup);
}());

