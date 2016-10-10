<?php

/**
 * @autor Ewerton Cardoso
 */

namespace Ewerton\Cnab\Cnab240\Generico;


use Ewerton\Cnab\Cnab240\Generico\CnabInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use Zend\I18n\Validator\DateTime;

abstract class TrailerArquivo implements CnabInterface
{
    use Arquivo;

    /**
     * @var integer
     */
    protected $qtdLotes;

    /**
     * @return int
     */
    public function getQtdLotes()
    {
        return sprintf("%06d", $this->qtdLotes);
    }

    /**
     * @param int $qtdLotes
     * @return TrailerArquivo
     */
    public function setQtdLotes($qtdLotes)
    {
        $this->qtdLotes = $qtdLotes;
        return $this;
    }


    /**
     * @var integer
     */
    protected $qtdRegistros;

    /**
     * @return mixed
     */
    public function getQtdRegistros()
    {
        return sprintf("%06d", $this->qtdRegistros);
    }

    /**
     * @param mixed $qtdRegistros
     * @return TrailerLote
     */
    public function setQtdRegistros($qtdRegistros)
    {
        $this->qtdRegistros = $qtdRegistros;
        return $this;
    }




}