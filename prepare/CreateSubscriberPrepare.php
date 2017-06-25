<?php

namespace Klev\MailchimpEC\Prepare;

use \Klev\MailchimpEC\MyInterface\MailchimpECPrepare;


class CreateSubscriberPrepare implements MailchimpECPrepare
{
    public function prepareRequest($data)
    {

        try {
            if (!isset($data['email_address'])) {
                throw new \Exception('ERROR: No email_address');
            } else {
                if (!filter_var($data['email_address'], FILTER_VALIDATE_EMAIL)) {
                    throw new \Exception('ERROR: No email_address VALIDATE');
                }
            }

            if (!isset($data['status'])) {
                throw new \Exception('ERROR: No title');
            }

            if ((isset($data['merge_fields'])) AND (!is_object($data['merge_fields']))) {
                $data['merge_fields']=(object)$data['merge_fields'];
            }

            if ((isset($data['vip'])) AND (!is_bool($data['vip']))) {
                $data['vip']=(bool)$data['vip'];
            }

            if ((isset($data['location'])) AND (!is_object($data['location']))) {
                $data['location']=(object)$data['location'];

                if ((!isset($data['location']->latitude)) AND ($data['location']->longitude)) {
                    throw new \Exception('ERROR: No location');
                }

            }

            if ((isset($data['ip_signup'])) AND (!filter_var($data['ip_signup'], FILTER_VALIDATE_IP))) {
                throw new \Exception('ERROR: No ip_signup');
            }

            return $data;


        } catch (Exception $e) {
            echo $e->getMessage(), "\n";
        }

    }
}