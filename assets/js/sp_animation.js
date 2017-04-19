sp_load_animation = {
	create : function()
	{

		$("#adminmenumain").hide(); 

		$animation = $('<div>')
		.attr(
				{
					id    : 'animation_loader',
					class : 'uil-ring-css'
				}
		);

		$animation.append('<div>');

		$('body').append( $animation );

		return true;

	},
	delete : function()
	{
			$('#animation_loader').animate({
				opacity : 0,
			},1000,
			function()
			{
					$('#animation_loader').remove();
			});

	},
	is_present : function()
	{

			if ( $('#animation_loader').length	> 0 ) {
					return true;
			}
			else
			{
					return false;
			}

	},
	toggle : function()
	{
				if ( this.is_present() ) {
						this.create();
				}
				else
				{
					 this.delete();
				}
	},
	show : function()
	{
				if ( !this.is_present() ) {
						this.create();
				}
	},
	hide : function()
	{
				if ( this.is_present() ) {
						this.delete();
				}
	}
}

sp_load_animation.show();

$( window ).ready( function()
{

	sp_load_animation.hide();

})
