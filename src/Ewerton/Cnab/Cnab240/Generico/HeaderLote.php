<?php

/**
 * @autor Ewerton Cardoso
 */

namespace Ewerton\Cnab\Cnab240\Generico;


use Ewerton\Cnab\Cnab240\Generico\CnabInterface;
use Ewerton\Cnab\Utils\FormataString;
use Symfony\Component\Config\Definition\Exception\Exception;
use Zend\I18n\Validator\DateTime;

abstract class HeaderLote implements CnabInterface
{
    use Arquivo;

    /**
     * @var string
     */
    protected $tipoOperacao;

    protected $tipoServico;

    /**
     * @var integer
     */
    protected $nVersaoLayout;

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
    protected $dataGravacao;


    /**
     * @return string
     */
    public function getTipoOperacao()
    {
        return $this->tipoOperacao;
    }

    /**
     * @param string $tipoOperacao
     * @return HeaderLote
     * pos[9-9]
     * picture X(1)
     */
    public function setTipoOperacao($tipoOperacao)
    {
        if(strlen($tipoOperacao) == 1) {
            $this->tipoOperacao = $tipoOperacao;
        } else {
            throw new Exception('Tipo operação: Tamanho inválido');
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getTipoServico()
    {
        return $this->tipoServico;
    }

    /**
     * pos[9-9]
     * picture X(1)
     * @param integer $tipoServico
     * @return HeaderLote
     */
    public function setTipoServico($tipoServico)
    {
        $this->tipoServico = sprintf("%02d", $tipoServico);

        return $this;
    }

    /**
     * @param mixed $nVersaoLayout
     * @return HeaderLote
     */
    public function setNVersaoLayout($nVersaoLayout)
    {
        $this->nVersaoLayout = $nVersaoLayout;
        return $this;
    }


    /**
     * @return int
     */
    public function getNVersaoLayout()
    {
        return sprintf("%03d", $this->nVersaoLayout);
    }

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
        $empresa = FormataString::retiraCaracteresEspecial($nomeEmpresa);
        $this->nomeEmpresa = str_pad(substr(strtoupper($empresa), 0,30), 30);
        return $this;
    }

    /**
     * @return int
     */
    public function getDataGravacao()
    {
        return sprintf("%08d", $this->dataGravacao);
    }

    /**
     * @param int $dataGravacao
     * @return HeaderLote
     */
    public function setDataGravacao(\DateTime $dataGravacao)
    {
        $this->dataGravacao = (int)$dataGravacao->format('dmY');
        return $this;
    }

}