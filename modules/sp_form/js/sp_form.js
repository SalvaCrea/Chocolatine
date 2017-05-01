sp_form =  Object.assign(
  {},
  sp_ajax.new(
    'sp_form',
    'save_form'
  ),
  {

      schema : sp_powa.form.schema,
      model : sp_powa.form.model,
      form : sp_powa.form.form,
      $scope : new Object(),
      success : function()
      {
          toastr.info('Votre action à bien été effectuée');
      },
      error : function( xhr )
      {
          console.log( xhr );
          toastr.error('Il y a eu une error');
      },
      ang_controller : function( $scope )
      {

          sp_form.scope = $scope;
          $scope.schema = sp_form.schema;
          $scope.form = sp_form.form;
          $scope.model = sp_form.model;

          $scope.submitForm = function( ngform,modelData )
          {
              sp_form.before_send();
          }

      },
      before_send : function()
      {

        this.args = Object.assign({}, this.scope.model );
        this.args.name_form = this.scope.schema.title;

        this.args.module = this.scope.schema.module;
        this.args.sub_module = this.scope.schema.sub_module;

        response = this.send();

      }
  }

);

app_sp_powa.controller('sp_form_controler', sp_form.ang_controller );
