<?php
namespace Klev\MailchimpEC\Request;

use \DrewM\MailChimp\MailChimp;
use \Klev\MailchimpEC\MyInterface\MailchimpECМethod;

class DeleteOrderRequest implements MailchimpECМethod
{

    public function request($data = array(),$path = array())
    {
        try {

            require_once __DIR__.'/../config/config.php';

            if (!defined('API_KEY_MAILCHIMP')) {
                throw new \Exception('ERROR: No apikey');
            }

            if (!defined('STORE_ID')) {
                throw new \Exception('ERROR: No apikey');
            }

            if ((!isset($path['order_id'])) AND (isset($data['id']))) {
                $path['order_id']=$data['id'];
            } else {
                throw new \Exception('ERROR: No cart_id');
            }

            $MailChimp = new MailChimp(API_KEY_MAILCHIMP);

            $result = $MailChimp->delete("/ecommerce/stores/" . STORE_ID . "/orders/" . $path['cart_id']);

            if (!isset($result['status'])) {
                return $result;
            }

        } catch (Exception $e) {
            echo $e->getMessage(), "\n";
        }
    }
}