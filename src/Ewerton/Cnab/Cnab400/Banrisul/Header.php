<?php
/**
 * Created by PhpStorm.
 * User: murilo
 * Date: 14/12/16
 * Time: 13:21
 */

namespace Ewerton\Cnab\Cnab400\Banrisul;


use Ewerton\Cnab\Cnab240\Generico\CnabInterface;
use Ewerton\Cnab\Utils\FormataString;

class Header implements CnabInterface
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


    public function criaLinha()
    {
        // TODO: Implement criaLinha() method.
        //pos [1-9]
        $linha = '01REMESSA';
        //pos [10-26]
        $linha .= str_pad('', 17);
        //pos [27-39]
        $linha .= $this->getCodigoCedente();
        //pos [40-46]
        $linha .= str_pad('', 7);
        //pos [47-76]
        $linha .= $this->getNomeEmpresa();
        //pos [77-87]
        $linha .= '041BANRISUL';
        //pos [88-94]
        $linha .= str_pad('', 7);
        //pos [95-100]
        $linha .= $this->getDataGravacao();
        //pos [101-395]
        $linha .= str_pad('', 294);
        //pos [396-400]
        $linha .= '000001';

        $linha .= "\r\n";

        return $linha;
    }


}