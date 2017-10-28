<?php

return [

  "home" => [
    "route" => "/",
    "view"  => "Home/back_main"
  ],

  "analytic" => [
    "route" => "/analytic",
    "view"  => "GoogleApi/main",
    "method" => 'list'
  ],
  "redirect_analytic" => [
    "route" => "/google_api_redirect",
    "view"  => "GoogleApi/connection"
  ],

  "admin" => [
    "route" => "/admin/database_generator",
    "view"  => "ModelTool/main"
  ]

];
