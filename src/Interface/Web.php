<?php
namespace PPDB\Interface;
class Web {
    function __construct(Object $handler){
        $this->handler = $handler;
    }
    function handle_request(){
        $res = NULL;
        if($_SERVER["REQUEST_METHOD"]==="POST"){
            $res = $this->handler->newStudent(json_decode(file_get_contents("php://input"),TRUE));
        }else{ 
            $res= $this->handler->get($_GET);
        } 
        if($res->text!=NULL){
            http_response_code($res->status_code);
            echo $res->text;
        }else if($res->file!=NULL){
            http_response_code($res->status_code);
            header("Pragma : public");
            header("Content-Control : public");
            header("Content-Type : application/octet-stream");
            header("Content-Description : File transfer");
            header("Content-Disposition : attachment; filename=\"".basename($res->file)  . "\"");
            header("Content-Length :".filesize( $res->file));
           
            readfile($res->file);
        }else{
            http_response_code($res->status_code);
            header("Content-Type : application/json");
            header("Access-Control-Allow-Origin : *");
            echo json_encode($res->json);
        }
    }
}