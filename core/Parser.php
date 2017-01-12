<?php
/**
 * Created by PhpStorm.
 * User: spudro
 * Date: 03.01.2017
 * Time: 20:22
 */

namespace Core;

class Parser
{

    const FAILED = [];
    # function(string): FAILED | [x,string]
    private $parse;

    function __construct(callable $parse)
    {
        $this->parse = $parse;

    }

    /**
     * This is Constructor
     * @param \Closure $function
     * @param null $scope
     * @return Parser
     */
    public static function parser(\Closure $function, $scope = null)
    {
        return new Parser($function->bindTo($scope));
    }

    /**
     * String => Array
     * @param string $s
     * @return array|string
     */
    function __invoke(string $s): array
    {
        return ($this->parse)($s);
    }

    use ParserOr;
    use ParserMap;
    use ParserIf;
    use ParserLiteral;

}

require_once 'functions.php';




