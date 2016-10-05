<?php

namespace Ewerton\Cnab\Cnab240\Santander;

use Ewerton\Cnab\Cnab240\Generico\TrailerArquivo as TrailerArquivoGenerico;

class TrailerArquivo extends TrailerArquivoGenerico
{


    /**
     * @return string
     */
    public function criaLinha()
    {
        //pos[1-3]
        $linha = $this->getCodigoBanco();
        //pos[4-7]
        $linha .= $this->getLote();
        //post[8-8]
        $linha .= $this->getRegistro();
        //pos[9-17]
        $linha .= sprintf(str_pad('', 9));
        //pos[18-23]
        $linha .= $this->getQtdRegistros();
        //pos[24-240]
        $linha .= sprintf(str_pad('', 217));

        $linha .= "\n";

        return $linha;

    }

}