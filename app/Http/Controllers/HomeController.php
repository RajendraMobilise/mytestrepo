<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index(Request $request){
      
    $result =  Http::get("https://pkgstore.datahub.io/core/nasdaq-listings/nasdaq-listed_json/data/a5bc7580d6176d60ac0b2142ca8d7df6/nasdaq-listed_json.json");
    $finaldata =  json_decode($result, true);
    
        return view('welcome',compact('finaldata'));
    }
public function submitForm(Request $request){
        // |lte:today
        $validator = Validator::make($request->all(), [
            'symbol' => 'required|regex:/^[A-Z]+$/',
            'startDate' => 'required|date|lte:endDate',
            'endDate' => 'required|date|gte:startDate',
            'email' => 'required|email',

        ]);
    
        
    if ($validator->fails()) {
        return response()->json(['status'=>'errors','errors' => $validator->errors()]);
    }
    $symbol =  $request->input('symbol');

      $httpreq =   Http::withHeaders([
            'X-RapidAPI-Key' =>  '8be355d39bmshb79f195369c6209p19dd30jsnf883bfff1fd3',
            'X-RapidAPI-Host' => 'yh-finance.p.rapidapi.com' 
       ])->get('https://yh-finance.p.rapidapi.com/stock/v3/get-historical-data?symbol='.$symbol.'&region=US');
      
       $finaldata =  json_decode($httpreq, true);
      
       $ResData = [];
       if (array_key_exists("prices",$finaldata))
       {
            if (count($finaldata['prices']) > 0) {
                $ResData = $finaldata['prices']; 

                $strtoStartDate = strtotime($request->input('startDate'));
                $strtoEndDate = strtotime($request->input('endDate'));
                
                $storeFilterData = [];
                foreach ($ResData as $key => $value) {
                  
                    $timestamp = $value['date'];

                    $datetimeFormat = 'Y-m-d H:i:s';

                    if($timestamp >= $strtoStartDate && $timestamp <= $strtoEndDate){
                        $storeFilterData[] = array(
                                'date'=>date('Y-m-d H:i:s' , $timestamp),
                                'open'=>$value['open'],
                                'high'=>$value['high'],
                                'low'=>$value['low'],
                                'close'=>$value['close'],
                                'volume'=>$value['volume']
                                );
                    }
                    
                }
                return response()->json(['status' => true,'message'=>'Data found','data'=>  $storeFilterData]);
            }else{
                return response()->json(['status' => false,'message'=>'Data not found','data'=>[]]);
            }
       }else{
        return response()->json(['status' => false,'message'=>'Data  not found','data'=>[]]);
       }
}

}
