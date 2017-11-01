<?php
namespace sp_framework\Modules\GoogleApi\view;

/**
 * View linked for Account Param
 */

class listView extends \sp_framework\Pattern\Module\View
{
  public function listView()
  {

        $module = \sp_framework\get_module( 'GoogleApi' );
        $module->component->AnalyticsTools->connection();

        $listManagementAccounts = $module->component->AnalyticsTools->listManagementAccounts();

        $data = [];

        foreach ( $listManagementAccounts['items'] as $key => $account ) {

            $listView = $module->component->AnalyticsTools->listView( $account->data['idAccount'] );

            $current_data = $account->data;
            $current_data['items'] = $listView['items'];

            $data []= $current_data;
        }

        \sp_framework\add_block( 'content',
            $this->renderTemplate( 'GoogleApi@listView.html.twig',
            array(
              'Properties' => $data
            ))
        );
  }
  public function listProperties()
  {

        $module = \sp_framework\get_module( 'GoogleApi' );
        $module->component->AnalyticsTools->connection();

        $listProperties = $module->component->AnalyticsTools->listProperties();

        \sp_framework\add_block( 'content',
            $this->renderTemplate( 'GoogleApi@listProperties.html.twig',
            array(
              'Properties' => $listProperties['items']
            ))
        );
  }
  public function listManagementAccounts()
  {

        $module = \sp_framework\get_module( 'GoogleApi' );
        $module->component->AnalyticsTools->connection();

        $listManagementAccounts = $module->component->AnalyticsTools->listManagementAccounts();

        \sp_framework\add_block( 'content',
            $this->renderTemplate( 'GoogleApi@listManagementAccounts.html.twig',
            array(
              'Properties' => $listManagementAccounts['items']
            ))
        );
  }
}
