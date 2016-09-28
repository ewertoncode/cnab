<?php

/**
 * @autor Ewerton Cardoso
 */

namespace Ewerton\Ewerton\Cnab\Cnab240\Generico;


use Ewerton\Cnab\Arquivo;
use Ewerton\Cnab\Cnab240\Generico\CnabInterface;

abstract class HeaderArquivo implements CnabInterface
{
    use Arquivo;


    /**
     * @return string
     */
    abstract public function criaLinha();

}