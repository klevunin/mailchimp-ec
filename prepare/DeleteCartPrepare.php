<?php

namespace Klev\MailchimpEC\Prepare;

use \Klev\MailchimpEC\MyInterface\MailchimpECPrepare;
use \Klev\MailchimpEC\Myexception\MailchimpECException;

class DeleteCartPrepare implements MailchimpECPrepare
{
    public function prepareRequest($data)
    {
        try {
            return $data;
        } catch (MailchimpECException $e) {
            $e->MailchimpECLog();
            return null;
        }
    }
}