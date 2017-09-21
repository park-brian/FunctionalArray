<?php

namespace FunctionalArrayTests;

use FunctionalArray\FunctionalArray;
use PHPUnit\Framework\TestCase;

class ReduceTest extends TestCase {
    public function testReduceNumeric() {
        $sum = FunctionalArray::create(range(1, 5))
          ->reduce(function($acc, $value) { return $acc + $value; });
        $this->assertEquals($sum, 15);
    }
}