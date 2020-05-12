<?php

namespace Alirmohammadi\Zibal;

use Alirmohammadi\Zibal\controller\NormalPayment;
use Alirmohammadi\Zibal\controller\Payment;
use Alirmohammadi\Zibal\controller\SharePayment;
use Alirmohammadi\Zibal\exception\ZibalResponseException;
use Alirmohammadi\Zibal\exception\ZibalStatusException;
use App\Exceptions\Handler;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ZibalPayment extends Controller
{


    public static function normalPayment ($amount, $callbackUrl, $orderId="", $mobile="", $description="", array $allowedCards=[])
    {

        $pay=new NormalPayment(config("zibal.merchant"),$amount,$callbackUrl,$orderId,$mobile,$description,$allowedCards);

        $trackNumber=$pay->request();

        return Payment::generatePaymentURL($trackNumber);
    }

    public static function sharePayment ($amount, $callbackUrl,bool $percentMode,$feeMode,array $multiplexingInfos, $orderId="", $mobile="", $description="", array $allowedCards=[])
    {
        $pay=new SharePayment(config("zibal.merchant"),$amount,$callbackUrl,$orderId,$mobile,$description,$allowedCards,$percentMode,$feeMode,$multiplexingInfos);

        $trackNumber=$pay->request();

        return Payment::generatePaymentURL($trackNumber);
    }

    public  function callBack (Request $request)
    {
        if ($request->input("success")==1)
        {
            $data=$this->verify($request->input("trackId"));
            $data["orderId"]=$request->input("orderId");

            return $data;
        }
        else
        {
            throw  new ZibalStatusException("error  code ".$request->input("status"));
        }
    }

    public function  verify ($trackId)
    {
       return Payment::verify($trackId);
    }
}
