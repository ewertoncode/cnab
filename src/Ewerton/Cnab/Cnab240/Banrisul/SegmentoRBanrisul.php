<?php

namespace Ewerton\Cnab\Cnab240\Banrisul;

use Ewerton\Cnab\Cnab240\Generico\SegmentoR as SegmentoRGenerico;

class SegmentoRBanrisul extends SegmentoRGenerico
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
        //pos[42-65]
        $linha .= sprintf(str_pad('', 24, '0'));
        //pos[66-66]
        $linha .= 1;
        //pos[67-74] Data da multa
        $linha .= $this->getDataMulta();
        //pos[75-89]
        $linha .= $this->getValorMulta();
        //pos[90-99]
        $linha .= sprintf(str_pad('', 10));
        //pos[100-139] Mensagem 3
        $linha .= sprintf(str_pad('', 40));
        //pos[140-179] Mensagem 4
        $linha .= sprintf(str_pad('', 40));
        //pos[180-207]
        $linha .= sprintf(str_pad('', 28, '0'));
        //pos[208-240]
        $linha .= sprintf(str_pad('', 33));

        $linha .= "\r\n";

        return $linha;

    }

}