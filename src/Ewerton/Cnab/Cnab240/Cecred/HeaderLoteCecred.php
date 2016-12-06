<?php

/**
 * @autor Murilo Sandiego
 */

namespace Ewerton\Cnab\Cnab240\Cecred;


use Ewerton\Cnab\Cnab240\Generico\HeaderLote as HeaderLoteGenerico;


class HeaderLoteCecred extends HeaderLoteGenerico
{
    use DadosBancarios;

    protected $numeroRemessaRetorno;
    protected $dataCredito;

    /**
     * @return mixed
     */
    public function getDataCredito()
    {
        return $this->dataCredito;
    }

    /**
     * @param mixed $dataCredito
     * @return $this
     */
    public function setDataCredito($dataCredito)
    {
        $this->dataCredito = (int)$dataCredito->format('dmY');
        return $this;
    }


    /**
     * @return mixed
     */
    public function getNumeroRemessaRetorno()
    {
        return sprintf("%08d", $this->numeroRemessaRetorno);
    }

    /**
     * @param mixed $numeroRemessaRetorno
     * @return HeaderLoteBradesco
     */
    public function setNumeroRemessaRetorno($numeroRemessaRetorno)
    {
        $this->numeroRemessaRetorno = $numeroRemessaRetorno;
        return $this;
    }

    /**
     * @return string
     */
    public function criaLinha()
    {
        //pos[1-3] - 3 dígitos
        $linha = $this->getCodigoBanco();
        //pos[4-7] - 4
        $linha .= $this->getLote();
        //post[8-8] - 1
        $linha .= $this->getRegistro();
        //pos[9-9] - 1
        $linha .= $this->getTipoOperacao();
        //pos[10-11] - 2
        $linha .= $this->getTipoServico();
        //pos[12-13] - 2
        $linha .= sprintf(str_pad('', 2));
        //pos[14-16] - 3
        $linha .= $this->getNVersaoLayout();
        //pos[17-17] - 1
        $linha .= sprintf(str_pad('', 1));
        //pos[18-18] - 1
        $linha .= $this->getTipoEmpresa();
        //pos[19-33] - 15
        $linha .= $this->getInscricao();
        //pos[34-53] - 20 Código de convenio no Banco
        $linha .= $this->getConvenio();
        //pos[54-58] - 5
        $linha .= $this->getAgencia();
        //pos[59-59] - 5
        $linha .= $this->getAgenciaDv();
        //pos[60-71] - 12
        $linha .= $this->getConta();
        //pos[72-72] - 1
        $linha .= $this->getContaDv();
        //pos[73-73] - 1
        $linha .= sprintf(str_pad('', 1));
        //pos[74-103] - 30
        $linha .= $this->getNomeEmpresa();
        //pos[104-143] - 40 - mensagem 1
        $linha .= sprintf(str_pad('', 40));
        //pos[144-183] - 40 - mensagem 2
        $linha .= sprintf(str_pad('', 40));
        //pos[184-191] - 8
        $linha .= $this->getNumeroRemessaRetorno();
        //pos[192-199] - 8
        $linha .= $this->getDataGravacao();
        //pos[200-207] - 8 Data do crédito
        $linha .= sprintf(str_pad('', 8, '0'));
        //pos[208-240]
        $linha .= sprintf(str_pad('', 33));
        $linha .= "\r\n";

        return $linha;
    }

}