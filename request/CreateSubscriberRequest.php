<?php

namespace Klev\MailchimpEC\Request;

use \DrewM\MailChimp\MailChimp;
use \Klev\MailchimpEC\MyInterface\MailchimpECМethod;
use \Klev\MailchimpEC\Myexception\MailchimpECException;

class CreateSubscriberRequest implements MailchimpECМethod
{

    public function request($data = array(),$path = array())
    {
        try {

            require_once __DIR__.'/../config/config.php';

            if (!defined('API_KEY_MAILCHIMP')) {
                throw new MailchimpECException('ERROR: No apikey');
            }

            if (!defined('STORE_ID')) {
                throw new MailchimpECException('ERROR: No apikey');
            }

            if (!defined('LIST_ID_STORE_SKIMIR')) {
                throw new MailchimpECException('ERROR: No LIST_ID_STORE_SKIMIR');
            }

            if (!isset($data)) {
                throw new MailchimpECException('ERROR: No data array');
            }


            $MailChimp = new MailChimp(API_KEY_MAILCHIMP);

            $result = $MailChimp->post("/lists/" . LIST_ID_STORE_SKIMIR . "/members", $data);

            if ((isset($result['email_address'])) AND ($result['email_address'] == $data['email_address'])) {
                return $result;
            } else {
                throw new MailchimpECException(json_encode($result));
            }

        } catch (MailchimpECException $e) {
            $e->MailchimpECLog();
            return null;
        }
    }
}