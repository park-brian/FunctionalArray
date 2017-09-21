<?php

/**
 * A simple class that wraps a PHP array in a functional way.
 *
 * Example Usage:
 *
 *   $val = (new FunctionalArray(range(1, 10)))
 *     ->map    (function($value)      { return $value * 1;   })
 *     ->filter (function($value)      { return $value > 5;   })
 *     ->reduce (function($acc, $curr) { return $acc + $curr; }, 0);
 *
 *   print_r($val);
 */

class FunctionalArray implements ArrayAccess, Iterator, JsonSerializable {
  private $array = [];
  private $keys = [];
  private $position = null;
  
  public function __construct($array = []) {
    $this->array = $array;
    $this->keys = array_keys($array);
    $this->position = array_key_exists(0, $this->keys)
        ? $this->keys[0]
        : null;
  }
  
  public function map($callback) {
    $new = [];
    foreach($this->array as $key => $value) {
      $new[$key] = $callback($value, $key);
    }
    return new FunctionalArray($new);
  }
  
  public function filter($callback) {
    $result = array_filter($this->array, $callback, ARRAY_FILTER_USE_BOTH);
    return new FunctionalArray(
      self::has_string_keys($this->array)
        ? $result
        : array_values($result)
    );
  }
  
  public function reduce($callback, $initialValue = NULL) {
    $accumulator = $initialValue;
    foreach($this->array as $key => $value) {
      $accumulator = $callback($accumulator, $value, $key);
    }

    return is_array($accumulator)
      ? new FunctionalArray($accumulator)
      : $accumulator;
  }

  public function get() {
    return $this->array;
  }

  public function offsetExists($offset) {
    return array_key_exists($offset, $this->array);
  }
  
  public function offsetGet($offset) {
    return $this->array[$offset];
  }
  
  public function offsetSet($offset, $value) {
    $this->array[$offset] = $value;
  }
  
  public function offsetUnset($offset) {
    unset($this->array[$offset]);
  }

  public function rewind() {
    $this->position = 0;
  }

  public function current() {
    return $this->array[
      $this->keys[$this->position]
    ];
  }

  public function key() {
    return $this->keys[$this->position];
  }

  public function next() {
    ++$this->position;
  }

  public function valid() {
    return 
      isset($this->keys[$this->position]) && 
      isset($this->array[
        $this->keys[$this->position]      
      ]);
  }

  public function jsonSerialize() {
    return json_encode($this->array);
  }

  private static function has_string_keys(array $array) {
    return count(array_filter(array_keys($array), 'is_string')) > 0;
  }
}
