<?php

/**
 * Define propriadados comuns ao padrão CNAB240, setanado propriedades de acordo com o tamanho e picture de cada um
 * @autor Ewerton Cardoso
 */


namespace Ewerton\Cnab\Cnab240\Generico;


trait Arquivo
{

    private $codigoBanco;

    private $banco;

    private $lote = '0000';

    private $registro = '0';

    /**
     * @return mixed
     *
     */
    public function getCodigoBanco()
    {
        return $this->codigoBanco;
    }

    /**
     * @param mixed $codigoBanco
     * @throws \Exception
     * @return Arquivo
     * Caixa = 104, Santander = 033
     * pos: [1, 3]
     * picture: '9(3)'
     */
    public function setCodigoBanco($codigoBanco)
    {
        if((int) $codigoBanco > 0) {
            $this->codigoBanco = sprintf("%03d", (int)$codigoBanco);
        } else {
            throw new \Exception("Código de banco inválido");
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getBanco()
    {
        return $this->banco;
    }

    /**
     * @return Arquivo
     */
    public function setBanco()
    {
        $this->banco = Banco::getBanco($this->getCodigoBanco());
        return $this;
    }

    /**
     * @return string
     */
    public function getLote()
    {
        return $this->lote;
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
    public function setRegistro($registro)
    {
        $this->registro = $registro;
        return $this;
    }

}