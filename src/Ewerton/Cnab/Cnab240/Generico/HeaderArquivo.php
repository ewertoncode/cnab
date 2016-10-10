<?php

/**
 * @autor Ewerton Cardoso
 */

namespace Ewerton\Cnab\Cnab240\Generico;


use Ewerton\Cnab\Cnab240\Generico\CnabInterface;
use Zend\I18n\Validator\DateTime;

abstract class HeaderArquivo implements CnabInterface
{
    use Arquivo;

    /**
     * @var integer
     */
    protected $tipoEmpresa;

    /**
     * @var string
     */
    protected $inscricao;

    /**
     * @var string
     */
    protected $nomeEmpresa;

    /**
     * @var integer
     */
    protected $codigoRemessa = 1;

    /**
     * @var integer
     */
    protected $dataGeracao;

    /**
     * @return string
     */
    abstract public function criaLinha();

    /**
     * @return mixed
     */
    public function getTipoEmpresa()
    {
        return $this->tipoEmpresa;
    }

    /**
     * Tipo de Inscrição da Empresa
     * 1 = CPF, 2 = CNPJ
     * pos: [18, 18]
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
    public function getInscricao()
    {
        return $this->inscricao;
    }

    /**
     * @param mixed $inscricao
     * @return HeaderArquivo
     */
    public function setInscricao($inscricao)
    {
        $this->inscricao = sprintf("%015d", preg_replace('/[[:punct:]]/', '', $inscricao));
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNomeEmpresa()
    {
        return $this->nomeEmpresa;
    }

    /**
     * @param mixed $nomeEmpresa
     * @return HeaderArquivo
     */
    public function setNomeEmpresa($nomeEmpresa)
    {
        $this->nomeEmpresa = str_pad(substr(strtoupper($nomeEmpresa), 0,30), 30);
        return $this;
    }

    /**
     * @return int
     */
    public function getCodigoRemessa() {
        return $this->codigoRemessa;
    }

    /**
     * @return integer
     */
    public function getDataGeracao()
    {
        return sprintf("%08d", $this->dataGeracao);
    }

    /**
     * @param \DateTime $dataGeracao
     * @return HeaderArquivo
     */
    public function setDataGeracao(\DateTime $dataGeracao)
    {
        $this->dataGeracao = (int)$dataGeracao->format('dmY');
        return $this;
    }




}