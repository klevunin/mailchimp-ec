<?php


namespace Klev\MailchimpEC\Prepare;

use \Klev\MailchimpEC\MyInterface\MailchimpECPrepare;
use \Klev\MailchimpEC\Myexception\MailchimpECException;

class EditLineCartPrepare implements MailchimpECPrepare
{
    public function prepareRequest($data)
    {
        try {

            if (!isset($data['order_id'])) {
                throw new MailchimpECException('ERROR: No order_id DELETE LINE order');
            }

            if (!isset($data['line_id'])) {
                throw new MailchimpECException('ERROR: No line_id DELETE LINE order');
            }


            return $data;
        } catch (MailchimpECException $e) {
            $e->MailchimpECLog();
            return null;
        }
    }
}