<?php

namespace Klev\MailchimpEC\Request;

use \DrewM\MailChimp\MailChimp;


class DeleteCustomersRequest implements MailchimpECМethod
{
    public function request($data = array(), $path = array(), $apikey)
    {
        try {

            if ((!isset($apikey)) OR ($apikey == '')) {
                throw new \Exception('ERROR: No apikey');
            }

            if (!isset($path['store_id'])) {
                throw new \Exception('ERROR: No store_id');
            }

            if (!isset($path['customer_id'])) {
                throw new \Exception('ERROR: No customer_id');
            }

            $MailChimp = new MailChimp($apikey);

            $result = $MailChimp->delete("/ecommerce/stores/" . $path['store_id'] . "/customers/" . $path['customer_id']);

            if (!isset($result['status'])) {
                return $result;
            }

        } catch (Exception $e) {
            echo $e->getMessage(), "\n";
        }
    }
}