<?php

namespace Klev\MailchimpEC;


use \DrewM\MailChimp\MailChimp;
/**
 * Class Customer
 * @package Klev\MailchimpEC
 * https://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/orders/
 */

class Order
{

    private $data = array();
    private $methods = 'Create';
    private $store_id;
    public $result = array();

    function __construct($data,$methods = 'Create',$store_id,$api_key_mailchimp)
    {
        if (!isset($api_key_mailchimp)) {
            throw new \Exception(
                'ERROR: No api_key_mailchimp'
            );
        }

        if (!isset($store_id)) {
            throw new \Exception(
                'ERROR: No store_id'
            );
        } else {
            $this->store_id=$store_id;
        }

        if (!isset($data['id'])) {
            throw new \Exception(
                'ERROR: No id'
            );
        }

        if (!isset($data['customer'])) {
            throw new \Exception(
                'ERROR: No customer'
            );
        }

        if (!isset($data['currency_code'])) {
            $data['currency_code']='RUB';
        }

        if (!isset($data['order_total'])) {
            throw new \Exception(
                'ERROR: No customer'
            );
        } else {

            if (!is_numeric($data['order_total'])) {
                throw new \Exception(
                    'ERROR: !is_numeric order_total'
                );
            }
        }

        if (is_null($methods)) {
            $methods='Create';
        }

        if (!isset($data['lines'])) {
            //удяляем заказ
            $methods = 'Delete';
        }

        $this->methods=$methods;

        $MailChimp = new MailChimp($api_key_mailchimp);

        if ($methods == 'Create') {
            return $this->result = $this->createCustomer($MailChimp);
        } elseif ($methods == 'Edit') {
            return $this->result = $this->editCustomer($MailChimp);
        } elseif ($methods == 'Delete') {
            return $this->result = $this->deleteCustomer($MailChimp);
        } elseif ($methods == 'Read') {
            return $this->result = $this->readCustomer($MailChimp);
        }



    }

    function createCustomer($MailChimp) {
        $result = $MailChimp->post("/ecommerce/stores/" . $this->store_id . "/orders",
            $this->data
        );
        return $result;
    }

    function editCustomer($MailChimp) {
        $result = $MailChimp->path("/ecommerce/stores/" . $this->store_id . "/customers/" .$this->data['id'],
            $this->data
        );
        return $result;
    }

    function deleteCustomer($MailChimp) {
        $result = $MailChimp->delete("/ecommerce/stores/" . $this->store_id . "/customers/" .$this->data['id']);
        return $result;
    }

    function readCustomer($MailChimp) {
        $result = $MailChimp->get("/ecommerce/stores/" . $this->store_id . "/customers/" .$this->data['id']);
        return $result;
    }

}