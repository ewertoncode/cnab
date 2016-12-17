<?php
/**
 * Created by PhpStorm.
 * User: murilo
 * Date: 14/12/16
 * Time: 13:21
 */

namespace Ewerton\Cnab\Cnab400\Generico;


use Ewerton\Cnab\Cnab240\Generico\CnabInterface;
use Ewerton\Cnab\Utils\FormataString;

abstract class HeaderGenerico implements CnabInterface
{

    protected $codigoCedente;
    protected $nomeEmpresa;
    protected $dataGravacao;


    /**
     * @return mixed
     */
    public function getCodigoCedente()
    {
        return $this->codigoCedente;
    }

    /**
     * @param mixed $codigoCedente
     * @return Header
     */
    public function setCodigoCedente($codigoCedente)
    {
        $this->codigoCedente = sprintf("%013d", preg_replace('/[[:punct:]]/', '', $codigoCedente));
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
     * @return Header
     */
    public function setNomeEmpresa($nomeEmpresa)
    {
        $nomeEmpresaEncoing = FormataString::retiraCaracteresEspecial($nomeEmpresa);
        $this->nomeEmpresa = str_pad(substr(strtoupper($nomeEmpresaEncoing), 0, 30), 30);;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDataGravacao()
    {
        return sprintf("%06d", $this->dataGravacao);
    }

    /**
     * @param mixed $dataGravacao
     * @return Header
     */
    public function setDataGravacao(\DateTime $dataGravacao)
    {
        $this->dataGravacao = (int)$dataGravacao->format('dmy');
        return $this;
    }


}