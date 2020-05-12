<?php

namespace Alirmohammadi\Zibal\controller;

use Alirmohammadi\Zibal\exception\ZibalHttpException;
use Alirmohammadi\Zibal\exception\ZibalResponseException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class SharePayment extends Controller
{
    protected $merchant;
    protected $amount;
    protected $callbackUrl;
    protected $orderId;
    protected $mobile;
    protected $description;
    protected $allowedCards;
    protected $percentMode;
    protected $feeMode;
    protected $multiplexingInfos;

    /**
     * SharePayment constructor.
     *
     * @param $merchant
     * @param $amount
     * @param $callbackUrl
     * @param $orderId
     * @param $mobile
     * @param $description
     * @param $allowedCards
     * @param $percentMode
     * @param $feeMode
     * @param $multiplexingInfos
     */
    public function __construct ($merchant, $amount, $callbackUrl, $orderId, $mobile, $description, $allowedCards,bool $percentMode, $feeMode, array $multiplexingInfos)
    {
        $this -> merchant = $merchant;
        $this -> amount = $amount;
        $this -> callbackUrl = $callbackUrl;
        $this -> orderId = $orderId;
        $this -> mobile = $mobile;
        $this -> description = $description;
        $this -> allowedCards = $allowedCards;
        $this -> percentMode = $percentMode;
        $this -> feeMode = $feeMode;
        $this -> multiplexingInfos = $multiplexingInfos;
    }

    public function request ()
    {
        return Payment::request([
            "merchant"=>$this->merchant,
            "amount"=>$this->amount,
            "callbackUrl"=>$this->callbackUrl,
            "description"=>$this->description,
            "orderId"=>$this->orderId,
            "mobile"=>$this->mobile,
            "allowedCards"=>$this->allowedCards,
            "percentMode"=>$this->percentMode,
            "feeMode"=>$this->feeMode,
            "multiplexingInfos"=>$this->multiplexingInfos,
        ]);

    }
}
