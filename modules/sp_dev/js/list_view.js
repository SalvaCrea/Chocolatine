$(function(){

    $('#list_view').DataTable( {
        data: sp_powa.list_view ,
        order : [[ 1, "desc" ]],
        columns: [
            { "data": "name" },
            { "data": "slug" },
            { "data": "url" },
            { "data": "call_back" },
            { "data": "show_in_menu" },
            { "data": "sub_module" }
        ]
    } );

});
