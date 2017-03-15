angular.module('sp_taxomamy_manager', ['schemaForm'])
       .controller('FormController', function($scope) {
				 
  $scope.schema = {
  "type": "object",
  "title": "Comment",
  "properties": {
    "sp_taxomany": {
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
          "name",
          "email",
          "comment"
        ]
      }
    }
  }
};

  $scope.form = [

  {
    "key": "sp_taxomany",
    "type": "tabarray",
    "add": "New Taxomany",
    "remove": "Delete Taxomany",
    "style": {
      "remove": "btn-danger"
    },
    "title": "{{ value.name || 'Tab '+$index }}",
    "items": [
      "sp_taxomany[].name",
      "sp_taxomany[].hierarchical",
			"sp_taxomany[].rewrite"
    ]
  },
  {
    "type": "submit",
    "style": "btn-success",
    "title": "Save"
  }
];

  $scope.model = {};
});
