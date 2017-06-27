<?php

namespace Klev\MailchimpEC\Prepare;

use \Klev\MailchimpEC\MyInterface\MailchimpECPrepare;
use \Klev\MailchimpEC\Myexception\MailchimpECException;

class AddOrUpdateCustomerPrepare implements MailchimpECPrepare
{

    public function prepareRequest($data)
    {

        try {
            if (!isset($data['id'])) {
                throw new MailchimpECException('ERROR: No id');
            } elseif (!is_string($data['id'])) {
                $data['id'] = (string)$data['id'];
            }

            if (!isset($data['email_address'])) {
                throw new MailchimpECException('ERROR: No email_address');
            } else {
                if (!filter_var($data['email_address'], FILTER_VALIDATE_EMAIL)) {
                    throw new MailchimpECException('ERROR: No email_address VALIDATE');
                }
            }

            if ((isset($data['company'])) AND ($data['company'] == '')) {
                unset($data['company']);
            }

            if ((isset($data['total_spent'])) AND ($data['total_spent'] == '')) {
                unset($data['total_spent']);
            }

            if (isset($data['opt_in_status'])) {
                if (!is_bool($data['opt_in_status'])) {
                    $data['opt_in_status'] = (bool)$data['opt_in_status'];
                }
            } else {
                $data['opt_in_status'] = (bool)FALSE;
            }


            if ((isset($data['orders_count'])) AND (!is_int($data['orders_count']))) {
                $data['orders_count'] = (int)$data['orders_count'];
            }

            if ((isset($data['total_spent'])) AND (!is_numeric($data['total_spent']))) {
                unset($data['total_spent']);
            }

            if ((isset($data['address'])) AND (!is_object($data['address']))) {
                $data['address'] = (object)$data['address'];
            }

            return $data;

        } catch (MailchimpECException $e) {
            $e->MailchimpECLog();
            return null;
        }

    }
}