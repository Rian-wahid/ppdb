<?php 
namespace PPDB\Entities;
class HTMLTemplate{
    function __construct(Object $fields){
        $this->fields=$fields->fields;
    }
    function generate_form():string{
        ob_start();
        ?>
           <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
            <title>Formulir Pendaftaran</title>
        </head>
        <body class="bg-light">
        <div class="container px-4 mb-4 mt-4">
        <div class="card px-2">
            <div class="card-body">
                <h3 class="card-title text-center mb-5">Formulir Pendaftaran Peserta Didik Baru MTs MA dan Pondok Pesantren ALMUKARROM</h3>
            
           
        <form id="ppdb" action="" method="post">
            <?php  foreach($this->fields as $field){ ?>
            <?php if($field["input"]!="radio" && $field["input"]!="textarea") {?>
            <div class="mb-4">
                <label for="<?=$field["name"];?>" class="form-label"><?=$field["label"];?></label>
                <input type="<?=$field["input"];?>" autocomplete="off" <?php if($field["min"]!=NULL && $field["max"]!=NULL){?> minlength="<?=$field["min"];?>" maxlength="<?=$field["max"];?>" <?php }?> required class="form-control" id="<?=$field["name"];?>" name="<?=$field["name"];?>" aria-describedby="<?=$field["name"];?>_des">
                <div id="<?= $field["name"]?>_alert" class="form-text text-danger"></div>
                <div id="<?=$field["name"];?>_des" class="form-text"><?=$field["description"];?></div>
            </div>
            <?php }else if($field["input"]=="radio"){ ?>
                <div class="mb-4">
                    <label class="form-label"><?= $field["label"];?></label>
                <?php for($i = 0; $i<count($field["enum"]); $i++){?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" <?= ($i==0)? "required":"";?> name="<?= $field["name"];?>" id="<?= $field["name"];?>_<?= $field["enum"][$i];?>" value="<?= $field["enum"][$i];?>">
                   
                    <label class="form-check-label" for="<?= $field["name"];?>_<?= $field["enum"][$i];?>">
                       <?= $field["label_enum"][$i];?>
                    </label>
                </div>
                <?php }?>
                <div id="<?= $field["name"];?>_alert" class="form-text text-danger"></div>
                <div class="form-text"><?=$field["description"];?></div>
                </div>
                <?php }else{?>
                       <div class="mb-4">
                       <label class="form-label" for="<?= $field["name"]; ?>"><?= $field["label"];?></label>
                       <textarea class="form-control" required form="ppdb" id="<?= $field["name"]; ?>" name="<?= $field["name"]; ?>" style="height: 100px"  <?php if($field["min"]!=NULL && $field["max"]!=NULL){?> minlength="<?=$field["min"];?>" maxlength="<?=$field["max"];?>" <?php }?>></textarea>
                       <div id="<?= $field["name"]?>_alert" class="form-text text-danger"></div>
                       <div class="form-text"><?=$field["description"];?></div>
                      
                       </div>
                    <?php } ?>
           <?php } ?>

           <button class="btn btn-primary mt-2" type="submit">Kirim</button>
                </form>
                </div>
        </div>
        </div>
                    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content pb-2 px-2">
                <div class="modal-header">
                    
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   
                </div>
                   
                    <div class="modal-body text-center">
                        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Test</h1>
                    </div>
                <div class="modall-footer">
                <a href="#" class="btn btn-primary download-pdf">download pdf</a>
                </div>
                </div>
            </div>
            </div>
            

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
            <script>
                let modal = document.querySelector("#exampleModalToggle")
                modal = new bootstrap.Modal(modal, {});
                const modalTitle = document.querySelector(".modal-title")
                const btnDownloadPdf = document.querySelector(".download-pdf")
                document.querySelector("#ppdb").addEventListener("submit",(e)=>{
                    e.preventDefault()
                    let data ={}
                    let formData = new FormData(e.target)
                    <?php foreach($this->fields as $field){?>
                        data["<?= $field["name"];?>"] =  formData.get("<?= $field["name"];?>")
                    <?php }?>
                    const json = JSON.stringify(data)
                    
                    fetch(window.location.href,{
                        method:"POST",
                        headers:{
                            "'Content-Type":"application/json",
                            "Content-Length":json.length
                        },
                        body:json
                    }).then(response=>{
                        if(response.status<499){
                            response.json().then(res=>{
                                if(res.status=="fail"){
                                    document.getElementById(res.data.field_invalid+"_alert").innerText=res.message
                                    document.location.href="#"+res.data.field_invalid+"_alert"
                                }
                                if(res.status == "success"){
                                    modalTitle.innerText="Berhasil terkirim"

                                    btnDownloadPdf.href=res.data.file
                                    modal.show()
                                }
                            })
                        }
                    })
                })
            </script>
        </body>
        </html> 

   <?php 
        return ob_get_clean();
   }

    function render(array $data):string { 
        ob_start();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <style>
                body{
                    font-family:sans-serif;
                }
                tr {
                   margin-top:12px;
                   margin-bottom:12px;
                   padding:12px;
                }
              table{
                font-size:16px;
                border-collapse:collapse;
                width:100%;
                margin-top:15px;
              }
              h3{
                text-align:center;
                margin-top:20px;
                margin-bottom:20px;
              }
            </style>
        </head>
        <body>
            <h3>Formulir Pendaftaran Peserta Didik Baru MTs MA dan Pondok Pesantren ALMUKARROM</h3>
            <hr/>
            <table style="">
               <?php 
               $i=0;
               foreach($this->fields as $field){ 
                 
                    $value = (array_key_exists("enum",$field))? $field["label_enum"][array_search($data[$field["name"]],$field["enum"])]:$data[$field["name"]];
                ?>
                    <tr <?php if($i%2 == 1){?> style="background:#efefef;" <?php }?>>
                        <td style="vertical-align: top; margin-left:12px; margin-right;40px;" ><?= $field["label"];?></td>
                        <td style="vertical-align: top;" >:</td>
                       
                        <td style="vertical-align: top;"><?= $value; ?></td>
                    </tr>
                <?php
                $i++;
             }?>
               </table>
        </body>
        </html>

<?php return ob_get_clean();

   }
}
 ?>