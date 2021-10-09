<?php declare(strict_types=1);

namespace App\Tests\_support;

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