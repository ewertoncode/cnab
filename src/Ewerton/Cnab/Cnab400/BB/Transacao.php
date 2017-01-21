<?php
/**
 * Created by PhpStorm.
 * User: murilo
 * Date: 14/12/16
 * Time: 18:40
 */

namespace Ewerton\Cnab\Cnab400\BB;


use Ewerton\Cnab\Cnab240\Generico\CnabInterface;
use Ewerton\Cnab\Cnab400\Generico\TransacaoGenerico;
use Ewerton\Cnab\Utils\FormataString;

class Transacao extends TransacaoGenerico
{

    const CARTEIRA = 1;
    const COD_BANCO = '001';
    const TIPO_DOCUMENTO = '01';
    const ACEITE = 'N';
    const COD_MORA = '0';

    private $carteira;
    private $agencia;
    private $conta;
    private $conta_dv;
    private $inscricaoCedente;
    private $agenciaDv;
    private $variacaoCarteira;

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
        $this->carteira = sprintf("%02d", $carteira);
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
        $this->agencia = sprintf("%04d", $agencia);
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
        $this->conta = sprintf("%08d",$conta);
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
        return sprintf("%07d", $this->getCodigoCedente()) . sprintf("%010d", $this->nossoNumero);
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
        return str_pad(strtoupper(substr($this->nomePagador, 0,37)), 37, ' ', STR_PAD_RIGHT);
    }

    /**
     * @return mixed
     */
    public function getEndereco()
    {
        return str_pad(strtoupper(substr($this->endereco, 0,40)), 40, ' ', STR_PAD_RIGHT);
    }

    /**
     * @return mixed
     */
    public function getInscricaoCedente()
    {
        return sprintf("%014d", preg_replace('/[[:punct:]]/', '', $this->inscricaoCedente));
    }

    /**
     * @param mixed $inscricaoCedente
     * @return Transacao
     */
    public function setInscricaoCedente($inscricaoCedente)
    {
        $this->inscricaoCedente = $inscricaoCedente;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAgenciaDv()
    {
        return sprintf("%01d", $this->agenciaDv);
    }

    /**
     * @param mixed $agenciaDv
     * @return Transacao
     */
    public function setAgenciaDv($agenciaDv)
    {
        $this->agenciaDv = $agenciaDv;
        return $this;
    }

    /**
     * @param mixed $codigoCedente
     * @return $this
     */
    public function setCodigoCedente($codigoCedente)
    {
        $this->codigoCedente = sprintf("%07d", preg_replace('/[[:punct:]]/', '', $codigoCedente));
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVariacaoCarteira()
    {
        return sprintf("%03d", $this->variacaoCarteira);
    }

    /**
     * @param mixed $variacaoCarteira
     * @return Transacao
     */
    public function setVariacaoCarteira($variacaoCarteira)
    {
        $this->variacaoCarteira = $variacaoCarteira;
        return $this;
    }




    public function criaLinha()
    {
        // TODO: Implement criaLinha() method.
        //pos [1-1]
        $linha = 7;
        //pos [2-3]
        $linha .= '02';
        //pos [4-17]
        $linha .= $this->getInscricaoCedente();
        //pos [18-21]
        $linha .= $this->getAgencia();
        //pos [22-22]
        $linha .= $this->getAgenciaDv();
        //pos [23-30]
        $linha .= $this->getConta();
        //pos [31-31]
        $linha .= $this->getContaDv();
        //pos [32-38]
        $linha .= $this->getCodigoCedente();
        //pos [39-63]
        $linha .= $this->getNumeroDocumeto();
        //pos [64-80]
        $linha .= $this->getNossoNumero();
        //pos [81-84]
        $linha .= str_pad('', 4, 0);
        //pos [85-91]
        $linha .= str_pad('', 7);
        //pos [92-94]
        $linha .= $this->getVariacaoCarteira();
        //pos [95-101]
        $linha .= str_pad('', 7, 0);
        //pos [102-106]
        $linha .= str_pad('', 5);
        //pos [107-108]
        $linha .= $this->getCarteira();
        //pos [109-110]
        $linha .= $this->getOcorrencia();
        //pos [111-120]
        $linha .= $this->getSeuNumero();
        //pos [121-126]
        $linha .= $this->getVencimento();
        //pos [127-139]
        $linha .= $this->getValor();
        //pos [140-142]
        $linha .= self::COD_BANCO;
        //pos [143-146]
        $linha .= str_pad('', 4, 0);
        //pos [147-147]
        $linha .= str_pad('', 1);
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
        //pos[235-271]
        $linha .= $this->getNomePagador();
        //pos [272-274]
        $linha .= str_pad('', 3);
        //pos[275-314]
        $linha .= $this->getEndereco();
        //pos[315-326]
        $linha .= $this->getBairro();
        //pos [227-334]
        $linha .= $this->getCep();
        //pos [335-349]
        $linha .= $this->getCidade();
        //pos [350-351]
        $linha .= $this->getEstado();
        //pos [352-391]
        $linha .= str_pad('', 40);
        //pos [392-393]
        $linha .= str_pad('', 2, 0);
        //pos [394-394]
        $linha .= str_pad('', 1);
        //pos [395-400]
        $linha .= $this->getSequencialRegistro();

        $linha .= "\r\n";
        return $linha;
    }



}