<?php

namespace Klev\MailchimpEC\Request;

use \DrewM\MailChimp\MailChimp;
use \Klev\MailchimpEC\MyInterface\MailchimpECМethod;
use \Klev\MailchimpEC\Myexception\MailchimpECException;

class AddOrUpdateCustomerRequest implements MailchimpECМethod
{

    public function request($data = array(),$path = array())
    {
        try {

            require_once __DIR__.'/../config/config.php';

            if (!defined('API_KEY_MAILCHIMP')) {
                throw new \Exception('ERROR: No apikey');
            }

            if (!defined('STORE_ID')) {
                throw new MailchimpECException('ERROR: No apikey');
            }

            if (!isset($data['id'])) {
                throw new MailchimpECException('ERROR: No customer_id');
            }

            if (!isset($data)) {
                throw new MailchimpECException('ERROR: No data array');
            }

            if (!isset($path['customer_id'])) {
                $path['customer_id']=$data['id'];
            }

            $MailChimp = new MailChimp(API_KEY_MAILCHIMP);

            $result = $MailChimp->put("/ecommerce/stores/" . STORE_ID . "/customers/" . $path['customer_id'], $data);

            if ((isset($result['id'])) AND ($result['id'] == $data['id'])) {
                return $result;
            } else {
                throw new MailchimpECException(json_encode($result));
            }

        } catch (MailchimpECException $e) {
            $e->MailchimpECLog();
            return null;
        }
    }
}