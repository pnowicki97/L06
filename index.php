<?php

require 'Routing.php';


$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Routing::get('main', 'MainController');
Routing::post('main', 'MainController');
Routing::get('desktopUserPage', 'DesktopUserPageController');
Routing::post('desktopUserPage', 'DesktopUserPageController');
Routing::get('desktopGroupPage', 'DesktopGroupPageController');
Routing::post('desktopGroupPage', 'DesktopGroupPageController');
Routing::post('desktopAddExpanse', 'DesktopGroupPageController');
Routing::post('addExpanse', 'DesktopGroupPageController');
Routing::post('addGroup', 'DesktopUserPageController');
Routing::post('desktopAddGroup', 'DesktopUserPageController');
Routing::run($path);
