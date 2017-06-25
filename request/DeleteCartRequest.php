<?php
namespace Klev\MailchimpEC\Request;

use \DrewM\MailChimp\MailChimp;
use Klev\MailchimpEC\MyInterface;

class DeleteCartRequest implements MailchimpECМethod
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

            if ((!isset($path['cart_id'])) AND (isset($data['id']))) {
                $path['cart_id']=$data['id'];
            } else {
                throw new \Exception('ERROR: No cart_id');
            }

            $MailChimp = new MailChimp(API_KEY_MAILCHIMP);

            $result = $MailChimp->delete("/ecommerce/stores/" . STORE_ID . "/cart/" . $path['cart_id']);

            if (!isset($result['status'])) {
                return $result;
            }

        } catch (Exception $e) {
            echo $e->getMessage(), "\n";
        }
    }
}