<?php

namespace App\Models;


class Sms
{
    public static function send($to, $text)
    {
        exec('gammu sendsms TEXT '.$to.' -text "'.$text.'"');
    }
}
