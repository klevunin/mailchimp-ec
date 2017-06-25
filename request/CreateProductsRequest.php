<?php

namespace Klev\MailchimpEC\Request;

use \DrewM\MailChimp\MailChimp;



class CreateProductsRequest implements MailchimpECМethod
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

            if (!isset($data)) {
                throw new \Exception('ERROR: No data array');
            }

            $MailChimp = new MailChimp($apikey);

            $result = $MailChimp->post("/ecommerce/stores/" . $path['store_id'] . "/products",$data);

            if ((isset($result['id'])) AND ($result['id'] == $data['id'])) {
                return $result;
            }

        } catch (Exception $e) {
            echo $e->getMessage(), "\n";
        }
    }
}
{

}