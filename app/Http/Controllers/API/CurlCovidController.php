<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CurlCovidController extends Controller
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
    }

    public function summary(Request $request)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://covid-rest.herokuapp.com/summary',
        ]);
        $resp = curl_exec($curl);
        return $resp;
        curl_close($curl);
    }

    public function all(Request $request)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://covid-rest.herokuapp.com',
        ]);
        $resp = curl_exec($curl);
        return $resp;
        curl_close($curl);
    }

    public function country(Request $request, $id)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://covid-rest.herokuapp.com/'.$id
        ]);
        $resp = curl_exec($curl);
        return $resp;
        curl_close($curl);
    }
}
