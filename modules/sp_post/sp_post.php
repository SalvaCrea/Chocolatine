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
		 * The type post
		 * @var string
		 */
		var $type_post = '';
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
				$this->show_in_menu = true;

    }
		function view_back()
		{
				$sp_core = sp_core();

				return "je suis un petit moteur de recherche";
		}
		/**
		 * This function search the personnal post
		 * @param  [int] $id The Id current for search
		 * @return [type]     [description]
		 */
		function select( $id = null )
		{

				$where = array();
				// verify if the id is null or not
				if ( !is_null( $id ) )
				{
						$this->id_post = $id;
				}

				return $this;
		}
		function type( $type = '' )
		{
				if ( $type != '') {
						$this->type_post = $type;
						$this->where['AND'][ 'type_demande' ] = $type;
				}

				return $this;
		}
		function find()
		{

			$sp_core = sp_core();

			$this->where['LIMIT'] =  [

				$this->limit * $this->offset,
				$this->limit * ( $this->offset + 1 )

			];

			$this->results = $sp_core->data->select(

				$this->default_table[ 'post' ],

				"*",

				$this->where

			);

			$this->get_meta();

			return $this->results;

		}
		function get_meta()
		{

			$sp_core = sp_core();

			foreach ( $this->results as $key => $result) {

					$metas =	 $sp_core->data->select(

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

					// convert in array of the data is multi
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

}
