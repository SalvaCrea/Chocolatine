sp_client_sellsy = sp_ajax.new( sp_powa.current_module.slug, "find_user_sellsy_by_mail" );
sp_client_sellsy.args.email = '';
sp_client_sellsy.clients = new Array();
sp_client_sellsy.client = new Object();

$(function(){

sp_form.success = function( args )
{
    document.location.href = sp_powa.current_module.url;
}

});

/**
 * The system if auto complete for find the good mail
 */
$(function(){

    $( "#email_user" ).autocomplete({

      minLength: 1,
      delay : 1000,
      source : function( request, response ) {

        sp_client_sellsy.args.email = $( "#email_user" ).val();
        sp_client_sellsy.clients = sp_client_sellsy.send();

        sp_client_sellsy.clients = sp_client_sellsy.clients.data;

        for (var item in  sp_client_sellsy.clients ) {

            sp_client_sellsy.clients[item].value = sp_client_sellsy.clients[item].email;
            sp_client_sellsy.clients[item].label = sp_client_sellsy.clients[item].name + " - " + sp_client_sellsy.clients[item].email;

        }

        response( sp_client_sellsy.clients );

      },
      select: function( event, ui ) {

        sp_client_sellsy.client = ui.item;
        $('#name').val( ui.item.name ).trigger('input');

      },
      _renderItem: function( ul, item ) {
              return $( "<li>" )
          .attr( "data-value", item.value )
          .append( item.label )
          .appendTo( ul );
      }

    })

});
