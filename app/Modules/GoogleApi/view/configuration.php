<?php
namespace sp_framework\Modules\GoogleApi\view;


class configuration extends \sp_framework\Pattern\Module\View
{
  public function main()
  {
      $formService = \sp_framework\get_service( 'form' );

      $model = \sp_framework\get_service( 'GoogleApi@GoogleSettings' );

      $formService->generate_form( $model );
  }
}
