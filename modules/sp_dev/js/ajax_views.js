
$(function(){

    $('#ajax_views').DataTable( {
        data: data_ajax_views ,
        columns: [
            { "data": "name", "title" : "name" },
            { "data": "module", "title" : "module" },
            { "data": "component", "title" : "component" },
            { "data": "call_back", "title" : "call back" },
            { "data": "role", "title" : "role" }
        ]
    } );

});
