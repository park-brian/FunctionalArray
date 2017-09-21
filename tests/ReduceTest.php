<?php

namespace FunctionalArrayTests;

use FunctionalArray\FunctionalArray;
use PHPUnit\Framework\TestCase;

class ReduceTest extends TestCase {
    public function testReduceNumericToValue() {
        $sum = FunctionalArray::create(range(1, 5))
          ->reduce(function($acc, $value) { return $acc + $value; });
        $this->assertEquals($sum, 15);
    }

    public function testReduceNumericToArray() {
      $numbers = FunctionalArray::create(range(1, 5))
        ->reduce(function($acc, $value) {
          $acc[] = $value + 1;
          return $acc;
        }, [])
        ->get();
      $this->assertEquals($numbers, [2, 3, 4, 5, 6]);
    }
}