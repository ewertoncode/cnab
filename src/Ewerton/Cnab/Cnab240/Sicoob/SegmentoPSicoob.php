<?php

namespace Ewerton\Cnab\Cnab240\Sicoob;

use Ewerton\Cnab\Cnab240\Generico\SegmentoP as SegmentoPGenerico;

class SegmentoPSicoob extends SegmentoPGenerico
{
    use DadosBancarios;

    protected $carteira;

    protected $formaCadastramento = 0;

    protected $tipoDocumento = ' ';

    protected $identificacaoEmissao = 2;

    protected $identificacaoDistribuicao = 2;

    protected $codigoJurosMora = 1;

    protected $codigoBaixaDevolucao = 0;

    protected $parcela;

    protected $modalidade;

    protected $tipoFormulario = 1;

    protected $codigoCliente;

    /**
     * @return mixed
     */
    public function getCodigoCliente()
    {
        return $this->codigoCliente;
    }

    /**
     * @param mixed $codigoCliente
     * @return SegmentoPSicoob
     */
    public function setCodigoCliente($codigoCliente)
    {
        $this->codigoCliente = sprintf("%d", preg_replace('/[[:punct:]]/', '', $codigoCliente));
        return $this;
    }


    /**
     * @return int
     */
    public function getTipoFormulario()
    {
        return $this->tipoFormulario;
    }

    /**
     * @param int $tipoFormulario
     * @return SegmentoPSicoob
     */
    public function setTipoFormulario($tipoFormulario)
    {
        $this->tipoFormulario = $tipoFormulario;
        return $this;
    }


    /**
     * @return int
     */
    public function getModalidade()
    {
        return $this->modalidade;
    }

    /**
     * @param int $modalidade
     * @return SegmentoPSicoob
     */
    public function setModalidade($modalidade)
    {
        $this->modalidade = sprintf("%02d", $modalidade);
        return $this;
    }


    /**
     * @return int
     */
    public function getParcela()
    {
        return $this->parcela;
    }

    /**
     * @param int $parcela
     * @return SegmentoPSicoob
     */
    public function setParcela($parcela)
    {
        $this->parcela = sprintf("%02d", $parcela);
        return $this;
    }


    /**
     * @return mixed
     */
    public function getCodigoBaixaDevolucao()
    {
        return $this->codigoBaixaDevolucao;
    }


    /**
     * @return mixed
     */
    public function getCodigoJurosMora()
    {
        return $this->codigoJurosMora;
    }


    /**
     * @return int
     */
    public function getIdentificacaoEmissao()
    {
        return $this->identificacaoEmissao;
    }

    /**
     * @return int
     */
    public function getIdentificacaoDistribuicao()
    {
        return $this->identificacaoDistribuicao;
    }


    /**
     * @return int
     */
    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }


    /**
     * @return mixed
     */
    public function getFormaCadastramento()
    {
        return $this->formaCadastramento;
    }


    /**
     * @var integer
     */
    protected $tipoCobranca;

    /**
     * @return mixed
     */
    public function getCarteira()
    {
        return $this->carteira;
    }

    /**
     * @param mixed $carteira
     * @return $this
     */
    public function setCarteira($carteira)
    {
        $this->carteira = sprintf("%d", $carteira);
        return $this;
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
     * @return $this
     */
    public function setTipoCobranca($tipoCobranca)
    {
        $this->tipoCobranca = $tipoCobranca;
        return $this;
    }


    public function getNossoNumero()
    {
        $sequencia = sprintf("%04d", $this->agencia) .
            sprintf("%010d", $this->codigoCliente) . sprintf("%07d", $this->nossoNumero);

        $cont = 0;
        $calculoDv = 0;
        for ($i = 0; $i <= strlen($sequencia); $i++) {
            $cont++;
            if ($cont == 1) {
                $constante = 3;
            }
            if ($cont == 2) {
                $constante = 1;
            }
            if ($cont == 3) {
                $constante = 9;
            }
            if ($cont == 4) {
                $constante = 7;
                $cont = 0;
            }
            $calculoDv = $calculoDv + (substr($sequencia, $i, 1) * $constante);

        }
        $resto = $calculoDv % 11;

        if ($resto == 0 || $resto == 1) {
            $dv = 0;
        } else {
            $dv = 11 - $resto;
        }
        return sprintf("%010d", $this->nossoNumero . $dv);
    }


    /**
     * @return string
     */
    public function criaLinha()
    {
        //pos[1-3] - 3 Dígitos
        $linha = $this->getCodigoBanco();
        //pos[4-7] - 4
        $linha .= $this->getLote();
        //post[8-8] - 1
        $linha .= $this->getRegistro();
        //pos[9-13] - 5
        $linha .= $this->getNumeroSequencialArquivo();
        //pos[14-14] - 1
        $linha .= $this->getCodSegmento();
        //pos[15-15] - 1
        $linha .= sprintf(str_pad('', 1));
        //pos[16-17] - 1
        $linha .= $this->getCodMovimentoRemessa();
        //pos[18-22] - 5
        $linha .= $this->getAgencia();
        //pos[23-23] -1
        $linha .= $this->getAgenciaDv();
        //pos[24-35] - 12
        $linha .= $this->getConta();
        //pos[36-36] - 1
        $linha .= $this->getContaDv();
        //pos[37-37] - 1
        $linha .= sprintf(str_pad('', 1));
        //pos[38-57] - 12 nosso número + dv
        $linha .= $this->getNossoNumero();      //
        $linha .= $this->getParcela();          //  NOSSO NÚMERO
        $linha .= $this->getModalidade();       //
        $linha .= $this->getTipoFormulario();   //
        $linha .= sprintf(str_pad('', 5));
        //pos[58-58] - 3
           $linha .= $this->getCarteira();
        //pos[59-59] - 1
        $linha .= $this->getFormaCadastramento();
        //pos[60-60]  - 1
        $linha .= $this->getTipoDocumento();
        //pos[61-61] - 1
        $linha .= $this->getIdentificacaoEmissao();
        //pos[62-62] - 1
        $linha .=$this->getIdentificacaoDistribuicao();
        //pos[63-77] - 15
        $linha .= $this->getNumeroDocumento();
        //pos[78-85] - 8
        $linha .= $this->getVencimento();
        //pos[86-100] - 13
        $linha .= $this->getValor();
        //pos[101-105] Agência encarregada da cobrança
        $linha .= '00000';
        //pos[106-106] Dígito da agencia
        $linha .= sprintf(str_pad('', 1));
        //pos[107-108]
        $linha .= $this->getEspecie();
        //pos[109-109]
        $linha .= $this->getAceite();
        //pos[110-117]
        $linha .= $this->getDataEmissao();
        //pos[118-118] Código do Juros de Mora
        $linha .= $this->getCodigoJurosMora();
        //pos[119-126] Data do juros de mora
        $linha .= $this->getDataJurosMora();
        //pos[127-141]
        $linha .= $this->getValorMoraDia();
        //pos[142-142] Código do Desconto 1
        $linha .= $this->getCodigoDesconto();
        //pos[143 - 150] Data do Desconto 1
        $linha .= $this->getDataDesconto();
        //pos[151 - 165] Valor ou Percentual do desconto concedido
        $linha .= $this->getValorDesconto();
        //pos[166 - 180] Valor IOF
        $linha .= sprintf(str_pad('', 15, '0'));
        //pos[181 - 195] Valor abatimento
        $linha .= sprintf(str_pad('', 15, '0'));
        //pos[196-220] Identificação do título na empresa
        $linha .= str_pad($this->getNumeroDocumento(), 25, ' ', STR_PAD_RIGHT);
        //pos[221 - 221] Código para protesto
        $linha .= 3;
        //pos[222-223] Número de dias para protesto
        $linha .= '00';
        //pos[224-224] Código para Baixa/Devolução
        $linha .= $this->getCodigoBaixaDevolucao();
        //pos[225-227] - Números de dias para baixa/devolução
        $linha .= sprintf(str_pad('', 3));
        //pos[228-229] - Código moeda
        $linha .= '09';
        //pos[230-239] - Número contrato
        $linha .= sprintf(str_pad('', 10, '0'));
        //pos[240-240] - Número contrato
        $linha .= sprintf(str_pad('', 1));
        $linha .= "\r\n";

        return $linha;

    }

}