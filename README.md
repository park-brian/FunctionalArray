# FunctionalArray
[![Build Status](https://travis-ci.org/park-brian/functional-array.svg?branch=master)](https://travis-ci.org/park-brian/functional-array)
[![Test Coverage](https://codeclimate.com/github/park-brian/functional-array/badges/coverage.svg)](https://codeclimate.com/github/park-brian/functional-array/coverage)

Functional PHP arrays

## Getting Started

```bash
composer require park-brian/functional-array
```

## Usage
```php
<?php

use FunctionalArray\FunctionalArray as FnArray;

$sum = FnArray(create(range(1, 10)))
  ->map     (function($value) { return $value * 2;  })
  ->filter  (function($value) { return $value > 10; })
  ->reduce  (function($acc = 0, $value) { return $acc + $value });

echo $sum;

$fruitRatings = [
    'apples' => 70,
    'bananas' => 80,
    'cherries' => 90,
    'dragonfruit' => 100
];

$favoriteFruits = FnArray::create($fruitRatings)
  ->filter (function($value)        { return $value >= 80; })
  ->map    (function($value, $key)  { return "Rating for $key: $value"; })
  ->reduce (function($acc, $value)  { return " $acc \n $value"; })

echo $favoriteFruits;

```
