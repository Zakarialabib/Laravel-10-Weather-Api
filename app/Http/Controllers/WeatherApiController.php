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
                'last_updated' => $data['current']['last_updated'],
                'condition' => $data['current']['condition']['text'],
                'temp_c' => $data['current']['temp_c'],
                'feelslike_c' => $data['current']['feelslike_c'],
            ];
        
        }else{
            $response->failed();
        }
        
        
        return view('welcome', compact('datas'));
    }
}
