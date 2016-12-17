<?php
/**
 * Created by PhpStorm.
 * User: murilo
 * Date: 15/12/16
 * Time: 10:28
 */

namespace Ewerton\Cnab\Cnab400\Banrisul;


use Cnab\Remessa\Cnab400\Trailer;
use Ewerton\Cnab\Cnab240\Generico\CnabInterface;

class Trailler implements CnabInterface
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

    public function criaLinha()
    {
        // TODO: Implement criaLinha() method.
        $linha = 9;
        $linha .= str_pad('', 393);
        $linha .= $this->getSequencialRegistro();

        $linha .= "\r\n";
        return $linha;
    }
}