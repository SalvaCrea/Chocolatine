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

sp_template_menu_left = {
		menu_width : 0,
		container_width : 0 ,
		start : function()
		{
				this.menu_width = $('#sp_menu_left').outerWidth();
				this.container_width = $('#groovy_template').width();

				$('#menu_left_exist').css({
					'width': this.container_width - this.menu_width,
					'marginLeft' : this.menu_width
				});

				$('#sp_menu_left').css('min-height', $( window ).height() );

		}
}

if ( $('#menu_left_exist').length > 0 ) {
	$( window ).resize( sp_template_menu_left.start );
	$( window ).ready( sp_template_menu_left.start );
}
