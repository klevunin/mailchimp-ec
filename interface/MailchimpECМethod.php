<?php

namespace Klev\MailchimpEC\MyInterface;


interface MailchimpECМethod
{
    public function request($data = array(),$path = array());
}