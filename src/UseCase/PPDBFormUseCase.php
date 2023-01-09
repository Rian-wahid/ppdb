<?php
namespace PPDB\UseCase;
class PPDBFormUseCase {
    
    function __construct(Object $template,Object $html_to_pdf,Object  $validator){
        $this->template = $template;
        $this->pdf_repository = $html_to_pdf;
        $this->validator = $validator;
        
    }
    function newStudent(array $student): Object{
        $valid = $this->validator->validate($student);
        $response = $this->default_response();
        if(!$valid->is_valid){
            $response->status_code=400;
            $response->json->status="fail";
            $response->json->message=$valid->error;
            $response->json->data=(Object)[
                "field_invalid "=>$valid->field_invalid
            ];
            return $response;
        }
        
          
        $html=$this->template->render($student);
          
        $file_path=$this->pdf_repository->save_pdf($html,$student["pendaftaran"],$student["nama_lengkap"] );
        $response->json->message="dokumen pendaftaraan berhasil dibuat";
        $response->json->data=(Object) [
            "file"=>"?pdf=" . bin2hex($file_path)
        ];
        return  $response;
    
    }
    
    function get(array $get):Object{
        if(array_key_exists("pdf",$get)){
            return $this->downloadPdf($get["pdf"]);
        }
        $response = $this->default_response();
        $response->text = $this->template->generate_form();
        return $response;
    }

    function downloadPdf(string $hex_path){
        $response= $this->default_response();
        $path =  hex2bin($hex_path);
        if(file_exists($this->pdf_repository->target_dir . "/". $path)){
            $response->file=$this->pdf_repository->target_dir . "/". $path;
        }else{
            $response->status_code=404;
            $response->json->status="fail";
            $response->json->message="file not found";
        }
        return $response;
    }

    private function default_response():Object{
        $response = (Object) [
            "status_code"=>200,
            "json"=>  (Object)[
                "status"=>"success",
                "message"=>""
            ],
            "text"=>NULL,
            "file"=>NULL
        ];
        
        return $response;
    }
}