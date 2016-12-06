<?php

namespace Ewerton\Cnab\Cnab240\Banrisul;

use Ewerton\Cnab\Cnab240\Generico\TrailerLote as TrailerLoteGenerico;

class TrailerLoteBanrisul extends TrailerLoteGenerico
{

    protected $totalParcelas;
    protected $valorTotalTitulos;

    /**
     * @return mixed
     */
    public function getValorTotalTitulos()
    {
        return $this->valorTotalTitulos;
    }

    /**
     * @param mixed $valorTotalTitulos
     * @return $this
     */
    public function setValorTotalTitulos($valorTotalTitulos)
    {
        $this->valorTotalTitulos = sprintf("%017d", $valorTotalTitulos);
        return $this;
    }



    /**
     * @return mixed
     */
    public function getTotalParcelas()
    {
        return $this->totalParcelas;
    }

    /**
     * @param mixed $totalParcelas
     * @return $this
     */
    public function setTotalParcelas($totalParcelas)
    {
        $this->totalParcelas = $totalParcelas;
        return $this;
    }




    /**
     * @return string
     */
    public function criaLinha()
    {
        //pos[1-3]
        $linha = '041';
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
        //pos[116-240]
        $linha .= sprintf(str_pad('', 125));

        $linha .= "\r\n";

        return $linha;

    }

}