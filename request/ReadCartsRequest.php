<?php

namespace Klev\MailchimpEC\Request;

use \DrewM\MailChimp\MailChimp;


class ReadCartsRequest implements MailchimpECМethod
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

            if (!isset($path['cart_id'])) {
                throw new \Exception('ERROR: No cart_id');
            }


            $MailChimp = new MailChimp($apikey);

            $result = $MailChimp->get("/ecommerce/stores/" . $path['store_id'] . "/carts/".$path['cart_id']);

            if (isset($result['id'])) {
                return $result;
            }

        } catch (Exception $e) {
            echo $e->getMessage(), "\n";
        }
    }
}