<?php

namespace FunctionalArrayTests;

use FunctionalArray\FunctionalArray;
use PHPUnit\Framework\TestCase;

class JsonSerializableTest extends TestCase {

    protected $array;
    protected $associativeArray;

    protected function setUp()
    {
      $array = range(1, 10);
      $this->array = FunctionalArray::create($array);

      $associativeArray = [];
      foreach(range('a', 'f') as $index => $letter) {
        $associativeArray[$letter] = $index;
      }
      $this->associativeArray = FunctionalArray::create($associativeArray);
    }

    public function testJsonSerialize() {
      $numbers = $this->array;
      $letters = $this->associativeArray;

      $this->assertEquals(
          json_encode($numbers->jsonSerialize()),
          "[1,2,3,4,5,6,7,8,9,10]"
      );

      $this->assertEquals(
          json_encode($letters->jsonSerialize()),
          '{"a":0,"b":1,"c":2,"d":3,"e":4,"f":5}'
      );
    }

    public function testJsonEncode() {
        $numbers = $this->array;
        $letters = $this->associativeArray;

        //echo $numbers;


        json_encode(new FunctionalArray([1, 2, 3]));

        $this->assertEquals(
            json_encode($numbers),
            "[1,2,3,4,5,6,7,8,9,10]"
        );

        $this->assertEquals(
            json_encode($letters),
            '{"a":0,"b":1,"c":2,"d":3,"e":4,"f":5}'
        );
    }
}