<?php

return [

  "home" => [
    "route" => "/",
    "view"  => "Home/back_main"
  ],

  /**
   * Analaytics Route
   */

  // Account Datas
  "analyticListView" => [
    "route" => "/analytic/analyticListView",
    "view"  => "GoogleApi@listView",
    "method" => 'listView'
  ],

  "analyticListProperties" => [
    "route" => "/analytic/analyticListProperties",
    "view"  => "GoogleApi@listView",
    "method" => 'listProperties'
  ],

  "analyticListManagementAccounts" => [
    "route" => "/analytic/analyticListManagementAccounts",
    "view"  => "GoogleApi@listView",
    "method" => 'listManagementAccounts'
  ],

  // Reporting Data

  "analyticGetReport" => [
    "route" => "/analytic/analyticGetReport",
    "view"  => "GoogleApi@reporting",
    "method" => 'get_report'
  ],

  // Reporting Data

  "analyticConfiguration" => [
    "route" => "/analytic/configuration",
    "view"  => "GoogleApi@configuration"
  ],

  // Redirect
  "redirect_analytic" => [
    "route" => "/google_api_redirect",
    "view"  => "GoogleApi@connection"
  ],



  /**
   * Other Routes
   */

  "update_database" => [
    "route" => "/admin/database_generator",
    "view"  => "ModelTool@main",
    "menu_name" => "admin"
  ]

];
