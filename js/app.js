/*global angular */
'use strict';




/**
 * The main app module
 * @name app
 * @type {angular.Module}
 */
var salva_powa = angular.module('salva_powa', ['angular-underscore/filters', 'schemaForm', 'pascalprecht.translate', 'ui.select', 'ui.sortable'])
.config(['$controllerProvider', '$compileProvider', '$filterProvider', '$provide', function ($controllerProvider, $compileProvider, $filterProvider, $provide) {

    // Notice that the registration methods on the
    // module are now being overridden by their provider equivalents

    salva_powa.controller = $controllerProvider.register;
    salva_powa.directive  = $compileProvider.directive;
    salva_powa.filter     = $filterProvider.register;
    salva_powa.factory    = $provide.factory;
    salva_powa.service    = $provide.service;

}])
.controller('SelectController', ['$scope', '$http', function($scope, $http){



  $scope.mechant = function(){
    return $scope.model;
  };

  $scope.schema = {

  "type": "object",
  "title": "Comment",
  "required": [
    "custom_post_type"
  ],
  // Start propertie
  "properties": {
    // custom_post_type Start

    "custom_post_type": custom_post_type(),

    "custom_taxomany": post_custom_taxomany( $scope ),

    "schema_donnee": schema_donnee()
    // custom_post_type END

  }
  // End Propertie
}

  $scope.form = [
  {
    "type": "fieldset",
    "title": "Configuration générales Wordpress",
    "items": [
      {
        "type": "tabs",

        // start Tabs
        "tabs": [
          {

            "title": "Gestion Custom Post Type",
            "items": [
              {
                "key": "custom_post_type",
                "title":"Données var",
                "type": "tabarray",
                "add": "Ajouter",
                "remove": "Supprimer",
                "style": {
                  "remove": "btn-danger"
                }
              }
            ]
          },
          {
            "title": "Gestion Custom Taxomany",
            "items": [
              {
                "key": "custom_taxomany",
                "title":"Taxomany",
                "type": "tabarray",
                "add": "Ajouter",
                "remove": "Supprimer",
                "style": {
                  "remove": "btn-danger"
                }
              }
              ]
            },
            {
              "title": "Schéma de donnée",
              "items": [
                {
                  "key": "schema_donnee",
                  "title":"Taxomany",
                  "type": "tabarray",
                  "add": "Ajouter",
                  "remove": "Supprimer",
                  "style": {
                    "remove": "btn-danger"
                  }
                }
                ]
              }

          ]
          // end Tabs
        }
        ]
      }
    ]



  $scope.model = {};

  $scope.submitted = function(form){
    $scope.$broadcast('schemaFormValidate')
    console.log($scope.model);
  };
}]);
