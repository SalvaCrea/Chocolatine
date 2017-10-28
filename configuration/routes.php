<?php

return [
  "home" => [
    "route" => "/",
    "view"  => "Home/back_main"
  ],

  "analytic" => [
    "route" => "/analytic",
    "view"  => "Home/back_main",
  ],
  "redirect_analytic" => [
    "route" => "/google_api_redirect",
    "view"  => "GoogleAnalytic/main",
    "method" => 'connect'
  ],

  "admin" => [
    "route" => "/admin/database_generator",
    "view"  => "ModelTool/main"
  ]

];
