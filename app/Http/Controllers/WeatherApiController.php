<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherApiController extends Controller
{
    public function __invoke()
    {
        $response = Http::get('http://api.weatherapi.com/v1/current.json?key='.config('weather.api').'&q=casablanca&aqi=no');
        
        if($response->ok()){

            $data = $response->json();
            
            $datas = [
                'name' => $data['location']['name'],
                'country' => $data['location']['country'],
                'localtime' => $data['location']['localtime'],
            ];
        
        }else{
            $response->failed();
        }
        
        
        return view('welcome', compact('datas'));
    }
}
