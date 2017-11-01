<?php

namespace sp_framework\Managers;

use sp_framework\Pattern\Manager;

class ManagerBlock extends Manager
{
  public $name = 'block';
  /**
   * Add block
   * @param array $args
   */
  public function add_block( \sp_framework\Pattern\Container\Block $block )
  {
      $this->container[] = $block;
  }
  /**
   * Return list of block
   * @param  string $block_name Find block by name
   * @return mixed             Array list of block or false if empty
   */
  public function find_block_by_name( $block_name ){

        $blocks = array();

        foreach ( $this->container as $block ) {
            if ( $block->block_name == $block_name ) {
                $blocks []= $block;
            }
        }

        if ( !empty( $blocks ) ) {
          return $blocks;
        }
        return false;
  }

}
