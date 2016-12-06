<?php

namespace Ewerton\Cnab\Cnab240\Sicoob;

use Ewerton\Cnab\Cnab240\Generico\TrailerLote as TrailerLoteGenerico;

class TrailerLoteSicoob extends TrailerLoteGenerico
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
        //pos[24-115]
        $linha .= sprintf(str_pad('', 92, '0'));
        //pos[116-123]
        $linha .= sprintf(str_pad('', 8));
        //pos[124-240]
        $linha .= sprintf(str_pad('', 117));

        $linha .= "\r\n";

        return $linha;

    }

}