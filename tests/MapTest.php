<?php

namespace FunctionalArrayTests;

use FunctionalArray\FunctionalArray;
use PHPUnit\Framework\TestCase;

class MapTest extends TestCase {
    public function testMapNumeric() {
        $factor = 2;
        $numbers = FunctionalArray::create(range(5, 10))
          ->map(function($value) use ($factor) { return $value * $factor; })
          ->get();
        $this->assertEquals($numbers, [10, 12, 14, 16, 18, 20]);
    }
}