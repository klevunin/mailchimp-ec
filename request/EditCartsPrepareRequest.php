<?php

namespace Klev\MailchimpEC;

use \DrewM\MailChimp\MailChimp;


class EditCartsPrepareRequest implements MailchimpECМethod
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

            if (!isset($data)) {
                throw new \Exception('ERROR: No data array');
            }

            $MailChimp = new MailChimp($apikey);

            $result = $MailChimp->patch("/ecommerce/stores/" . $path['store_id'] . "/carts/".$path['cart_id'],$data);

            if ((isset($result['id'])) AND ($result['id'] == $data['id'])) {
                return $result;
            }

        } catch (Exception $e) {
            echo $e->getMessage(), "\n";
        }
    }
}