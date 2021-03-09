<?php

namespace App\Restaurant\Presentation\CLI;

use App\Restaurant\Parser\Parser;

class ParserHandler
{
    private iterable $parsers;

    public function __construct(iterable $parsers)
    {
        $this->parsers = $parsers;
    }

    public function parse() : void
    {
        /** @var Parser $parser */
        foreach ($this->parsers as $parser){
            $parser->parse();
        }
    }
}