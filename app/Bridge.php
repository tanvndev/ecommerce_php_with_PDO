<?php
//session init;
require_once './utils/session.php';
Session::init();

require_once './app/core/App.php';
require_once './app/core/Controller.php';
require_once './app/core/DB.php';
require_once './app/core/ViewShare.php';


//middleware
require_once './middlewares/Authenticate.php';
require_once './middlewares/JWT.php';
//viewShare
require_once './app/core/ServiceProvider.php';
$serviceProvider = new ServiceProvider();

require_once './utils/services.php';
require_once './utils/format.php';
require_once './utils/CRUD.php';
require_once './utils/sweetAleart.php';
require_once './utils/cookie.php';
