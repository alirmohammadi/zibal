<?php

namespace Alirmohammadi\Zibal\controller;

use Alirmohammadi\Zibal\exception\ZibalHttpException;
use Alirmohammadi\Zibal\exception\ZibalResponseException;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class NormalPayment extends Controller
{

    protected $merchant;
    protected $amount;
    protected $callbackUrl;
    protected $orderId;
    protected $mobile;
    protected $description;
    protected $allowedCards;

    /**
     * NormalPayment constructor.
     *
     * @param $merchant
     * @param $amount
     * @param $callbackUrl
     * @param $orderId
     * @param $mobile
     * @param $description
     * @param $allowedCards
     */
    public function __construct ($merchant, $amount, $callbackUrl, $orderId, $mobile, $description, $allowedCards)
    {
        $this -> merchant = $merchant;
        $this -> amount = $amount;
        $this -> callbackUrl = $callbackUrl;
        $this -> orderId = $orderId;
        $this -> mobile = $mobile;
        $this -> description = $description;
        $this -> allowedCards = $allowedCards;
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
       ]);
    }

}
