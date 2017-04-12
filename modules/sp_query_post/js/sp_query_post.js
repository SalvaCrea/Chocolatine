sp_query_post = sp_ajax.new();

sp_query_post.find = function( $args )
{

		this.module = sp_powa.current_module.slug;
		this.args = $args;
		this.sub_module = "find_post_wp_post";
		response = this.send();
		console.log( response );
}
