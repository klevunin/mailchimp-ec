<?php

namespace Klev\MailchimpEC;

use \DrewM\MailChimp\MailChimp;

class Product
{

    private $data = array();
    private $methods = 'Read';
    private $store_id;
    private $api_key_mailchimp;

    /**
     * Product constructor.
     * @param $data
     * @methods string: Create,Delete
     * @store_id id store api http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/
     * @api_key_mailchimp api key mailchimp
     */
    function __construct($data, $methods = 'Reade',$store_id,$api_key_mailchimp)
    {
        if (!isset($data['id'])) {
            return 'ERROR: No DATA ID product http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/products/';
        }
        if (!isset($data['title'])) {
            return 'ERROR: No title product http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/products/';
        }
        if (!isset($data['variants'])) {
            return 'ERROR: No variants product http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/products/';
        }

        if (is_null($methods)) {
            $methods ='Read';
        }

        $MailChimp = new MailChimp($api_key_mailchimp);

        $this->data=$data;
        $this->methods=$methods;
        $this->store_id=$store_id;
        $this->api_key_mailchimp=$api_key_mailchimp;

        if ($methods == 'Read') {
            //проверим возможно продукт уже существует
            $result = $this->readProduct($MailChimp);

            if ($result['id'] == $this->data['id']) {
                //товар есть обновим товар
                $result = $this->editProduct($MailChimp);
            } else {
                //Пробую создать товар
                $result = $this->createProduct($MailChimp);
            }
        } else {
            if ($methods == 'Create') {
                $result = $this->createProduct($MailChimp);
            } elseif ($methods == 'Edit') {
                $result = $this->editProduct($MailChimp);
            } elseif ($methods == 'Delete') {
                $result = $this->deleteProduct($MailChimp);
            }
        }
    }

    function readProduct($MailChimp){
        $result = $MailChimp->get("/ecommerce/stores/" . $this->store_id . "/products/".$this->data['id'], [
        ]);
        return $result;
    }

    function createProduct($MailChimp){
        $result = $MailChimp->post("/ecommerce/stores/" . $this->store_id . "/products",
            $this->data
        );
        return $result;
    }

    function editProduct($MailChimp){
        $result = $MailChimp->patch("/ecommerce/stores/" . $this->store_id . "/products/".$this->data['id'],
            $this->data
        );
        return $result;
    }

    function deleteProduct($MailChimp){
        $result = $MailChimp->delete("/ecommerce/stores/" . $this->store_id . "/products/".$this->data['id'], [
        ]);
        return $result;
    }

}