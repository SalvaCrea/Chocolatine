<?php
namespace sp_framework\Modules\GoogleApi\component;

class AnalyticsTools extends \sp_framework\Pattern\Module\Component
{
  public function __construct(){

  }
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
  }
}
