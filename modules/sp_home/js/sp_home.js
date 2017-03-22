/**
 * This function close the left menu in the wp_menu
 */
function close_wp_menu()
{
	console.log('1');
	if ( !$('body').hasClass('folded') ) {
			console.log('2');
			$('#collapse-button').trigger('click');
	}

}

$( window ).ready(
	function()
	{
			close_wp_menu();
	}
)
