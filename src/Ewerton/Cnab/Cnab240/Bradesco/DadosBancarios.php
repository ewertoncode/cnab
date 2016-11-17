<?php
/**
 * Created by PhpStorm.
 * User: murilo
 * Date: 03/11/16
 * Time: 13:18
 */
namespace Ewerton\Cnab\Cnab240\Bradesco;

trait DadosBancarios
{
    protected $convenio;
    protected $contaDv;
    protected $conta;
    protected $agenciaDv;
    protected $agencia;

    /**
     * @return mixed
     */
    public function getContaDv()
    {
        return $this->contaDv;
    }

    /**
     * @param mixed $contaDv
     * @return $this
     */
    public function setContaDv($contaDv)
    {
        $this->contaDv = $contaDv;
        return $this;
    }





    /**
     * @return mixed
     */
    public function getConta()
    {
        return $this->conta;
    }

    /**
     * @param $conta
     * @return $this
     */
    public function setConta($conta)
    {
        $this->conta = sprintf("%012d", $conta);
        return $this;
    }



    /**
     * @return mixed
     */
    public function getAgenciaDv()
    {
        return $this->agenciaDv;
    }

    /**
     * @param mixed $agenciaDv
     * @return $this
     */
    public function setAgenciaDv($agenciaDv)
    {
        $this->agenciaDv = $agenciaDv;
        return $this;
    }



    /**
     * @return mixed
     */
    public function getAgencia()
    {
        return $this->agencia;
    }

    /**
     * @param mixed $agencia
     * @return $this
     */
    public function setAgencia($agencia)
    {
        $this->agencia = sprintf("%05d",$agencia);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getConvenio()
    {
        return $this->convenio;
    }

    /**
     * @param mixed $convenio
     * @return DadosBancarios
     */
    public function setConvenio($convenio)
    {
        $this->convenio = sprintf("%020d", $convenio);
        return $this;
    }
}