<?php

namespace App\Tests\_support;

use Doctrine\ORM\EntityManagerInterface;

interface Doctrine2TesterInterface
{
    /**
     * @param $classNameOrInstance
     * @param array $data
     * @return mixed
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function haveInRepository($classNameOrInstance, array $data = []);
}