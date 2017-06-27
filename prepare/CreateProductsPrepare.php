<?php

namespace Klev\MailchimpEC\Prepare;

use \Klev\MailchimpEC\MyInterface\MailchimpECPrepare;
use \Klev\MailchimpEC\Myexception\MailchimpECException;


class CreateProductsPrepare implements MailchimpECPrepare
{
    public function prepareRequest($data)
    {

        try {
            if (!isset($data['id'])) {
                throw new MailchimpECException('ERROR: No id');
            } elseif(!is_string($data['id'])) {
                $data['id']=(string)$data['id'];
            }

            if (!isset($data['title'])) {
                throw new MailchimpECException('ERROR: No title');
            }

            if ((isset($data['variants'])) AND (!is_array($data['variants']))) {
                $data['variants']=(array)$data['variants'];
            }

            foreach ($data['variants'] as $key => $line) {

                if (!isset($line['id'])) {
                    throw new MailchimpECException('ERROR: id variants');
                }

                if (!isset($line['title'])) {
                    throw new MailchimpECException('ERROR: title variants');
                }

                if (!isset($line['price'])) {
                    throw new MailchimpECException('ERROR: price variants');
                } elseif (!is_numeric($line['price'])) {
                    throw new MailchimpECException('ERROR: price variants');
                }

                if ((isset($line['inventory_quantity'])) AND (!is_int($line['inventory_quantity']))) {
                    $data['lines'][$key]['inventory_quantity'] = (int)$line['inventory_quantity'];
                }

            }

            if ((isset($data['images'])) AND (!is_array($data['images']))) {
                $data['images']=(array)$data['images'];

                foreach ($data['images'] as $key => $line) {

                    if (!isset($line['id'])) {
                        throw new MailchimpECException('ERROR: id images');
                    }

                    if (!isset($line['url'])) {
                        throw new MailchimpECException('ERROR: url images');
                    }

                    if ((isset($line['variant_ids'])) AND (!is_array($line['variant_ids']))) {
                        throw new MailchimpECException('ERROR: variant_ids images');
                    }
                }
            }

            return $data;


        } catch (MailchimpECException $e) {
            $e->MailchimpECLog();
            return null;
        }

    }
}