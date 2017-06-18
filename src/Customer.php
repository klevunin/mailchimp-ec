<?php

namespace Klev\MailchimpEC;

use \DrewM\MailChimp\MailChimp;
/**
 * Class Customer
 * @package Klev\MailchimpEC
 * https://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/customers/
 */

class Customer
{
    private $data = array();
    private $methods = 'Edit';
    private $store_id;

    function __construct($data,$methods = 'Edit',$store_id,$api_key_mailchimp)
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

        if (!isset($data['opt_in_status'])) {
            $data['opt_in_status']=false;
        }


        if (isset($data['total_spent'])) {
            $data['total_spent']=(integer)$data['total_spent'];
        }
        if (isset($data['total_spent'])) {
            $data['total_spent']=(integer)$data['total_spent'];
        }

        if ($methods != 'ReadList') {
        if (!isset($data['id'])) {
            throw new \Exception(
                'ERROR: customer_id'
            );
        } else {
            $this->data=$data;
        }
        }

        if (is_null($methods)) {
            $methods='Edit';
        }

        if (isset($this->data['opt_in_status'])) {
            if ($this->data['opt_in_status'] == 1) {
                $this->data['opt_in_status'] = (boolean)true;
            } else {
                $this->data['opt_in_status'] = (boolean)false;
            }
        }


        $this->methods=$methods;

        $MailChimp = new MailChimp($api_key_mailchimp);

        if ($methods == 'Edit') {
            $this->editCustomer($MailChimp);
        } elseif ($methods == 'Update') {
            $this->updateCustomer($MailChimp);
        } elseif ($methods == 'Delete') {
            $this->deleteCustomer($MailChimp);
        } elseif ($methods == 'Create') {
            $this->createCustomer($MailChimp);
        } elseif ($methods == 'Read') {
            $this->readCustomer($MailChimp);
        }elseif ($methods == 'ReadList') {
            $this->readListCustomer($MailChimp);
        }



    }

    function createCustomer($MailChimp) {
        $result = $MailChimp->post("/ecommerce/stores/" . $this->store_id . "/customers",
            $this->data
        );
        return $result;
    }

    function editCustomer($MailChimp) {
        $result = $MailChimp->put("/ecommerce/stores/" . $this->store_id . "/customers/" .$this->data['id'],
            $this->data
        );
        return $result;
    }


    function updateCustomer($MailChimp) {
        $result = $MailChimp->post("/ecommerce/stores/" . $this->store_id . "/customers/" .$this->data['id'],
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

    function readListCustomer($MailChimp) {
        $result = $MailChimp->get("/ecommerce/stores/" . $this->store_id . "/customers");
        return $result;
    }

}