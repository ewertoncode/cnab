<?php
/**
 * Created by PhpStorm.
 * User: murilo
 * Date: 14/12/16
 * Time: 18:40
 */

namespace Ewerton\Cnab\Cnab400\Bradesco;


use Ewerton\Cnab\Cnab240\Generico\CnabInterface;
use Ewerton\Cnab\Cnab400\Generico\TransacaoGenerico;
use Ewerton\Cnab\Utils\FormataString;

class Transacao extends TransacaoGenerico
{

    const CARTEIRA = 1;
    const COD_BANCO = '237';
    const TIPO_DOCUMENTO = '01';
    const ACEITE = 'N';
    const COD_MORA = '0';

    private $carteira;
    private $agencia;
    private $conta;
    private $conta_dv;

    /**
     * @return mixed
     */
    public function getCarteira()
    {
        return $this->carteira;
    }

    /**
     * @param mixed $carteira
     * @return Transacao
     */
    public function setCarteira($carteira)
    {
        $this->carteira = sprintf("%03d", $carteira);
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
     * @return Transacao
     */
    public function setAgencia($agencia)
    {
        $this->agencia = sprintf("%05d", $agencia);
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
     * @param mixed $conta
     * @return Transacao
     */
    public function setConta($conta)
    {
        $this->conta = sprintf("%07d",$conta);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContaDv()
    {
        return $this->conta_dv;
    }

    /**
     * @param mixed $conta_dv
     * @return Transacao
     */
    public function setContaDv($conta_dv)
    {
        $this->conta_dv = $conta_dv;
        return $this;
    }


    public function getNossoNumero()
    {
        $nossoNumero = sprintf("%02d",$this->getCarteira()) . sprintf("%011d", $this->nossoNumero);


        $resto2 = $this->modulo_11($nossoNumero, 7, 1);
        $digito = 11 - $resto2;

        if ($digito == 10) {
            $dv = "P";
        } elseif($digito == 11) {
            $dv = 0;
        } else {
            $dv = $digito;
        }

        return sprintf("%012s", $this->nossoNumero.$dv);
    }

    /**
     * @return mixed
     */
    public function getMulta()
    {
        return sprintf("%04d", number_format($this->multa, 2,'',''));
    }

    public function getValorMoraDia()
    {
        return sprintf("%013d", number_format($this->valorMoraDia, 2, '', ''));
    }

    /**
     * @return mixed
     */
    public function getNomePagador()
    {
        return str_pad(strtoupper(substr($this->nomePagador, 0,40)), 40, ' ', STR_PAD_RIGHT);
    }

    /**
     * @return mixed
     */
    public function getEndereco()
    {
        return str_pad(strtoupper(substr($this->endereco. ' '. $this->bairro. ' '. $this->cidade. ' '. $this->estado, 0,40)), 40, ' ', STR_PAD_RIGHT);
    }

    public function criaLinha()
    {
        // TODO: Implement criaLinha() method.
        //pos [1-1]
        $linha = 1;
        //pos [2-6]
        $linha .= str_pad('', 5, 0);
        //pos [7-7]
        $linha .= str_pad('', 1);
        //pos [8-19]
        $linha .= str_pad('', 12, 0);
        //pos [20-20]
        $linha .= str_pad('', 1);
        //pos [21-21]
        $linha .= '0';
        //pos [22-24]
        $linha .= $this->getCarteira();
        //pos [25-29]
        $linha .= $this->getAgencia();
        //pos [30-36]
        $linha .= $this->getConta();
        //pos [37-37]
        $linha .= $this->getContaDv();
        //pos [38-62]
        $linha .= $this->getNumeroDocumeto();
        //pos [63-65]
        $linha .= str_pad('', 3, 0);
        //pos [66-66] código multa
        $linha .= '2';
        //pos [[67-70]
        $linha .= $this->getMulta();
        //pos[71-82]
        $linha .= $this->getNossoNumero();
        //pos[83-92]
        $linha .= str_pad('', 10, 0);
        //pos[93-93]
        $linha .= str_pad('', 1, 2);
        //pos[94-94]
        $linha .= str_pad('', 1);
        //pos[95-104]
        $linha .= str_pad('', 10);
        //pos[105-105]
        $linha .= str_pad('', 1);
        //pos[106-106]
        $linha .= str_pad('', 1, 2);
        //pos[107-108]
        $linha .= str_pad('', 2);
        //pos [109-110]
        $linha .= $this->getOcorrencia();
        //pos [111-120]
        $linha .= $this->getSeuNumero();
        //pos [121-126]
        $linha .= $this->getVencimento();
        //pos [127-139]
        $linha .= $this->getValor();
        //pos [140-142]
        $linha .= str_pad('', 3, 0);
        //pos [143-147]
        $linha .= str_pad('', 5, 0);
        //pos [148-149]
        $linha .= self::TIPO_DOCUMENTO;
        //pos [150-150]
        $linha .= self::ACEITE;
        //pos [151-156]
        $linha .= $this->getDataEmissao();
        //pos [157-160]
        $linha .= str_pad('', 4, 0);
        //pos [161-173]
        $linha .= $this->getValorMoraDia();
        //pos [174-179]
        $linha .= $this->getDataDesconto();
        //pos [180 - 192]
        $linha .= $this->getValorDesconto();
        //pos [193 - 218]
        $linha .= str_pad('', 26, 0);
        //pos[219-220]
        $linha .= $this->getTipoInscricaoPagador();
        //pos[221-234]
        $linha .= $this->getNumeroInscricao();
        //pos[235-274]
        $linha .= $this->getNomePagador();
        //pos[275-314]
        $linha .= $this->getEndereco();
        //pos[315-326]
        $linha .= str_pad('', 12);
        //pos [227-334]
        $linha .= $this->getCep();
        //pos [335-394]
        $linha .= str_pad('', 60);
        //pos [395-400]
        $linha .= $this->getSequencialRegistro();

        $linha .= "\r\n";
        return $linha;
    }



}