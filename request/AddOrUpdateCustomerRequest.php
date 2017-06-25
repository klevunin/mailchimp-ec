<?php

namespace Klev\MailchimpEC\Request;

use \DrewM\MailChimp\MailChimp;


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
                throw new \Exception('ERROR: No apikey');
            }

            if (!isset($data['id'])) {
                throw new \Exception('ERROR: No customer_id');
            }

            if (!isset($data)) {
                throw new \Exception('ERROR: No data array');
            }

            if (!isset($path['customer_id'])) {
                $path['customer_id']=$data['id'];
            }

            $MailChimp = new MailChimp(API_KEY_MAILCHIMP);

            $result = $MailChimp->post("/ecommerce/stores/" . STORE_ID . "/customers/" . $path['customer_id'], $data);

            if ((isset($result['id'])) AND ($result['id'] == $data['id'])) {
                return $result;
            }

        } catch (Exception $e) {
            echo $e->getMessage(), "\n";
        }
    }
}