<?php

namespace Klev\MailchimpEC;


class EditCartsPrepare implements MailchimpECPrepare
{
    public function prepareRequest($data)
    {

        try {

            if ((isset($data['customer'])) AND (!is_object($data['customer']))) {
                $data['customer'] = (object)$data['customer'];
            }

            if (isset($data['customer']->opt_in_status)) {
                if (!is_bool($data['customer']->opt_in_status)) {
                    $data['customer']->opt_in_status = (bool)$data['customer']->opt_in_status;
                }
            } else {
                $data['customer']->opt_in_status = (bool)FALSE;
            }

            if ((isset($data['customer']->orders_count)) AND (!is_int($data['customer']->orders_count))) {
                $data['customer']->orders_count = (int)$data['customer']->orders_count;
            }

            if ((isset($data['customer']->total_spent)) AND (!is_numeric($data['customer']->total_spent))) {
                unset($data['customer']->total_spent);
            }

            if ((isset($data['customer']->address)) AND (!is_object($data['customer']->address))) {
                $data['customer']->address = (object)$data['customer']->address;
            }

            if (!isset($data['currency_code'])) {
                throw new \Exception('ERROR: currency_code');
            }

            if ((isset($data['order_total'])) AND (!is_int($data['order_total']))) {
                throw new \Exception('ERROR: order_total');
            }

            if (!isset($data['order_total'])) {
                throw new \Exception('ERROR: order_total');
            }

            if (isset($data['lines'])) {

                foreach ($data['lines'] as $key => $line) {

                    if (!isset($line['id'])) {
                        throw new \Exception('ERROR: id lines');
                    }

                    if (!isset($line['product_id'])) {
                        throw new \Exception('ERROR: product_id lines');
                    }

                    if (!isset($line['product_variant_id'])) {
                        throw new \Exception('ERROR: product_variant_id lines');
                    }

                    if (!isset($line['quantity'])) {
                        throw new \Exception('ERROR: quantity lines');
                    } elseif (!is_int($line['quantity'])) {
                        $data['lines'][$key]['quantity'] = (int)$line['quantity'];
                    }

                    if (!isset($line['price'])) {
                        throw new \Exception('ERROR: price lines');
                    } elseif (!is_numeric($line['price'])) {
                        throw new \Exception('ERROR: price lines');
                    }
                }
            }

            return $data;


        } catch (Exception $e) {
            echo $e->getMessage(), "\n";
        }

    }
}