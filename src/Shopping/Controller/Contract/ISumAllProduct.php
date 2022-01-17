<?php

namespace Src\Shopping\Controller\Contract;

interface ISumAllProduct
{
    public function __invoke($sessionName): int;
}