<?php

namespace FunctionalArrayTests;

use FunctionalArray\FunctionalArray;
use PHPUnit\Framework\TestCase;

class CreateTest extends TestCase {
    public function testCreate() {
        $values = range(1, 10);
        $numbers = FunctionalArray::create($values)->get();
        $this->assertEquals($numbers, $values);
    }
}