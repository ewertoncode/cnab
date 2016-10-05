<?php

namespace Ewerton\Cnab\Cnab240\Santander;

use Ewerton\Cnab\Cnab240\Generico\SegmentoQ as SegmentoQGenerico;

class SegmentoQ extends SegmentoQGenerico
{


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
        //pos[9-13]
        $linha .= $this->getNumeroSequencialArquivo();
        //pos[14-14]
        $linha .= $this->getCodSegmento();
        //pos[15-15]
        $linha .= sprintf(str_pad('', 1));
        //pos[16-17]
        $linha .= $this->getCodMovimentoRemessa();
        //pos[18-18]
        $linha .= $this->getTipoInscricaoPagador();
        //pos[19-33]
        $linha .= $this->getNumeroInscricao();
        //pos[34-73]
        $linha .= $this->getNomePagador();
        //pos[74-133]
        $linha .= $this->getEndereco();
        //pos[114-128]
        $linha .= $this->getBairro();
        //pos[129-136]
        $linha .= $this->getCep();
        //pos[127-151]
        $linha .= $this->getCidade();
        //pos[152-153]
        $linha .= $this->getEstado();
        //pos[154-154] Tipo de inscrição Sacador/avalista
        $linha .= 0;
        //pos[155-169] Nº de inscrição Sacador/avalista
        $linha .= '000000000000000';
        //pos[170 - 209] Nome do Sacador/avalista
        $linha .= sprintf(str_pad('', 40));
        //pos[210 –212] Identificador de carne
        $linha .= $this->getIdentificadorCarne();
        //pos[213 –215]
        $linha .= $this->getNumeroParcela();
        //pos[216 –218]
        $linha .= $this->getTotalParcelas();
        //pos[219 – 221]
        $linha .= '000';
        //pos[222-240]
        $linha .= sprintf(str_pad('', 19));



        $linha .= "\n";

        return $linha;

    }

}