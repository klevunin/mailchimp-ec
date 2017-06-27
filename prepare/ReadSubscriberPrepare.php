<?php

namespace Klev\MailchimpEC\Prepare;

use \Klev\MailchimpEC\MyInterface\MailchimpECPrepare;
use \Klev\MailchimpEC\Myexception\MailchimpECException;

class ReadSubscriberPrepare implements MailchimpECPrepare
{
    public function prepareRequest($data)
    {
        try {

            if (!isset($data['email_address'])) {
                throw new MailchimpECException('ERROR: No email_address');
            } else {
                if (!filter_var($data['email_address'], FILTER_VALIDATE_EMAIL)) {
                    throw new MailchimpECException('ERROR: No email_address VALIDATE');
                }
            }
            return $data;
        } catch (MailchimpECException $e) {
            $e->MailchimpECLog();
            return null;
        }
    }
}