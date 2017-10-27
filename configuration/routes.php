<?php

return [
  "home" => [
    "route" => "/",
    "view"  => "Home/back_main"
  ],
  "admin" => [
    "route" => "/admin/{test}",
    "view"  => "Home/back_main",
    "method" => 'admin'
  ],
  "analytic" => [
    "route" => "/analytic",
    "view"  => "Home/back_main",
  ],
  "redirect_analytic" => [
    "route" => "/google_api_redirect",
    "view"  => "GoogleAnalytic/main",
    "method" => 'connect'
  ]
];
