var ajax_controller  =
{
    // url du controller php
    ajax_url : ajaxurl,
    // les arguments du controller
    args : new Object(),
    // nom de l'action pour wordpress
    action : 'ajax_controller',
    // action pour le controller php
    action_ajax : '',
    // le retour généré par le php
    content_return  : new Array(),

    send_with_ajax : function()
    {
      func = this;

      $.ajax({
  	       url : ajaxurl,
  	       type : 'POST',
           async  : false,
  	       dataType : 'json',
  	       data : { "args" : this.args, "action" : this.action , "action_ajax" : this.action_ajax },
  	       success : function(msg)
  	       {
             	console.log('reussi');
  	          func.content_return = msg;

  	       },
  	       error : function(xhr, ajaxOptions, thrownError)
  	       {
              console.log('error denvoie');
              console.log(xhr);
              func.content_return = xhr;
  	       }
  	    });

        return func.content_return;

    }


}
