<?php
namespace Klev\MailchimpEC\Request;

use \DrewM\MailChimp\MailChimp;
use \Klev\MailchimpEC\MyInterface\MailchimpECМethod;
use \Klev\MailchimpEC\Myexception\MailchimpECException;

class DeleteProductsRequest implements MailchimpECМethod
{

    public function request($data = array(), $path = array())
    {
        try {

            require_once __DIR__.'/../config/config.php';

            if (!defined('API_KEY_MAILCHIMP')) {
                throw new MailchimpECException('ERROR: No apikey');
            }

            if (!defined('STORE_ID')) {
                throw new MailchimpECException('ERROR: No apikey');
            }

            if ((!isset($path['product_id'])) AND (isset($data['id']))) {
                $path['product_id'] = $data['id'];
            } else {
                throw new MailchimpECException('ERROR: No product_id');
            }

            $MailChimp = new MailChimp(API_KEY_MAILCHIMP);

            $result = $MailChimp->delete("/ecommerce/stores/" . STORE_ID . "/products/" . $path['product_id']);

            if ((!isset($result['status'])) OR ($result['status'] == 404)) {
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
