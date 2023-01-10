<?php
namespace PPDB\Interface;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));


if (file_exists($maintenance = __DIR__.'/../../laravel/storage/framework/maintenance.php')) {
    require $maintenance;
}

require __DIR__.'/../../laravel/vendor/autoload.php';

class LaravelRouteAdapter{

    function __construct(Object $handler){
      $GLOBALS["use_case_handler"] = $handler;
    }
    function  handle_request(){
        $app = require_once __DIR__.'/../../laravel/bootstrap/app.php';
        $kernel = $app->make(Kernel::class);
        $response = $kernel->handle(
            $request = Request::capture()
        )->send();
        $kernel->terminate($request, $response);

    }
  
 
}

