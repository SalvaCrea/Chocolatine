angular.module('sp_taxomamy_manager', ['schemaForm'])
       .controller('FormController', function($scope) {

  $scope.schema = {
  "type": "object",
  "title": "Comment",
  "properties": {
    "sp-taxomany-manager": {
      "type": "array",
      "items": {
        "type": "object",
        "properties": {
          "name": {
            "title": "Name",
            "type": "string"
          },
					"hierarchical": {
						"title": "Hierarchical",
			      "type": "boolean"
			    },
					"rewrite": {
            "title": "Rewrite",
            "type": "string"
          }
        },
        "required": [
          "name"
        ]
      }
    }
  }
};

	$scope.send = function()
	{
			save = sp_ajax_controller;

			save.args = $scope.model;

			save.action_ajax = 'update-sp';

			save.send();

			console.log( save.content_return );
	}

  $scope.form = [

  {
    "key": "sp-taxomany-manager",
    "type": "tabarray",
    "add": "New Taxomany",
    "remove": "Delete Taxomany",
    "style": {
      "remove": "btn-danger"
    },
    "title": "{{ value.name || 'Tab '+$index }}",
    "items": [
      "sp-taxomany-manager[].name",
      "sp-taxomany-manager[].hierarchical",
			"sp-taxomany-manager[].rewrite"
    ]
  }
];

  $scope.model = JSON.parse( $('#model').val() );
});
