<?php

/**
 * Created by PhpStorm.
 * User: spudro
 * Date: 03.01.2017
 * Time: 19:30
 */

use Core\Parser;

include 'core\Test.php';

//include 'core\Parser.php';

$loader = require_once __DIR__ . '/vendor/autoload.php';

$alwaysOne = Parser::parser(function ($s) {
    return [1, $s];
});

print_r((just("Hello"))("hello"));
(assert($alwaysOne('123') === [1, '123'])) ? print ("Test one is successful !!!\n") : print("Test one is failed!!!\n");

test(take(2), 'abc', ['ab', 'c']);
test(take(4), 'abc', Parser::FAILED);

test(take(10)->orElse(take(2)), 'abc', ['ab', 'c']);

test(
    take(1)->flatMap(function($x) { # x -- результат парсинга take(1)
        return take(2)->flatMap(function($y) use ($x) { # y -- результат парсинга take(2)
            return just("$x~$y"); # -- финальный результат
        });
    }),
    'a234',
    ['a~23','4']
);

test(none()->literal("test"),"test1", ['test','1']);