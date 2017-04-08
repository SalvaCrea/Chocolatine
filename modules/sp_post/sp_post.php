<?php

use \salva_powa\sp_module;

class sp_post extends sp_module
{
		/**
		 *  The Id current for search
		 * @var int
		 */
		var $id_post = null;
		/**
		 * The types post for the query
		 * @var array
		 */
		var $post_type = array();
		/**
		 *  The default Table For search
		 * @var array
		 */
		var $default_table = array(
			'post' => 'demande',
			'meta' => 'demande_meta'
		);
		/**
		 * The limite of search
		 * @var int
		 */
		var $limit = 50;
		/**
		 *  Number of post to displace or pass ove
		 * @var integer
		 */
		var $offset = 0;
		/**
		 * The condition sql
		 * @var array
		 */
		var $where = array();
		/**
		 * The result return of bdd
		 * @var array
		 */
		var $results = array();
    function __construct()
    {

        $this->icon = 'fa-home';
				$this->name = 'sp_post';
				$this->description = "With me, you search personnal post and meta";

				// $this->show_in_menu = true;

    }
		function view_back()
		{
				$this->core = sp_core();

				return "je suis un petit moteur de recherche";
		}
		/**
		 * This function search the personnal post
		 * @param  [int] $id The Id current for search
		 * @return [type]     [description]
		 */
		function find_one( $id = null )
		{

				$where = array();
				// verify if the id is null or not
				if ( !is_null( $id ) )
				{
						$this->id_post = $id;
						$this->where['AND'][ 'id_demande' ] = $this->id_post;
				}

				return $this;
		}
		function type( $type = '' )
		{
				if ( !empty( $type ) ) {

						if ( is_string( $type ) ) {

							$this->post_type []= $type;

						}
						else if( is_array( $type ) ){
								$this->post_type += $type;
						}

						$this->where['AND'][ 'type_demande' ] = $this->post_type;
				}

				return $this;
		}
		/**
		 * The offset for the query
		 * @param int $offset the numbe of the offet
		 */
		function offset( $offset )
		{
				if ( !empty( $offset ) ) {

								$this->offset = $offset;

				}
				return $this;
		}
		function find()
		{

			$this->where['LIMIT'] =  [

				$this->limit * $this->offset,
				$this->limit * ( $this->offset + 1 )

			];

				$this->where['ORDER'] = array( 'id_demande' => "DESC" );

				$this->results = $this->core->db->select(

				$this->default_table[ 'post' ],

				"*",

				$this->where

			);

			$this->get_meta();

			return $this->results;

		}
		function get_meta()
		{

			$this->core = sp_core();

			foreach ( $this->results as $key => $result) {

					$metas =	 $this->core->db->select(

									$this->default_table[ 'meta' ],

									['id_meta', 'meta_key', 'meta_value'],

									[ 'id_demande' => $result['id_demande'] ]

						);


						$this->results[$key] += $this->clean_meta( $metas );

			}

		}
		function clean_meta( $metas )
		{

			$clean_meta = array();

			foreach ( $metas as $key => $meta ) {

					// convert in array of the db is multi
					if ( isset( $clean_meta[ $meta['meta_key'] ] ) ):

							if ( is_array( $clean_meta[ $meta['meta_key'] ] ) ):
									$clean_meta[ $meta['meta_key'] ] []= $meta['meta_value'];

							// incremente the first array
							else:
									$clean_meta[ $meta['meta_key'] ] = [ $meta['meta_value'] ];

							endif;

					else:
					$clean_meta[ $meta['meta_key'] ] = $meta['meta_value'];

					endif;

			}

			return $clean_meta;

		}
		/**
		 * [limit description]
		 * @param  int the limit current
		 * @return object   $this
		 */
		function limit( $limit )
		{
			$this->limit = $limit;

			return $this;
		}

}
