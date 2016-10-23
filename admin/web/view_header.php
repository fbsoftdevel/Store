<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Store Manager</title>
        <link rel="stylesheet" href="../../lib/css/materialize.min.css"/>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
        <script type="text/javascript" src="../../lib/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../../lib/js/materialize.min.js"></script>
        <script type="text/javascript" src="../../lib/js/angular.js"></script>
        <script type="text/javascript" src="../../lib/js/dirPagination.js"></script>
        <script type="text/javascript" src ="../../lib/js/ng_script.js"></script>
        <script type="text/javascript" src ="../../lib/js/ui_support.js"></script>
        <style>
            .width-30-pct{width: 30%;}
            .width-20-pct{width: 20%;}
            .width-15-pct{width: 15%;}
            .text-align-center{text-align: center;}
            .margin-bottom-1em{margin-bottom: 1em;}
        </style>
        <script>
            $(document).ready(function () {
                // initialize modal
                $('.modal-trigger').leanModal();
                $('ul.tabs').tabs();
            });
        </script>        
    </head>
    <body class="brown lighten-3" ng-app="rootStoreApp">
