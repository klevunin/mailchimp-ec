<?php

namespace Klev\MailchimpEC;


class DeleteProductsPrepare implements MailchimpECPrepare
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