<?php

namespace App\Sms;

interface SmsInterface
{
    public function Send(string $phonenumber,string $message);
    public function MobileSms($request);
}