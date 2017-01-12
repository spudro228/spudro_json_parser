<?php
/**
 * Created by PhpStorm.
 * User: spudro
 * Date: 03.01.2017
 * Time: 23:16
 */
use Core\Parser;

/**
 * @return Parser
 */
function none(): Parser
{
    return parser(function ($s) {
        return Parser::FAILED;
    });
}

/**
 * This is Constructor
 * @param \Closure $function
 * @param null $scope - Область видимость. Чтобы можно было передать $this
 * @return Parser
 */
function parser(\Closure $function, $scope = null)
{
    return new Parser($function->bindTo($scope));
}

/**
 * todo: если предается один аргумент.
 * todo:  документирууемые пременные
 * Просто выводит переданные строки
 * string | string, string => [string,string] | []
 *
 * (just("a"))("b"); => [0] => "a", [1] => "b"
 *
 * just("a"); => [0] = "a", [1] = <require>
 * @param string $x
 * @return Parser
 */
function just($x): Parser
{
    return parser(function (string $s) use ($x) {
        return [$x, $s];
    });
}

/**
 * @param int $number_of_symbol - количество символов из строки
 * @return Parser
 */
function take(int $number_of_symbol): Parser
{
    return
        parser(/**
         * @param $string - сама строка
         * @return array
         */
            function ($string) use ($number_of_symbol) {
                return
                    strlen($string) < $number_of_symbol ?
                        Parser::FAILED :                            //return PANIC
                        [
                            substr($string, 0, $number_of_symbol),  // [0]
                            substr($string, $number_of_symbol)      // [1]
                        ];
            });
}










