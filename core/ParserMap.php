<?php
/**
 * Created by PhpStorm.
 * User: spudro
 * Date: 04.01.2017
 * Time: 21:39
 */

namespace Core;

require_once 'functions.php';

trait ParserMap
{
    /**
     * Она принимает функцию f: x => Parser, которая принимает результат парсинга
     * нашего существующего парсера и возвращает на его основе новый парсер, который продолжает разбор строки с того места,
     * где остановился наш предыдущий парсер.
     *
     */
    public function flatMap(callable $func): Parser
    {
        return
            parser(function ($str) use ($func) {
                /** @var Parser $this */
                $result = $this($str);
                if ($result != Parser::FAILED) {
                    list($x, $rest) = $result;
                    $next = $func($x);
                    $result = $next($rest);
                }
                return $result;

            }, $this);
    }
}