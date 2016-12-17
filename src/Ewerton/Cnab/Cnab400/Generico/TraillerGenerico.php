<?php
/**
 * Created by PhpStorm.
 * User: murilo
 * Date: 15/12/16
 * Time: 10:28
 */

namespace Ewerton\Cnab\Cnab400\Generico;


use Cnab\Remessa\Cnab400\Trailer;
use Ewerton\Cnab\Cnab240\Generico\CnabInterface;

abstract class TraillerGenerico implements CnabInterface
{
    private $sequencialRegistro;
    /**
     * @return mixed
     */
    public function getSequencialRegistro()
    {
        return sprintf("%06d",$this->sequencialRegistro);
    }

    /**
     * @param mixed $sequencialRegistro
     * @return $this
     */
    public function setSequencialRegistro($sequencialRegistro)
    {
        $this->sequencialRegistro = $sequencialRegistro;
        return $this;
    }

}