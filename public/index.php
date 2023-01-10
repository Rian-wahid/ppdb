<?php
require_once __DIR__ . "/../vendor/autoload.php";

use PPDB\AppBuilder;
function init(){
    $app = AppBuilder::build((Object)[
        "pdf_dir"=>realpath(__DIR__ . "/../pdf")
    ]);
    
    $app->laravel->handle_request();

}
init();


