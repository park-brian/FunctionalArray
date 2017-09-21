<?php

namespace FunctionalArrayTests;

use FunctionalArray\FunctionalArray;
use PHPUnit\Framework\TestCase;

class FilterTest extends TestCase {
    public function testFilterNumeric() {
        $numbers = FunctionalArray::create(range(1, 10))
            ->filter (function($value) { return $value > 5; })
            ->get();
        $this->assertEquals($numbers, [6, 7, 8, 9, 10]);
    }
}