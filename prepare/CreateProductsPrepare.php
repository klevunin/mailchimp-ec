<?php

namespace Klev\MailchimpEC;


class CreateProductsPrepare implements MailchimpECPrepare
{
    public function prepareRequest($data)
    {

        try {
            if (!isset($data['id'])) {
                throw new \Exception('ERROR: No id');
            } elseif(!is_string($data['id'])) {
                $data['id']=(string)$data['id'];
            }

            if (!isset($data['title'])) {
                throw new \Exception('ERROR: No title');
            }

            if ((isset($data['variants'])) AND (!is_array($data['variants']))) {
                $data['variants']=(array)$data['variants'];
            }

            foreach ($data['variants'] as $key => $line) {

                if (!isset($line['id'])) {
                    throw new \Exception('ERROR: id variants');
                }

                if (!isset($line['title'])) {
                    throw new \Exception('ERROR: title variants');
                }

                if (!isset($line['price'])) {
                    throw new \Exception('ERROR: price variants');
                } elseif (!is_numeric($line['price'])) {
                    throw new \Exception('ERROR: price variants');
                }

                if ((isset($line['inventory_quantity'])) AND (!is_int($line['inventory_quantity']))) {
                    $data['lines'][$key]['inventory_quantity'] = (int)$line['inventory_quantity'];
                }

            }

            if ((isset($data['images'])) AND (!is_array($data['images']))) {
                $data['images']=(array)$data['images'];

                foreach ($data['images'] as $key => $line) {

                    if (!isset($line['id'])) {
                        throw new \Exception('ERROR: id images');
                    }

                    if (!isset($line['url'])) {
                        throw new \Exception('ERROR: url images');
                    }

                    if ((isset($line['variant_ids'])) AND (!is_array($line['variant_ids']))) {
                        throw new \Exception('ERROR: variant_ids images');
                    }
                }
            }

            return $data;


        } catch (Exception $e) {
            echo $e->getMessage(), "\n";
        }

    }
}