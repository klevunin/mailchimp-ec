<?php

namespace Klev\MailchimpEC\Myexception;

class MailchimpECException extends \Exception
{

    public function MailchimpECLog(){

        $message=$this->getMessage().' CODE:'.$this->getCode().' FILE:'.$this->getFile().' LINE:'.$this->getLine();

        /**
         * DRUPAL
         * https://api.drupal.org/api/drupal/includes%21bootstrap.inc/function/watchdog/7.x
         */
        if (function_exists('watchdog')) {
            watchdog('MailchimpEC', '%message', array(
                '%message' => $message,
            ), WATCHDOG_ERROR);
        }
    }
}