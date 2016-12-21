<?php
/**
 * Created by PhpStorm.
 * User: murilo
 * Date: 14/12/16
 * Time: 13:21
 */

namespace Ewerton\Cnab\Cnab400\BB;


use Ewerton\Cnab\Cnab240\Generico\CnabInterface;
use Ewerton\Cnab\Cnab400\Generico\HeaderGenerico;

class Header extends HeaderGenerico
{
    private $cobranca = 'COBRANCA';
    private $sequencialRemessa;
    private $agencia;
    private $agenciaDv;
    private $conta;
    private $contaDv;

    public function getCobranca()
    {
        return sprintf("%-8s", $this->cobranca);
    }

    public function getCodigoCedente()
    {
        return sprintf("%07d", $this->codigoCedente);
    }

    /**
     * @return mixed
     */
    public function getSequencialRemessa()
    {
        return $this->sequencialRemessa;
    }

    /**
     * @param mixed $sequencialRemessa
     * @return Header
     */
    public function setSequencialRemessa($sequencialRemessa)
    {
        $this->sequencialRemessa = sprintf("%07d", $sequencialRemessa);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAgencia()
    {
        return sprintf("%04d", $this->agencia);
    }

    /**
     * @param mixed $agencia
     * @return Header
     */
    public function setAgencia($agencia)
    {
        $this->agencia = $agencia;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAgenciaDv()
    {
        return sprintf("%01d", $this->agenciaDv);
    }

    /**
     * @param mixed $agenciaDv
     * @return Header
     */
    public function setAgenciaDv($agenciaDv)
    {
        $this->agenciaDv = $agenciaDv;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getConta()
    {
        return sprintf("%08d", $this->conta);
    }

    /**
     * @param mixed $conta
     * @return Header
     */
    public function setConta($conta)
    {
        $this->conta = $conta;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContaDv()
    {
        return sprintf("%01d", $this->contaDv);
    }

    /**
     * @param mixed $contaDv
     * @return Header
     */
    public function setContaDv($contaDv)
    {
        $this->contaDv = $contaDv;
        return $this;
    }


    public function criaLinha()
    {
        // TODO: Implement criaLinha() method.
        //pos [1-9]
        $linha = '01REMESSA';
        //pos [10-11]
        $linha .= '01';
        //pos [12-19]
        $linha .= $this->getCobranca();
        //pos [20-26]
        $linha .= str_pad('', 7);
        //pos [27-30]
        $linha .= $this->getAgencia();
        //pos [31-31]
        $linha .= $this->getAgenciaDv();
        //pos [32-39]
        $linha .= $this->getConta();
        //pos [40-40]
        $linha .= $this->getContaDv();
        //pos [41-46]
        $linha .= str_pad('', 6, 0);
        //pos [47-76]
        $linha .= $this->getNomeEmpresa();
        //pos [77-94]
        $linha .= '001BANCODOBRASIL  ';
        //pos [95-100]
        $linha .= $this->getDataGravacao();
        //pos [101-107]
        $linha .= $this->getSequencialRemessa();
        //pos [108-129]
        $linha .= str_pad('', 22);
        //pos [130-136]
        $linha .= $this->getCodigoCedente();
        //pos [137-394]
        $linha .= str_pad('', 258);
        //pos [395-400]
        $linha .= '000001';

        $linha .= "\r\n";

        return $linha;
    }

}

