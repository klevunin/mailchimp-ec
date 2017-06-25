<?php

namespace Klev\MailchimpEC\Request;

use \DrewM\MailChimp\MailChimp;
use \Klev\MailchimpEC\MyInterface\MailchimpECМethod;


class ReadCustomersRequest implements MailchimpECМethod
{
    public function request($data = array(), $path = array(), $apikey)
    {
        try {

            require_once __DIR__.'/../config/config.php';

            if (!defined('API_KEY_MAILCHIMP')) {
                throw new \Exception('ERROR: No apikey');
            }

            if (!defined('STORE_ID')) {
                throw new \Exception('ERROR: No apikey');
            }

            if (!isset($path['customer_id'])) {
                throw new \Exception('ERROR: No customer_id');
            }


            $MailChimp = new MailChimp(API_KEY_MAILCHIMP);

            $result = $MailChimp->get("/ecommerce/stores/" . STORE_ID . "/customers/".$path['customer_id']);

            if (isset($result['id'])) {
                return $result;
            }

        } catch (Exception $e) {
            echo $e->getMessage(), "\n";
        }
    }
}