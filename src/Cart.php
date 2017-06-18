<?php

namespace Klev\MailchimpEC;

/**
 * Class Cart
 * @package Klev\MailchimpEC
 * https://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/carts/#
 */

class Cart
{
    private $data = array();
    private $methods = 'Read';
    private $store_id;

    function __construct($data, $methods = 'Read', $store_id, $api_key_mailchimp)
    {
        if (!isset($api_key_mailchimp)) {
            throw new \Exception(
                'ERROR: No api_key_mailchimp'
            );
        }

        if (!isset($data['id'])) {
            throw new \Exception(
                'ERROR: No id'
            );
        }

        if (!isset($data['customer'])) {
            throw new \Exception(
                'ERROR: No customer Object'
            );
        }

        if (!isset($data['customer']->id)) {
            throw new \Exception(
                'ERROR: No customer id'
            );
        }

        if (!isset($data['currency_code'])) {
            $data['currency_code'] = 'RUB';
        }

        if (!isset($data['order_total'])) {
            throw new \Exception(
                'ERROR: No order_total'
            );
        }

        if (is_null($methods)) {
            $methods = 'Read';
        }

        //удаляем корзину если нет товаров
        if (!isset($data['lines'])) {
            $methods = 'Delete';
        } else {

            foreach ($data['lines'] as $datum => $line) {

                if (!isset($line['id'])) {
                    throw new \Exception(
                        'ERROR: No line id'
                    );
                }

                if (!isset($line['product_id'])) {
                    throw new \Exception(
                        'ERROR: No product_id'
                    );
                }

                if (!isset($line['product_variant_id'])) {
                    throw new \Exception(
                        'ERROR: No product_variant_id'
                    );
                }

                if (!isset($line['quantity'])) {
                    throw new \Exception(
                        'ERROR: No quantity'
                    );
                } else {
                    $data['lines'][$datum]['quantity'] = (integer)$line['quantity'];
                }

                if (!isset($line['price'])) {
                    throw new \Exception(
                        'ERROR: No price'
                    );
                } else {

                    if (!is_numeric($line['price'])) {
                        throw new \Exception(
                            'ERROR: !is_numeric price'
                        );
                    }

                }

            }
        }

        if (!isset($store_id)) {
            throw new \Exception(
                'ERROR: No store_id'
            );
        } else {
            $this->store_id = $store_id;
        }

        $MailChimp = new MailChimp($api_key_mailchimp);


        if ($methods == 'Read') {
            $result = $this->readCustomer($MailChimp);

            //корзина существует нужно обновить
            if ((!isset($result['id'])) AND ($result['id'] == $data['id'])) {
                $result = $this->updateCustomer($MailChimp);
            } else {
                //нужно создать новую корзину
                $result = $this->createCustomer($MailChimp);
            }
        } elseif ($methods == 'Delete') {
            $result = $this->deleteCustomer($MailChimp);
        } elseif ($methods == 'Edit') {
            $result = $this->updateCustomer($MailChimp);
        } elseif ($methods == 'Create') {
            $result = $this->createCustomer($MailChimp);
        }

    }


    function readCustomer($MailChimp)
    {
        $result = $MailChimp->get("/ecommerce/stores/" . $this->store_id . "/carts/" . $this->data['id']
        );
        return $result;
    }

    function deleteCustomer($MailChimp)
    {
        $result = $MailChimp->get("/ecommerce/stores/" . $this->store_id . "/carts/" . $this->data['id']
        );
        return $result;
    }


    function updateCustomer($MailChimp)
    {
        $result = $MailChimp->patch("/ecommerce/stores/" . $this->store_id . "/carts/" . $this->data['id'],
            $this->data
        );
        return $result;
    }

    function createCustomer($MailChimp)
    {
        $result = $MailChimp->post("/ecommerce/stores/" . $this->store_id . "/carts",
            $this->data
        );
        return $result;
    }
}