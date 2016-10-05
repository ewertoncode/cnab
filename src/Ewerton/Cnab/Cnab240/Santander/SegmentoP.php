<?php

namespace Ewerton\Cnab\Cnab240\Santander;

use Ewerton\Cnab\Cnab240\Generico\SegmentoP as SegmentoPGenerico;

class SegmentoP extends SegmentoPGenerico
{
    /**
     * @var integer
     */
    protected $agencia;

    /**
     * @var integer
     */
    protected $agenciaDv;

    /**
     * @var integer
     */
    protected $conta;

    /**
     * @var integer
     */
    protected $contaDv;

    /**
     * @var integer
     */
    protected $contaCobranca;

    /**
     * @var integer
     */
    protected $contaDvCobranca;

    /**
     * @var integer
     */
    protected $tipoCobranca;

    /**
     * @return mixed
     */
    public function getAgencia()
    {
        return sprintf("%04d", $this->agencia);
    }

    /**
     * @param mixed $agencia
     * @return SegmentoP
     */
    public function setAgencia($agencia)
    {
        $this->agencia = $agencia;
        return $this;
    }

    /**
     * @return int
     */
    public function getAgenciaDv()
    {
        return sprintf("%01d", $this->agenciaDv);
    }

    /**
     * @param int $agenciaDv
     * @return SegmentoP
     */
    public function setAgenciaDv($agenciaDv)
    {
        $this->agenciaDv = $agenciaDv;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getConta()
    {
        return sprintf("%09d", $this->conta);
    }

    /**
     * @param mixed $conta
     * @return SegmentoP
     */
    public function setConta($conta)
    {
        $this->conta = $conta;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContaDv()
    {
        return sprintf("%01d", $this->contaDv);
    }

    /**
     * @param mixed $contaDv
     * @return SegmentoP
     */
    public function setContaDv($contaDv)
    {
        $this->contaDv = $contaDv;
        return $this;
    }

    /**
     * @return int
     */
    public function getContaCobranca()
    {
        return sprintf("%09d", $this->getConta());
    }

    /**
     * @return int
     */
    public function getContaDvCobranca()
    {
        return sprintf("%01d", $this->getContaDv());
    }

    /**
     * @return mixed
     */
    public function getTipoCobranca()
    {
        return $this->tipoCobranca;
    }

    /**
     * @param mixed $tipoCobranca
     * @return SegmentoP
     */
    public function setTipoCobranca($tipoCobranca)
    {
        $this->tipoCobranca = $tipoCobranca;
        return $this;
    }


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
        //pos[18-21]
        $linha .= $this->getAgencia();
        //pos[22-22]
        $linha .= $this->getAgenciaDv();
        //pos[23-31]
        $linha .= $this->getConta();
        //pos[32-32]
        $linha .= $this->getContaDv();
        //pos[33-41]
        $linha .= $this->getContaCobranca();
        //pos[42-42]
        $linha .= $this->getContaDvCobranca();
        //pos[43-44]
        $linha .= sprintf(str_pad('', 2));
        //pos[45-57]
        $linha .= $this->getNossoNumero();
        //pos[58-58]
        $linha .= $this->getTipoCobranca();
        //pos[59-59] Forma de Cadastramento = 1
        $linha .= 1;
        //pos[60-60] Tipo de documento 1- Tradicional , 2- Escritural
        $linha .= 1;
        //pos[61-61]
        $linha .= sprintf(str_pad('', 1));
        //pos[62-62]
        $linha .= sprintf(str_pad('', 1));
        //pos[63-77]
        $linha .= $this->getNumeroDocumento();
        //pos[78-85]
        $linha .= $this->getVencimento();
        //pos[89-100]
        $linha .= $this->getValor();
        //pos[101-104] Agência encarregada da cobrança
        $linha .= '0000';
        //pos[105-105]
        $linha .= $this->getAgenciaDv();
        //pos[106-106]
        $linha .= sprintf(str_pad('', 1));
        //pos[107-108]
        $linha .= $this->getEspecie();
        //pos[109-109]
        $linha .= $this->getAceite();
        //pos[110-117]
        $linha .= $this->getDataEmissao();
        //pos[118-118] Código do Juros de Mora
        $linha .= 1;
        //pos[119-126] Data do juros de mora
        $linha .= $this->getDataJurosMora();
        //pos[127-141]
        $linha .= $this->getValorMoraDia();
        //pos[142-142] Código do Desconto 1
        $linha .= 0;
        //pos[143 - 150] Data do Desconto 1
        $linha .= '00000000';
        //pos[151 - 165] Valor ou Percentual do desconto concedido
        $linha .= '000000000000000';
        //pos[166 - 180] Valor IOF
        $linha .= '000000000000000';
        //pos[181 - 195] Valor abatimento
        $linha .= '000000000000000';
        //pos[196-220] Identificação do título na empresa
        $linha .= str_pad($this->getNumeroDocumento(), 25, ' ', STR_PAD_RIGHT);
        //pos[221 - 221] Código para protesto
        $linha .= 0;
        //pos[222-223] Número de dias para protesto
        $linha .= '00';
        //pos[224-224] Código para Baixa/Devolução
        $linha .= 3;
        //pos[225-225]
        $linha .= 0;
        //pos[226-227]
        $linha .= '00';
        //pos[228-229]
        $linha .= '00';
        //pos[230-240]
        $linha .= sprintf(str_pad('', 11));


        $linha .= "\n";

        return $linha;

    }

}