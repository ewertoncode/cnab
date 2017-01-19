<?php

namespace Ewerton\Cnab\Cnab240\Santander;

use Ewerton\Cnab\Cnab240\Generico\HeaderArquivo as HeaderArquivoGenerico;


class HeaderArquivo extends HeaderArquivoGenerico
{

    protected $codigoTransmissao;

    protected $numeroSequencialArquivo;

    protected $versaoLayoutArquivo = 40;

    /**
     * Tipo de Inscrição da Empresa
     * 1 = CPF, 2 = CNPJ
     * pos: [17, 17]
     * picture: '9(1)'
     * @param integer $tipoEmpresa
     * @throws \Exception
     * @return HeaderArquivo
     */
    public function setTipoEmpresa($tipoEmpresa = 2)
    {
        if((int)$tipoEmpresa === 1 || (int) $tipoEmpresa === 2) {
            $this->tipoEmpresa = $tipoEmpresa;
        } else {
            throw new \Exception("Tipo de empresa inválido: 1 = CPF, 2 = CNPJ");
        }

        return $this;
    }

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
    public function getNumeroSequencialArquivo()
    {
        return $this->numeroSequencialArquivo;
    }

    /**
     * @param mixed $numeroSequencialArquivo
     * @return HeaderArquivo
     */
    public function setNumeroSequencialArquivo($numeroSequencialArquivo)
    {
        $this->numeroSequencialArquivo = sprintf("%06d", $numeroSequencialArquivo);
        return $this;
    }

    /**
     * @return int
     */
    public function getVersaoLayoutArquivo()
    {
        return sprintf("%03d", $this->versaoLayoutArquivo);
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
        //pos[9-16]
        $linha .= sprintf(str_pad('', 8));
        //pos[17-17]
        $linha .= $this->getTipoEmpresa();
        //post[18-32]
        $linha .= $this->getInscricao();
        //pos[33-47]
        $linha .= $this->getCodigoTransmissao();
        //pos[48-72]
        $linha .= sprintf(str_pad('', 25));
        //pos[073 - 102]
        $linha .= $this->getNomeEmpresa();
        //pos[103 - 132]
        $linha .= $this->getBanco();
        //pos[133 - 142]
        $linha .= sprintf(str_pad('', 10));
        //pos[143 - 143]
        $linha .= $this->getCodigoRemessa();
        //pos[144 - 151]
        $linha .= $this->getDataGeracao();
        //pos[152 - 157]
        $linha .= sprintf(str_pad('', 6));
        //pos[158 - 163]
        $linha .= $this->getNumeroSequencialArquivo();
        //pos[164 - 166]
        $linha .= $this->getVersaoLayoutArquivo();
        //pos[167 - 240]
        $linha .= sprintf(str_pad('', 74));
        $linha .= "\r\n";

        return $linha;

    }

}