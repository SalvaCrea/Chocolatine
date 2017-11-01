<?php
namespace sp_framework\Modules\GoogleApi\view;


class reporting extends \sp_framework\Pattern\Module\View
{
  public function get_report()
  {

    $id_views = '30257601';

    $query = new \sp_framework\Modules\GoogleApi\Tools\QueryAnalyticReport();

    $data = $query->init( $id_views )
                  ->add_date()
                  ->add_metrics( 'ga:pageValue' )
                  ->add_metrics( 'ga:pageviews' )
                  ->add_metrics( 'ga:uniquePageviews' )
                  ->add_dimensions( 'ga:pagePath' )
                  ->run();

    \sp_framework\add_block( 'content',
        $this->renderTemplate( 'GoogleApi@report.html.twig',
        array(
          'data' => $data
        ))
    );

  }
}
