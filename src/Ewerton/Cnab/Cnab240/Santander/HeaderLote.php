<?php

/**
 * @autor Ewerton Cardoso
 */

namespace Ewerton\Cnab\Cnab240\Santander;


use Ewerton\Cnab\Cnab240\Generico\HeaderLote as HeaderLoteGenerico;


class HeaderLote extends HeaderLoteGenerico
{

    protected $codigoTransmissao;

    protected $numeroRemessaRetorno;


    /**
     * @return mixed
     */
    public function getCodigoTransmissao()
    {
        return $this->codigoTransmissao;
    }

    /**
     * Código de Transmissão
     * pos: [33, 47]
     * picture: '9(15)'
     * @param integer $agencia
     * @param integer $agencia_dv
     * @param integer $convenio
     * @throws \Exception
     * @return HeaderArquivo
     */
    public function setCodigoTransmissao($agencia, $agencia_dv, $convenio)
    {
        $this->codigoTransmissao = sprintf("%04d", $agencia).$agencia_dv.sprintf("%010d", $convenio);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumeroRemessaRetorno()
    {
        return sprintf("%08d", $this->numeroRemessaRetorno);
    }

    /**
     * @param mixed $numeroRemessaRetorno
     * @return HeaderLote
     */
    public function setNumeroRemessaRetorno($numeroRemessaRetorno)
    {
        $this->numeroRemessaRetorno = $numeroRemessaRetorno;
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
        //pos[9-9]
        $linha .= $this->getTipoOperacao();
        //pos[10-11]
        $linha .= $this->getTipoServico();
        //pos[12-13]
        $linha .= sprintf(str_pad('', 2));
        //pos[14-16]
        $linha .= $this->getNVersaoLayout();
        //pos[17-17]
        $linha .= sprintf(str_pad('', 1));
        //pos[18-18]
        $linha .= $this->getTipoEmpresa();
        //pos[19-33]
        $linha .= $this->getInscricao();
        //pos[34–53]
        $linha .= sprintf(str_pad('', 20));
        //pos[54–68]
        $linha .= $this->getCodigoTransmissao();
        //pos[54–68]
        $linha .= sprintf(str_pad('', 5));
        //pos[74-103]
        $linha .= $this->getNomeEmpresa();
        //mensagem1 e 2
        $linha .= sprintf(str_pad('', 80));
        //pos[184-191]
        $linha .= $this->getNumeroRemessaRetorno();
        //pos[192-199]
        $linha .= $this->getDataGravacao();
        //pos[200-240]
        $linha .= sprintf(str_pad('', 41));
        $linha .= "\r\n";

        return $linha;
    }

}