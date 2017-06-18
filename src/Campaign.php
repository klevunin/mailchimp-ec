<?php

namespace Klev\MailchimpEC;

use \DrewM\MailChimp\MailChimp;

/**
 * Class Customer
 * @package Klev\MailchimpEC
 * https://developer.mailchimp.com/documentation/mailchimp/reference/campaigns/#read-get_campaigns_campaign_id
 */

class Campaign
{
    private $data = array();
    private $methods = 'Reade';
    private $store_id;

    function __construct($data, $methods = 'Reade', $store_id, $api_key_mailchimp)
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
            $this->store_id = $store_id;
        }
        if (!isset($data['campaign_id'])) {
            throw new \Exception(
                'ERROR: campaign_id'
            );
        } else {
            $this->data = $data;
        }

        if (is_null($methods)) {
            $methods = 'Reade';
        }

        $this->methods = $methods;

        $MailChimp = new MailChimp($api_key_mailchimp);


        if ($this->methods = 'Reade') {
            $this->readCampaign($MailChimp);
        }

    }



    function readCampaign($MailChimp){
        $result = $MailChimp->get("/campaigns/" . $this->data['campaign_id'],
            $this->data
        );
        return $result;
    }
}