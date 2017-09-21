<?php

namespace FunctionalArray;

use PHPUnit\Framework\TestCase;

class MapTest extends TestCase {

    public function testMapNumeric() {
        $factor = 2;
        $numbers = (new \FunctionalArray(range(1, 10)))
          ->map    (function($value) use ($factor)  { return $value * $factor;  })
          ->filter (function($value)                { return $value >= 10;      });
        $this->assertEquals($numbers->get(), [10, 12, 14, 16, 18, 20]);
    }
}