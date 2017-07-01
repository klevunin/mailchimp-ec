<?php

namespace Klev\MailchimpEC\Request;

use \DrewM\MailChimp\MailChimp;
use \Klev\MailchimpEC\MyInterface\MailchimpECМethod;
use \Klev\MailchimpEC\Myexception\MailchimpECException;

class EditCartsPrepareRequest implements MailchimpECМethod
{
    public function request($data = array(), $path = array())
    {
        try {


            require_once __DIR__ . '/../config/config.php';

            if (!defined('API_KEY_MAILCHIMP')) {
                throw new MailchimpECException('ERROR: No apikey');
            }

            if (!defined('STORE_ID')) {
                throw new MailchimpECException('ERROR: No apikey');
            }

            if (!isset($path['cart_id'])) {
                $path['cart_id'] = $data['id'];
            }

            if (!isset($data)) {
                throw new \Exception('ERROR: No data array');
            }

            $MailChimp = new MailChimp(API_KEY_MAILCHIMP);
            $result = $MailChimp->patch("/ecommerce/stores/" . STORE_ID . "/carts/" . $path['cart_id'], $data);

            if (!isset($result['status'])) {
                return json_encode($result);
            } else {
                $CreateCarts = new \Klev\MailchimpEC\Prepare\CreateCartsPrepare();
                $data_CreateCarts = $CreateCarts->prepareRequest($data);

                if ($data_CreateCarts) {
                    $CreateOrderRequest = new \Klev\MailchimpEC\Request\CreateCartsRequest();
                    $result = $CreateOrderRequest->request($data_CreateCarts);

                    if (!isset($result['status'])) {
                        return json_encode($result);
                    } else {
                        throw new MailchimpECException(json_encode($result).'--'.$path['cart_id']);
                    }
                }
            }

        } catch (MailchimpECException $e) {
            $e->MailchimpECLog();
            return null;
        }
    }
}