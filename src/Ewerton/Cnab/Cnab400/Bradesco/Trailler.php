<?php
/**
 * Created by PhpStorm.
 * User: murilo
 * Date: 15/12/16
 * Time: 10:28
 */

namespace Ewerton\Cnab\Cnab400\Bradesco;


use Cnab\Remessa\Cnab400\Trailer;
use Ewerton\Cnab\Cnab240\Generico\CnabInterface;
use Ewerton\Cnab\Cnab400\Generico\TraillerGenerico;

class Trailler extends TraillerGenerico
{

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