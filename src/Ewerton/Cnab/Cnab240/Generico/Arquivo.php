<?php

/**
 * Define propriadados comuns ao padrão CNAB240, setanado propriedades de acordo com o tamanho e picture de cada um
 * @autor Ewerton Cardoso
 */


namespace Ewerton\Cnab\Cnab240\Generico;


use Ewerton\Cnab\Banco;
use Symfony\Component\Config\Definition\Exception\Exception;

trait Arquivo
{

    private $codigoBanco;

    private $banco;

    private $lote;

    private $registro;

    public function __construct($codigoBanco)
    {
        if((int) $codigoBanco > 0) {
            $this->codigoBanco = sprintf("%03d", (int)$codigoBanco);
            $this->banco = str_pad(substr(strtoupper(Banco::getBanco($this->getCodigoBanco())['nome_do_banco']), 0,30), 30);
        } else {
            throw new \Exception("Código de banco inválido");
        }
    }

    /**
     * @return mixed
     *
     */
    public function getCodigoBanco()
    {
        return $this->codigoBanco;
    }


    /**
     * @return string
     */
    public function getBanco()
    {
        return $this->banco;
    }


    /**
     * @return string
     */
    public function getLote()
    {
        return sprintf("%04d", $this->lote);
    }

    /**
     * @param string $lote
     * @return Arquivo
     */
    public function setLote($lote)
    {
        $this->lote = $lote;
        return $this;
    }

    /**
     * @return string
     */
    public function getRegistro()
    {
        return $this->registro;
    }

    /**
     * @param string $registro
     * @return Arquivo
     */
    public function setRegistro($registro = '0')
    {
        if(strlen($registro) == 1) {
            $this->registro = $registro;
        } else {
            throw new Exception("Tamanho inválido");
        }

        return $this;
    }

}