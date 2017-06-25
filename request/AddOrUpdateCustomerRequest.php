<?php

namespace Klev\MailchimpEC\Request;

use \DrewM\MailChimp\MailChimp;


class AddOrUpdateCustomerRequest implements MailchimpECМethod
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

            if (!isset($data)) {
                throw new \Exception('ERROR: No data array');
            }

            $MailChimp = new MailChimp($apikey);

            $result = $MailChimp->post("/ecommerce/stores/" . $path['store_id'] . "/customers/" . $path['customer_id'], $data);

            if ((isset($result['id'])) AND ($result['id'] == $data['id'])) {
                return $result;
            }

        } catch (Exception $e) {
            echo $e->getMessage(), "\n";
        }
    }
}