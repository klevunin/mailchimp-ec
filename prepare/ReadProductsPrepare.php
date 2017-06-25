<?php

namespace Klev\MailchimpEC;


class ReadProductsPrepare implements MailchimpECPrepare
{
    public function prepareRequest($data)
    {
        try {
            return $data;
        } catch (Exception $e) {
            echo $e->getMessage(), "\n";
        }
    }
}