<?php
namespace PPDB\Entities;
class NewStudentValidator{
    function __construct(Object $fields){
        $this->fields=$fields->fields;
    }
    function validate(array $student):Object{
       $result=(Object)[
        "is_valid"=>TRUE,
        "error"=>"",
        "field_invalid"=>""
       ];
       foreach($this->fields as $field){
        if(!array_key_exists($field["name"],$student)){
          $result->is_valid=FALSE;
          $result->error=$field["name"] . " can't empty";
          $result->field_invalid=$field["name"];
          break;
        }
        if(gettype($student[$field["name"]])!=$field["type"]){
          $result->is_valid=FALSE;
          $result->error=$field["name"] . " must be " . $field["type"];
          $result->field_invalid=$field["name"];
          break;
        }
        if($field["min"]!=NULL){
          if(strlen($student[$field["name"]])<$field["min"]){
            $result->is_valid=FALSE;
            $result->error=$field["name"] . " harus lebih panjang atau sama dengan " . $field["min"] . "karakter";
            $result->field_invalid=$field["name"];
            break;
          
          }
        }
        if($field["max"]!=NULL){
          if(strlen($student[$field["name"]])>$field["max"]){
            $result->is_valid=FALSE;
            $result->error=$field["name"] . " harus lebih pendek atau sama dengan " . $field["max"] . "karakter";
            $result->field_invalid=$field["name"];
            break;
          }
        }
        if(array_key_exists("enum",$field)){
          if(!in_array($student[$field["name"]],$field["enum"])){
            $result->is_valid=FALSE;
            $result->error=$field["name"] . " not have option " . $student[$field["name"]];
            $result->field_invalid=$field["name"];
            break;
          }
        }
       }

          return $result;
    }
}