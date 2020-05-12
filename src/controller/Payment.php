<?php

namespace Alirmohammadi\Zibal\controller;

use Alirmohammadi\Zibal\exception\ZibalHttpException;
use Alirmohammadi\Zibal\exception\ZibalResponseException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

define("success",100);
class Payment extends Controller
{


    public static function generatePaymentURL ($trackId)
    {
        return "https://gateway.zibal.ir/start/".$trackId;
    }

    public static function verify ($trackId)
    {
        $response=Http::post("https://gateway.zibal.ir/v1/verify",[
            "merchant"=>config("zibal.merchant"),
            "trackId"=>$trackId
        ]);

        return $response->json();
    }

    public static function request ($data)
    {
        $response=Http::post("https://gateway.zibal.ir/v1/request",$data);

        if ($response->successful())
        {
            $data = $response -> json();
            if ($data["result"]==success)
            {
                return $data["trackId"];
            }
            else
            {
                throw new ZibalResponseException("code:".$data["result"]." message:".$data["message"]);
            }
        }
        else
        {
            throw new ZibalHttpException("error in connection to zibal server with error:".$response->status(),500);
        }
    }
}
