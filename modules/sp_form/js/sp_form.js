angular.module('sp_form', ['schemaForm'])
       .controller('sp_form_controler', function($scope) {

  $scope.schema = sp_powa.form.schema;
  $scope.form = sp_powa.form.form;
  $scope.model = sp_powa.form.model;

	$scope.send = function()
	{
			save_form = sp_ajax.new();

			save_form.args = Object.assign({}, $scope.model );
      save_form.args.name_form = $scope.schema.title;
      save_form.module =  'spform';
			save_form.action_module = 'save_form';

			response = save_form.send();

	}


});
