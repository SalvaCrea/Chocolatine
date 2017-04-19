function convert_for_datable( args )
{
    response = new Array();

    for ( client in args) {
      response.push( args[client] );
    }
    return response;
}

$(function(){

    $('#list_client_sellsy').DataTable( {
        data:  convert_for_datable( sp_powa.client.result ),
        order : [[ 1, "desc" ]],
        columns: [
            { "data": "id" },
            { "data": "email" },
            { "data": "name" }
        ]
    } );

});
