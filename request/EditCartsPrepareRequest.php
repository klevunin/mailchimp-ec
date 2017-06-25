<?php

namespace Klev\MailchimpEC\Request;

use \DrewM\MailChimp\MailChimp;
use Klev\MailchimpEC\MyInterface;

class EditCartsPrepareRequest implements MailchimpECМethod
{
    public function request($data = array(), $path = array())
    {
        try {


            require_once __DIR__.'/../config/config.php';

            if (!defined('API_KEY_MAILCHIMP')) {
                throw new \Exception('ERROR: No apikey');
            }

            if (!defined('STORE_ID')) {
                throw new \Exception('ERROR: No apikey');
            }

            if (!isset($path['cart_id'])) {
                throw new \Exception('ERROR: No cart_id');
            }

            if (!isset($data)) {
                throw new \Exception('ERROR: No data array');
            }

            $MailChimp = new MailChimp(API_KEY_MAILCHIMP);

            $result = $MailChimp->patch("/ecommerce/stores/" . STORE_ID . "/carts/".$path['cart_id'],$data);

            if ((isset($result['id'])) AND ($result['id'] == $data['id'])) {
                return $result;
            }

        } catch (Exception $e) {
            echo $e->getMessage(), "\n";
        }
    }
}