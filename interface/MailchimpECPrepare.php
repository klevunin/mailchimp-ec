<?php
namespace Klev\MailchimpEC;


interface MailchimpECPrepare
{
    /**
     * @param $data
     * @return mixed
     */
    public function prepareRequest($data);
}