<?php
namespace sp_framework\Modules\GoogleApi\component;

class AnalyticsTools extends \sp_framework\Pattern\Module\Component
{
  public function __construct(){

  }
<<<<<<< HEAD
  public function connection(){

    $module = \sp_framework\get_module( 'GoogleApi' );
    $this->client_google = $module->component->Connection->connection();
    
    return $this->ServiceAnalytics = new \Google_Service_Analytics( $this->client_google );

  }
  /**
   * Function list Accounts
   * @return object Data Informations Account
   */
  public function listManagementAccounts(){

        $accounts = $this->ServiceAnalytics->management_accounts->listManagementAccounts();

        $data = [
            "itemsPerPage" => $accounts->itemsPerPage,
            "startIndex"   => $accounts->startIndex,
            "totalResults" => $accounts->totalResults,
            "items"         => array()
        ];

        foreach ($accounts->getItems() as $account) {

            $model = \sp_framework\get_model( 'GoogleApi@AnalyticAccounts', true );

            $item = [
              "idAccount" => $account->getId(),
              "name"      => $account->getName(),
              "created"   => $account->getCreated(),
              "updated"   => $account->getUpdated()
            ];

            $model->set_data( $item );

            $data['items'] []= $model;
        }

        return $data;
  }
  /**
   * List all  List Properties
   * @param  string $idAccount The id of account
   * @return array            data of properties google
   */
  public function listProperties( $idAccount = '~all' ){

    $properties = $this->ServiceAnalytics->management_webproperties
      ->listManagementWebproperties( $idAccount );

      $data = [
          "itemsPerPage" => $properties->itemsPerPage,
          "startIndex"   => $properties->startIndex,
          "totalResults" => $properties->totalResults,
          "items"         => array()
      ];

      foreach ( $properties->getItems() as $property ) {

          $model = \sp_framework\get_model( 'GoogleApi@AnalyticProperties', true );

          $item = [
            "idProperty" => $property->getId(),
            "accountId"  => $property->getAccountId(),
            "name"       => $property->getName(),
            "url"        => $property->getWebsiteUrl(),
            "created"    => $property->getCreated(),
            "updated"    => $property->getUpdated()
          ];

          $model->set_data( $item );

          $data['items'] []= $model;
      }

      return $data;
  }
/**
 * List Views Google Analytics
 * @param  string $accountId     The Account Id
 * @param  string $webPropertyId Web property ID for the views (profiles) to retrieve
 * @return array                data of properties View
 */
  public function listView( $accountId ,$webPropertyId = '~all' ){

    $views = $this->ServiceAnalytics->management_profiles
      ->listManagementProfiles( $accountId, $webPropertyId );

      $data = [
          "itemsPerPage" => $views->itemsPerPage,
          "startIndex"   => $views->startIndex,
          "totalResults" => $views->totalResults,
          "items"         => array()
      ];

      foreach ( $views->getItems() as $view ) {

          $item                 = [
            "idView"            => $view->getId(),
            "PropertyId"        => $view->getWebPropertyId(),
            "accountId"         => $view->getAccountId(),
            "name"              => $view->getName(),
            "type"              => $view->getType(),
            "defaultPage"       => $view->getDefaultPage(),
            "created"           => $view->getCreated(),
            "exclude"           => $view->getExcludeQueryParameters(),
            "currency"          => $view->getCurrency(),
            "timezone"          => $view->getTimezone(),
            "ecommerceTracking" => $view->getECommerceTracking(),
            "enhancedeCommerce" => $view->getEnhancedECommerceTracking(),
            "exclude"           => $view->getExcludeQueryParameters()
          ];

          $model = \sp_framework\get_model( 'GoogleApi@AnalyticViews', true );
          $model->set_data( $item );

          $data['items'] []= $model;
      }

    return $data;
=======
  function test( $analytics ){

    // Replace with your view ID, for example XXXX.
    $VIEW_ID = "<REPLACE_WITH_VIEW_ID>";

    // Create the DateRange object.
    $dateRange = new Google_Service_AnalyticsReporting_DateRange();
    $dateRange->setStartDate("7daysAgo");
    $dateRange->setEndDate("today");

    // Create the Metrics object.
    $sessions = new Google_Service_AnalyticsReporting_Metric();
    $sessions->setExpression("ga:sessions");
    $sessions->setAlias("sessions");

    // Create the ReportRequest object.
    $request = new Google_Service_AnalyticsReporting_ReportRequest();
    $request->setViewId($VIEW_ID);
    $request->setDateRanges($dateRange);
    $request->setMetrics(array($sessions));

    $body = new Google_Service_AnalyticsReporting_GetReportsRequest();
    $body->setReportRequests( array( $request) );
    return $analytics->reports->batchGet( $body );

    \sp_framework\dump( $items );
>>>>>>> master
  }
}
