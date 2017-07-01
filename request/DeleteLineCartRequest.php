<?php

namespace Klev\MailchimpEC\Request;

use \DrewM\MailChimp\MailChimp;
use \Klev\MailchimpEC\MyInterface\MailchimpECМethod;
use \Klev\MailchimpEC\Myexception\MailchimpECException;

class DeleteLineCartRequest implements MailchimpECМethod
{

    public function request($data = array(),$path = array())
    {
        try {

            require_once __DIR__.'/../config/config.php';

            if (!defined('API_KEY_MAILCHIMP')) {
                throw new MailchimpECException('ERROR: No apikey');
            }

            if (!defined('STORE_ID')) {
                throw new MailchimpECException('ERROR: No apikey');
            }

            if ((!isset($path['order_id'])) AND (isset($data['order_id']))) {
                $path['order_id'] = $data['order_id'];
            } else {
                throw new MailchimpECException('ERROR: No order_id');
            }

            if ((!isset($path['line_id'])) AND (isset($data['line_id']))) {
                $path['line_id'] = $data['line_id'];
            } else {
                throw new MailchimpECException('ERROR: No line_id');
            }

            $MailChimp = new MailChimp(API_KEY_MAILCHIMP);

            $result = $MailChimp->delete("/ecommerce/stores/" . STORE_ID . "/carts/" . $path['order_id'] ."/lines/" .$path['line_id']);

            if (!isset($result['status'])) {
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