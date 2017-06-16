Sender_mail = sp_ajax.new( sp_powa.current_module.slug, "send_request_mail" );
Sender_mail.args.ID = data_request.ID;

Sender_mail.success = function(){
  toastr.info('Le mail à bien été envoyé');
}
$('#resend_mail').on( 'click', function()
{
    Sender_mail.send();
})
