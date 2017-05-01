
$(function(){

    $('#ajax_views').DataTable( {
        data: data_ajax_views ,
        columns: [
            { "data": "name", "title" : "name" },
            { "data": "module", "title" : "module" },
            { "data": "sub_module", "title" : "sub_module" },
            { "data": "call_back", "title" : "call back" },
            { "data": "role", "title" : "role" }
        ]
    } );

});
