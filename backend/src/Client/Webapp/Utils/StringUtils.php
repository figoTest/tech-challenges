<?php
namespace IWD\JOBINTERVIEW\Client\Webapp\Utils;

class StringUtils
{
    public static function _toLowerCase($str)
    {
        return mb_strtolower($str, 'utf-8');
    }
}