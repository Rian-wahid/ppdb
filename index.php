<?php
require_once __DIR__ . "/vendor/autoload.php";

use PPDB\AppBuilder;
function init(){
    $app = AppBuilder::build((Object)[
        "pdf_dir"=>__DIR__ . "/pdf"
    ]);
    
    $app->web->handle_request();

}
init();


