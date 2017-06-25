<?php

namespace Klev\MailchimpEC;


class EditProductsPrepare implements MailchimpECPrepare
{
    public function prepareRequest($data)
    {
        try {

            if ((isset($data['variants'])) AND (!is_array($data['variants']))) {
                $data['variants'] = (array)$data['variants'];

                foreach ($data['variants'] as $key => $line) {
                    if ((isset($line['price'])) AND ((!is_numeric($line['price'])))) {
                        throw new \Exception('ERROR: price variants');
                    }

                    if ((isset($line['inventory_quantity'])) AND (!is_int($line['inventory_quantity']))) {
                        $data['lines'][$key]['inventory_quantity'] = (int)$line['inventory_quantity'];
                    }
                }
            }

            if ((isset($data['images'])) AND (!is_array($data['images']))) {
                $data['images'] = (array)$data['images'];
            }

            return $data;
        } catch (Exception $e) {
            echo $e->getMessage(), "\n";
        }
    }
}