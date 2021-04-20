<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Traits\ResponseTraits;
class SearchController extends Controller
{
    use ResponseTraits;
    public function Search(Request $request){

    try {
  
        $json = json_decode(file_get_contents('https://run.mocky.io/v3/0d6aab31-bb68-4d89-acc5-bc4148a3cff3'), true);

        $data= $json['data'];
        $name=$request->hotel;
        $city=$request->city;
        $min_price=$request->min_price;
        $max_price= $request->max_price;

 
        
        $result = array_map(function($item) use($name ,$city ,$min_price ,$max_price) {
             
             if(str_contains($item['name'],$name) || str_contains($item['city'],$city)  || ($item['price'] >=$min_price && $item['price']<= $max_price )){
                 return $item;
             } 
        }, $data);
 
        /** function prepare_response come from ResponseTraits 
         *  if status =0 mean no errors else there is error
         * 
         * */  

        return $this->prepare_response(false, null, 'return Successfully', array_filter($result), 0, 200);

        } catch (\Exception $e) {
            return $this->prepare_response(true, $e, 'ٌFailed', null, 1, 400);
        }
     
    }
}
