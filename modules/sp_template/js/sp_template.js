///////////////////////////////////
// Function for the content is also long that sidebar and inverse
///////////////////////////////////

manager_size_content =
{
	height_content : 0,
	start : function()
	{

		if ( $('#main_content_groovy') ) {
			$('#main_content_groovy').css( 'min-height', 'unset' );
		}
		if ( $('.sidebar') ) {
			$('.sidebar').css( 'min-height', 'unset' );
		}

		this.height_content = $('#content_groovy').height();

		if ( $('#main_content_groovy') ) {
			$('#main_content_groovy').css( 'min-height', this.height_content );
		}
		if ( $('.sidebar') ) {
			$('.sidebar').css( 'min-height', this.height_content );
		}

		setTimeout( manager_size_content.start , 500);

	}
}

$( window ).resize( manager_size_content.start );
$( window ).ready( manager_size_content.start() );
