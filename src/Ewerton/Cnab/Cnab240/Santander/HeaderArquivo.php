<?php

namespace Ewerton\Cnab\Cnab240\Santander;

use Ewerton\Cnab\Cnab240\Generico\HeaderArquivo as HeaderArquivoGenerico;

class HeaderArquivo extends HeaderArquivoGenerico
{

    /**
     * @return string
     */
    public function criaLinha()
    {

        $linha = $this->getCodigoBanco();
        $linha .= $this->getLote();

        return $linha;

    }

}