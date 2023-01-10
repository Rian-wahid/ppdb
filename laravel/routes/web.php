<?php
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response as FacadeResponse;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
function response_wrapper($res){
    if($res->text!=NULL){
        return new Response($res->text,$res->status_code);
    }else if($res->file!=NULL){
       return FacadeResponse::download($res->file,basename($res->file),["Content-Type : application/pdf"]);
       
    }else{
      
        return new Response((array)$res->json,$res->status_code);
    }
}
function handler(){
    return $GLOBALS["use_case_handler"];
}

Route::get("/",function(Request $request){
    
    return response_wrapper(handler()->get($request->query()));
});
Route::post("/",function (Request $request){
   
    return response_wrapper(handler()->newStudent($request->json()->all()));
});