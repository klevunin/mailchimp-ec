<?php

namespace Klev\MailchimpEC;

use \DrewM\MailChimp\MailChimp;

class Product
{

    /**
     * Product constructor.
     * @param $data
     * @methods string: Create,Delete
     * @store_id id store api http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/
     */
    function __construct($data, $methods = 'Create',$store_id)
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

        if ($methods == 'Create') {
            //проверим возможно продукт уже существует
            $result = $MailChimp->get("/ecommerce/stores/" . $store_id . "/products/testdf", [
            ]);

        }



    }

}