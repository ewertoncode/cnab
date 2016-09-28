<?php

/**
 * @autor Ewerton Cardoso
 */

namespace Ewerton\Cnab\Cnab240\Generico;


use Ewerton\Cnab\Cnab240\Generico\CnabInterface;

abstract class HeaderArquivo implements CnabInterface
{
    use Arquivo;


    /**
     * @return string
     */
    abstract public function criaLinha();

}