<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;

class GenerateRandomNumber
{
  const LENGTH = 16;

  public static function gen(string $ModelClass, string $field, $len = null)
  {
    if (!$len) $len = static::LENGTH;

    $min = pow(10, $len - 1);
    $max = pow(10, $len) - 1;
    $number = mt_rand($min, $max);

    if ($ModelClass::where($field, $number)->exists()) {
      return static::gen($ModelClass, $field);
    }

    return $number;
  }
}
