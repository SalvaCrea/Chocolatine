/**
 * Convert plans Stripe in centime in no centime
 * @param  array plans stripe
 * @return array plans stripe convertie
 */
function convert_amount( args )
{
    args.forEach(function(element, index, array) {
        element.amount  = element.amount / 100;
    });

    args.sort(function (a, b) {
      return a.amount - b.amount;
    });

    return args;
}


$(function(){

    $('#list_plans_stripe').DataTable( {
        data: convert_amount( sp_powa.stripe_plans ),
        order : [[ 1, "desc" ]],
        columns: [
            { "data": "id" },
            { "data": "amount" },
            { "data": "name" }
        ]
    } );

});


$(function(){

    $('#list_plans_subscription').DataTable( {
        data: sp_powa.stripe_subscription,
        columns: [
            { "data": "customer" },
            { "data": "plan.name" },
            { "data": "email" }
        ] 
    } );

});
