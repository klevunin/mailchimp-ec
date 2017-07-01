<?php

namespace Klev\MailchimpEC\Request;

use \DrewM\MailChimp\MailChimp;
use \Klev\MailchimpEC\MyInterface\MailchimpECМethod;
use \Klev\MailchimpEC\Myexception\MailchimpECException;


class EditProductsRequest implements MailchimpECМethod
{
    public function request($data = array(), $path = array())
    {
        try {

            require_once __DIR__.'/../config/config.php';

            if (!defined('API_KEY_MAILCHIMP')) {
                throw new MailchimpECException('ERROR: No apikey');
            }

            if (!defined('STORE_ID')) {
                throw new MailchimpECException('ERROR: No apikey');
            }

            if (!isset($path['product_id'])) {
                $path['product_id']=$data['id'];
            }

            $MailChimp = new MailChimp(API_KEY_MAILCHIMP);

            $result = $MailChimp->patch("/ecommerce/stores/" . STORE_ID . "/products/" . $path['product_id'],$data);

            if ((isset($result['id'])) AND ($result['id'] == $data['id'])) {
                return $result;
            } else {

                $CreateProducts = new \Klev\MailchimpEC\Prepare\CreateProductsPrepare();
                $data_CreateProducts = $CreateProducts->prepareRequest($data);

                if ($data_CreateProducts) {
                    $CreateProductsRequest = new \Klev\MailchimpEC\Request\CreateProductsRequest();
                    $result = $CreateProductsRequest->request($data_CreateProducts);

                    if ((isset($result['id'])) AND ($result['id'] == $data['id'])) {
                        return $result;
                    } else {
                        throw new MailchimpECException(json_encode($result));
                    }
                }


            }

        } catch (MailchimpECException $e) {
            $e->MailchimpECLog();
            return null;
        }
    }
}
