<?php
namespace PPDB;
use Dompdf\Dompdf;
use PPDB\UseCase\PPDBFormUseCase;
use PPDB\Entities\HTMLTemplate;
use PPDB\Repository\PdfRepositoryFile;
use PPDB\Entities\NewStudentValidator;
use PPDB\Entities\Fields;
use PPDB\Interface\Web;
use PPDB\Interface\LaravelRouteAdapter;
class AppBuilder{
    static function build(Object $config){
        $fields=new Fields();
        $pdf_repo = new PdfRepositoryFile( new Dompdf(),$config->pdf_dir);
        $html_template =new HTMLTemplate($fields);
        $new_student_validator = new NewStudentValidator($fields);
        $handler = new PPDBFormUseCase($html_template,$pdf_repo,$new_student_validator);
        $web = new Web($handler);
        $laravel = new LaravelRouteAdapter($handler);
        return (object)[
            "web"=>$web,
            "laravel"=>$laravel,
        ];
    } 
    
}