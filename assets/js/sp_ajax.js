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
		action_module : '',
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
					 	 "action_module" : this.action_module
					 },
  	       success : function(msg)
  	       {
              console.log( msg );
  	          func.content_return = msg;
  	       },
  	       error : function(xhr, ajaxOptions, thrownError)
  	       {
              console.log('error');
              console.log(xhr);

              func.content_return = xhr;
  	       }
  	    });

				sp_load_animation.hide();

        return func.content_return;

    },
		new : function()
		{
			return Object.assign({}, this);
		}


}
