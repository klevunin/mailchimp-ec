<?php
namespace Klev\MailchimpEC\Prepare;

use \Klev\MailchimpEC\MyInterface\MailchimpECPrepare;

class ReadCustomersPrepare implements MailchimpECPrepare
{
    public function prepareRequest($data)
    {
        try {
            return $data;
        } catch (Exception $e) {
            echo $e->getMessage(), "\n";
        }
    }
}