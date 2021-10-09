<?php

namespace App\Tests\_support;

interface Doctrine2TesterInterface
{
    /**
     * @param $obj
     * @param array $values
     * @return mixed
     * @noinspection PhpMissingParamTypeInspection
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function persistEntity($obj, $values = []);
}