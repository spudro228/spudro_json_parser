<?php
/**
 * Created by PhpStorm.
 * User: spudro
 * Date: 04.01.2017
 * Time: 14:47
 */

namespace Core;

require_once 'functions.php';

    trait ParserOr
    {
        /**
         * Применяет альтернативный парсер к строке,
         * если предыдущий не сработал.
         *
         * $a->orElse($b)->orElse($c)->orElse($d)
         *
         * @param \core\Parser $alternative
         * @return \core\Parser
         */
        public function orElse(Parser $alternative): Parser
        {
            return
                parser(function ($str) use ($alternative) {
                    /** @var Parser $this - это замыкание которое обрабатывает мотод orElse
                     * take(10)->orElse(take(2) - $this = (Clojure) take(10)
                     This is __invoke method
                     *
                     */
                    $result = $this($str);
                    if ($result === Parser::FAILED) {
                        $result = $alternative($str);
                    }
                    return $result;
                }, $this);
        }
    }


