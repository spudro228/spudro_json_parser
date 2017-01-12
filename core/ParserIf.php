<?php
/**
 * Created by PhpStorm.
 * User: spudro
 * Date: 11.01.2017
 * Time: 19:19
 */

namespace Core;

require_once 'functions.php';

trait ParserIf
{
    /**
     *  Gозволяет уточнить действие парсера и проверить его результат на соответствие какому-то критерию
     * @param callable $predicate
     * @return Parser
     */
    function onlyIf(callable $predicate): Parser
    {
        /** @var Parser $this */
        return $this->flatMap(function ($x) use ($predicate) {
            return $predicate($x) ? just($x) : none();
        });
    }
}