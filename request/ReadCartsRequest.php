<?php

namespace Klev\MailchimpEC\Request;

use \DrewM\MailChimp\MailChimp;
use \Klev\MailchimpEC\MyInterface\MailchimpECМethod;
use \Klev\MailchimpEC\Myexception\MailchimpECException;

class ReadCartsRequest implements MailchimpECМethod
{
    public function request($data = array(), $path = array())
    {
        try {

            require_once __DIR__.'/../config/config.php';

            if (!defined('API_KEY_MAILCHIMP')) {
                throw new MailchimpECException('ERROR: No apikey');
            }

            if (!defined('STORE_ID')) {
                throw new MailchimpECException('ERROR: No apikey');
            }


            if (!isset($path['cart_id'])) {
                throw new MailchimpECException('ERROR: No cart_id');
            }


            $MailChimp = new MailChimp(API_KEY_MAILCHIMP);

            $result = $MailChimp->get("/ecommerce/stores/" . STORE_ID . "/carts/".$path['cart_id']);

            if (isset($result['id'])) {
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