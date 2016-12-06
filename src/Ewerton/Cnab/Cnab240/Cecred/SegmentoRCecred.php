<?php

namespace Ewerton\Cnab\Cnab240\Cecred;

use Ewerton\Cnab\Cnab240\Generico\SegmentoR as SegmentoRGenerico;

class SegmentoRCecred extends SegmentoRGenerico
{

    protected $dataDaMulta;

    /**
     * @param float $valor
     * @param float $multa
     * @return $this
     */
    public function setValorMulta($valor, $multa)
    {
        $this->valorMulta = $multa;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDataDaMulta()
    {
        return sprintf("%08d", $this->dataDaMulta);

    }

    /**
     * @param mixed $dataDaMulta
     * @return $this
     */
    public function setDataDaMulta(\DateTime $dataDaMulta)
    {
        $this->dataDaMulta = $dataDaMulta->format("dmY");
        return $this;
    }


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
        //pos[42, 65]
        $linha .= sprintf(str_pad('', 24, '0'));
        //pos[66-66] - código Multa
        $linha .= 2;
        //pos[67-74] Data da multa
        $linha .= $this->getDataDaMulta();
        //pos[75-89]
        $linha .= $this->getValorMulta();
        //pos[90-99]
        $linha .= sprintf(str_pad('', 10));
        //pos[100-139] Mensagem 3
        $linha .= sprintf(str_pad('', 40));
        //pos[140-179] Mensagem 4
        $linha .= sprintf(str_pad('', 40));
        //pos[180-199]
        $linha .= sprintf(str_pad('', 20));
        //pos[200-215]
        $linha .= sprintf(str_pad('', 16, '0'));
        //pos[216-216]
        $linha .= sprintf(str_pad('', 1));
        //pos[217-228]
        $linha .= sprintf(str_pad('', 12, '0'));
        //pos[229-230]
        $linha .= sprintf(str_pad('', 2));
        //pos[231-231]
        $linha .= sprintf(str_pad('', 1, '0'));
        //pos[232-240]
        $linha .= sprintf(str_pad('', 9));
        $linha .= "\r\n";

        return $linha;

    }

}