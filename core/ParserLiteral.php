<?php
/**
 * Created by PhpStorm.
 * User: spudro
 * Date: 11.01.2017
 * Time: 19:43
 */

namespace Core;


trait ParserLiteral
{
    /**
     * @param string $value
     * @return Parser
     */
    function literal(string $value): Parser
    {
        return take(strlen($value))->onlyIf(function ($actual) use ($value) {
            return $actual === $value;
        });
    }

}