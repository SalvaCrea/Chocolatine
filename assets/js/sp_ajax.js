var sp_ajax  =
{
    // url du controller php
    ajax_url : ajaxurl,
    // les arguments du controller
    args : new Object(),
    // nom de l'action pour wordpress
    wp_action : 'sp_ajax_controller',
    // action pour le controller php
    module : '',
		// action pour le controller php
		sub_module : '',
    // le retour généré par le php
    content_return  : new Array(),

    send : function()
    {

			sp_load_animation.show();

      func = this;

      $.ajax({
  	       url : ajaxurl,
  	       type : 'POST',
           async  : false,
  	       dataType : 'json',
  	       data : {
						 "args" : this.args,
						 "action" : this.wp_action ,
						 "module" : this.module,
					 	 "sub_module" : this.sub_module
					 },
  	       success : function( msg )
  	       {
              console.log( msg );
  	          func.content_return = msg;
              func.success( msg );

  	       },
  	       error : function(xhr, ajaxOptions, thrownError)
  	       {
              console.log('error');
              console.log(xhr);
              func.content_return = xhr;
              func.error( xhr );
  	       }
  	    });

				sp_load_animation.hide();

        return func.content_return;

    },
    success : function()
    {
        return false;
    },
    error : function()
    {
        return false;
    },
		new : function( module = '', action = '')
		{
      new_ajax_tools = Object.assign({}, this);

      if ( module != '' && action != '') {
          new_ajax_tools.module = module;
          new_ajax_tools.sub_module = action;
      }

			return new_ajax_tools;
		}


}
