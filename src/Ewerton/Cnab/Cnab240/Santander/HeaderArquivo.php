<?php

namespace Ewerton\Cnab\Cnab240\Satander;



class HeaderArquivo extends \Ewerton\Ewerton\Cnab\Cnab240\Generico\HeaderArquivo
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