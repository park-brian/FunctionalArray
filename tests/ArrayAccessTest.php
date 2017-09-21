<?php

namespace FunctionalArrayTests;

use FunctionalArray\FunctionalArray;
use PHPUnit\Framework\TestCase;

class ArrayAccessTest extends TestCase {

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

    public function testOffsetGet() {
        $numbers = $this->array;
        $letters = $this->associativeArray;

        $this->assertEquals($numbers[0], 1);
        $this->assertEquals($numbers[9], 10);

        $this->assertEquals($letters['a'], 0);
        $this->assertEquals($letters['z'], 25);
    }

    public function testOffsetGetFunction() {
        $numbers = $this->array;
        $letters = $this->associativeArray;

        $this->assertEquals($numbers->offsetGet(0), 1);
        $this->assertEquals($numbers->offsetGet(9), 10);

        $this->assertEquals($letters->offsetGet('a'), 0);
        $this->assertEquals($letters->offsetGet('z'), 25);
    }

    public function testOffsetSet() {
        $numbers = $this->array;
        $letters = $this->associativeArray;

        $numbers[0] = 1000;
        $numbers[9] = 10000;

        $letters['a'] = 1010;
        $letters['alpha'] = 'a';
        $letters['beta'] = 'b';
        $letters['gamma'] = 'g';

        $this->assertEquals($numbers[0], 1000);
        $this->assertEquals($numbers[9], 10000);

        $this->assertEquals($letters['a'], 1010);
        $this->assertEquals($letters['alpha'], 'a');
        $this->assertEquals($letters['beta'], 'b');
        $this->assertEquals($letters['gamma'], 'g');
    }

    public function testOffsetSetFunction() {
        $numbers = $this->array;
        $letters = $this->associativeArray;

        $numbers->offsetSet(0, 1000);
        $numbers->offsetSet(9, 10000);

        $letters->offsetSet('a', 1010);;
        $letters->offsetSet('alpha', 'a');;
        $letters->offsetSet('beta', 'b');;
        $letters->offsetSet('gamma', 'g');

        $this->assertEquals($numbers[0], 1000);
        $this->assertEquals($numbers[9], 10000);

        $this->assertEquals($letters['a'], 1010);
        $this->assertEquals($letters['alpha'], 'a');
        $this->assertEquals($letters['beta'], 'b');
        $this->assertEquals($letters['gamma'], 'g');
    }
}