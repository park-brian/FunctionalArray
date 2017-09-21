<?php

namespace FunctionalArray;

class FunctionalArray implements \ArrayAccess, \Iterator, \JsonSerializable {
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

  public static function create($array) {
    return new self($array);
  }

  public function map($callback) {
    $accumulator = [];
    foreach($this->array as $key => $value)
      $accumulator[$key] = $callback($value, $key);
    return new self($accumulator);
  }

  public function filter($callback) {
    $result = array_filter($this->array, $callback, ARRAY_FILTER_USE_BOTH);
    return new self(
      count(array_filter($this->keys, 'is_string')) > 0
        ? $result
        : array_values($result)
    );
  }

  public function reduce($callback, $initialValue = NULL) {
    $accumulator = $initialValue;
    foreach($this->array as $key => $value)
      $accumulator = $callback($accumulator, $value, $key);
    return is_array($accumulator)
      ? new self($accumulator)
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
}
