<?php

namespace Klev\MailchimpEC\Request;

use \DrewM\MailChimp\MailChimp;
use \Klev\MailchimpEC\MyInterface\MailchimpECМethod;

class AddOrUpdateSubscriberRequest implements MailchimpECМethod
{

    public function request($data = array(),$path = array())
    {
        try {

            require_once __DIR__.'/../config/config.php';

            if (!defined('API_KEY_MAILCHIMP')) {
                throw new \Exception('ERROR: No apikey');
            }

            if (!defined('LIST_ID_STORE_SKIMIR')) {
                throw new \Exception('ERROR: No LIST_ID_STORE_SKIMIR');
            }


            if (!isset($data)) {
                throw new \Exception('ERROR: No data array');
            }

            if (!isset($path['customer_id'])) {
                $path['customer_id']=$data['id'];
            }

            $MailChimp = new MailChimp(API_KEY_MAILCHIMP);

            $subscriber_hash = $MailChimp->subscriberHash($data['email_address']);

            $result = $MailChimp->put("/lists/" . LIST_ID_STORE_SKIMIR . "/members/" . $subscriber_hash, $data);


            if ((isset($result['email_address'])) AND ($result['email_address'] == $data['email_address'])) {
                return $result;
            }

        } catch (Exception $e) {
            echo $e->getMessage(), "\n";
        }
    }
}