<?php

namespace Klev\MailchimpEC;


interface MailchimpECМethod
{
    public function request($data = array(),$path = array());
}