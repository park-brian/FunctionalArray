<?php

namespace FunctionalArrayTests;

use FunctionalArray\FunctionalArray;
use PHPUnit\Framework\TestCase;

class IteratorTest extends TestCase {

    protected $array;
    protected $associativeArray;

    protected function setUp()
    {
      $array = range(1, 10);
      $this->array = FunctionalArray::create($array);

      $associativeArray = [];
      foreach(range('a', 'z') as $index => $letter) {
        $associativeArray[$letter] = $index;
      }
      $this->associativeArray = FunctionalArray::create($associativeArray);
    }

    public function testIterator() {
        $expectedArray = range(1, 10);
        $expectedAssociativeArray = [];
        foreach(range('a', 'z') as $index => $letter) {
            $expectedAssociativeArray[$letter] = $index;
        }

        foreach($this->array as $key => $value) {
            $this->assertEquals($value, $expectedArray[$key]);
        }

        foreach($this->associativeArray as $key => $value) {
            $this->assertEquals($value, $expectedAssociativeArray[$key]);
        }
    }


}