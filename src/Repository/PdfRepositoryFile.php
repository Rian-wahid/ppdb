<?php
namespace PPDB\Repository;
class PdfRepositoryFile{
    function  __construct(Object $dompdf,string $target_dir) {
        $this->dompdf = $dompdf;
        $this->dompdf->setPaper("A4","potrait");
        $this->target_dir = $target_dir;
    }
    function save_pdf(string $html,string $sub_dir,string $target_filename):string{
   
    $this->dompdf->loadHtml($html);
    $this->dompdf->render();
    $result_path = $sub_dir . "/" .  $target_filename . $this->gen_new_name($sub_dir,$target_filename) .".pdf";
    file_put_contents($this->target_dir . "/" . $result_path,$this->dompdf->output());
    return $result_path;
    }

    private function gen_new_name(string $sub_dir,string $filename):string{
        $result = "";
        $i=0;
        while(file_exists($this->target_dir . "/" . $sub_dir ."/" . $filename . $result . ".pdf")){
            $i++;
            $result = "_" . $i;
        }

        return $result;

    }
}


