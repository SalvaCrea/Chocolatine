sp_query_post =  Object.assign(
  {},
  sp_ajax.new(
    'sp_wp_post',
    'find_post_wp_post'
  ),
	{
			args : {
				post_type : new Array()
			}
	}
);
/**
 * [This function execute the request ajax]
 * @return {[Object Array]}       [Return the resultat of wp query]
 */
sp_query_post.find = function()
{
		return response = this.send();
}
/**
 * [description]
 * @param  {[type]} id_post [description]
 * @return {[type]}         [description]
 */
sp_query_post.find_by_id_author = function( id_post )
{
		this.args.author = id_post;
		return this;
}
/**
 * [This function add the post type for the wp query]
 * @param  {[string || array ]} post_type [description]
 * @return {[type]}           [description]
 */
sp_query_post.find_by_post_type = function( post_type )
{
		this.concat_or_push( this.args.post_type, post_type );
		return this;
}
/**
 * [This function concat of push a string or array for the wp query ]
 * @param  {[ array ]} post_type [description]
 * @param  {[string || array ]} post_type [description]
 * @return {[type]}           [description]
 */
sp_query_post.concat_or_push = function( element, argument )
{
	if ( $.isArray( argument ) ) {
			element.concat( argument );
	}
	if ( typeof argument == "string" ) {
			element.push( argument );
	}
}
