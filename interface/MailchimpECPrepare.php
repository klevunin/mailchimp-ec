<?php
namespace Klev\MailchimpEC\MyInterface;

interface MailchimpECPrepare
{

    /**
     * @param $data
     * @return mixed
     */
    public function prepareRequest($data);
}