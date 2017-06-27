<?php

namespace Klev\MailchimpEC\Myexception;

class MailchimpECException extends \Exception
{

    public function MailchimpECLog(){

        $message=$this->getMessage().'\n'.$this->getCode().'\n'.$this->getFile().'\n'.$this->getLine().'\n';

        if (function_exists('watchdog')) {
            watchdog('mailchimp_ecommerce', '%message', array(
                '%message' => $message,
            ), WATCHDOG_ERROR);
        }
    }
}