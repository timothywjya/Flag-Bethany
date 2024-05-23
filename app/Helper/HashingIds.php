<?php

namespace App\Helper;

use Hashids\Hashids;
use Exception;

class HashingIds
{
    public static function encodeUser($data)
    {
        try {
            $encoding = new Hashids('4zuraX3line', 12);
            return $encoding->encode($data);
        } catch (Exception $e) {
            return "Failed to Encode Data: " . $e->getMessage();
        }
    }

    public static function decodeUser($data)
    {
        try {
            $decoding = new Hashids('4zuraX3line', 12);
            return $decoding->decode($data)[0];
        } catch (Exception $e) {
            return "Failed to Decode Data";
        }
    }

    public static function encodeRole($data)
    {
        try {
            $encoding = new Hashids('Melv1nA4d3linE', 14);
            return $encoding->encode($data);
        } catch (Exception $e) {
            return "Failed to Encode Data: " . $e->getMessage();
        }
    }

    public static function decodeRole($data)
    {
        try {
            $decoding = new Hashids('Melv1nA4d3linE', 12);
            return $decoding->decode($data)[0];
        } catch (Exception $e) {
            return "Failed to Decode Data" . $e->getMessage();
        }
    }

    public static function convertHashIds($data)
    {
        if ($data) {
            foreach ($data as $key => $value) {
                $value->ids = HashIds::encode($value->id);
                unset($value->id);
            }
        }

        return $data;
    }
}
