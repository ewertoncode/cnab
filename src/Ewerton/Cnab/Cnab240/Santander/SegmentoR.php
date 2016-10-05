<?php

namespace Ewerton\Cnab\Cnab240\Santander;

use Ewerton\Cnab\Cnab240\Generico\SegmentoR as SegmentoRGenerico;

class SegmentoR extends SegmentoRGenerico
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
        //pos[9-13]
        $linha .= $this->getNumeroSequencialArquivo();
        //pos[14-14]
        $linha .= $this->getCodSegmento();
        //pos[15-15]
        $linha .= sprintf(str_pad('', 1));
        //pos[16-17]
        $linha .= $this->getCodMovimentoRemessa();
        //pos[18-18] Código do desconto 2
        $linha .= 0;
        //pos[19-26] Data do desconto 2
        $linha .= '00000000';
        //pos[27-41] Valor/Percentual a ser concedido
        $linha .= '000000000000000';
        //pos[]
        $linha .= sprintf(str_pad('', 24));
        //pos[66-66]
        $linha .= 1;
        //pos[67-74] Data da multa
        $linha .= $this->getDataMulta();
        //pos[75-89]
        $linha .= $this->getValorMulta();
        //pos[90-99]
        $linha .= sprintf(str_pad('', 10));
        //pos[] Mensagem 3
        $linha .= sprintf(str_pad('', 40));
        //pos[] Mensagem 4
        $linha .= sprintf(str_pad('', 40));
        //pos[180-240]
        $linha .= sprintf(str_pad('', 61));

        $linha .= "\n";

        return $linha;

    }

}