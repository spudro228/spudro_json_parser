<?php
/**
 * Created by PhpStorm.
 * User: spudro
 * Date: 03.01.2017
 * Time: 19:30
 */


use Core\Parser;

ini_set('zend.assertions',  1);
ini_set('assert.exception', 1);
function test(Parser $parser, string $text, array $expected) {
    $actual = $parser($text);
    assert($actual === $expected, print_r(compact('expected','actual'), true));
}
