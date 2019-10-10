<?php


namespace link\hefang\guid;


class GUKey
{
    private $nameCode = "";

    public function __construct(string $name)
    {
//        $this->nameCode =
        foreach ($name as $char) {

        }
    }

    public function next()
    {
        return join("", [
            intval(microtime(true) * 1000)
        ]);
    }
}