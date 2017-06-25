<?php

require_once '/home/api/mailchimp/mailchimp-ec/vendor/autoload.php';

$cart = new Klev\MailchimpEC\Prepare\CreateCartsPrepare();


$result = $MailChimp->get("/campaigns/" . $this->data['campaign_id'],
    $this->data
);
return $result;
