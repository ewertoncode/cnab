<?php

namespace Ewerton\Cnab\Cnab240\Banrisul;

use Ewerton\Cnab\Cnab240\Generico\SegmentoP as SegmentoPGenerico;

class SegmentoPBanrisul extends SegmentoPGenerico
{
    use DadosBancarios;

    protected $carteira;

    protected $formaCadastramento = 1;

    protected $tipoDocumento = ' ';

    protected $identificacaoEmissao = 2;

    protected $identificacaoDistribuicao = ' ';

    protected $codigoJurosMora = 1;

    protected $codigoBaixaDevolucao = 0;

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
        if ($this->especie != 2){
            return $this->identificacaoEmissao = 1;
        }
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
        $this->carteira = sprintf("%03d", $carteira);
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
        $dv = $this->modulo_10($this->nossoNumero);
        $resto = $this->modulo_11($this->nossoNumero . $dv, 7, 1);

        if ($resto == 1) {
            if ($dv == 9) {
                $dv = 0;
                $resto = $this->modulo_11($this->nossoNumero . $dv, 7, 1);
            } else {
                $dv++;
                $resto = $this->modulo_11($this->nossoNumero . $dv, 7, 1);
            }
        } else if ($resto == 0) {
            $dv2 = 0;
            return sprintf("%010d", $this->nossoNumero . $dv . $dv2);
        }

        $dv2 = 11 - $resto;

        return sprintf("%010d", $this->nossoNumero . $dv . $dv2);
    }

    /**
     * @return string
     */
    public function criaLinha()
    {
        //pos[1-3] - 3 Dígitos
        $linha = '041';
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
        //pos[16-17] - 2
        $linha .= $this->getCodMovimentoRemessa();
        //pos[18-22] - 5
        $linha .= $this->getAgencia();
        //pos[23-23] -1
        $linha .= sprintf(str_pad('', 1));
        //pos[24-35] - 12
        $linha .= $this->getConta();
        //pos[36-36] - 1
        $linha .= $this->getContaDv();
        //pos[37-37] - 1
        $linha .= sprintf(str_pad('', 1));
        //pos[38-57] - 20 nosso número + dv
        $linha .= $this->getNossoNumero();      //  Nosso número
        $linha .= sprintf(str_pad('', 10, '0'));// Preenchimento com zeros

        //pos[58-58] - 1
        $linha .= $this->getTipoCobranca();
        //pos[59-59] - 1
        $linha .= $this->getFormaCadastramento();
        //pos[60-60]  - 1
        $linha .= $this->getTipoDocumento();
        //pos[61-61] - 1
        $linha .= $this->getIdentificacaoEmissao();
        //pos[62-62] - 1
        $linha .= $this->getIdentificacaoDistribuicao();
        //pos[63-77] - 15
        $linha .= $this->getNumeroDocumento();
        //pos[78-85] - 8
        $linha .= $this->getVencimento();
        //pos[86-100] - 15
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
        $linha .= sprintf(str_pad('', 15));
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
        //pos[240-240] -
        $linha .= sprintf(str_pad('', 1));

        $linha .= "\r\n";

        return $linha;

    }

    private function modulo_10($num)
    {
        $numtotal10 = 0;
        $fator = 2;

        // Separacao dos numeros
        for ($i = strlen($num); $i > 0; $i--) {
            // pega cada numero isoladamente
            $numeros[$i] = substr($num, $i - 1, 1);
            // Efetua multiplicacao do numero pelo (falor 10)
            // 2002-07-07 01:33:34 Macete para adequar ao Mod10 do Ita�
            $temp = $numeros[$i] * $fator;
            $temp0 = 0;
            foreach (preg_split('//', $temp, -1, PREG_SPLIT_NO_EMPTY) as $k => $v) {
                $temp0 += $v;
            }
            $parcial10[$i] = $temp0; //$numeros[$i] * $fator;
            // monta sequencia para soma dos digitos no (modulo 10)
            $numtotal10 += $parcial10[$i];
            if ($fator == 2) {
                $fator = 1;
            } else {
                $fator = 2; // intercala fator de multiplicacao (modulo 10)
            }
        }

        // v�rias linhas removidas, vide fun��o original
        // Calculo do modulo 10
        $resto = $numtotal10 % 10;
        $digito = 10 - $resto;
        if ($resto == 0) {
            $digito = 0;
        }

        return $digito;

    }

    public function modulo_11($num, $base=9, $r=0)  {
        /**
         *   Autor:
         *           Pablo Costa <pablo@users.sourceforge.net>
         *
         *   Função:
         *    Calculo do Modulo 11 para geracao do digito verificador
         *    de boletos bancarios conforme documentos obtidos
         *    da Febraban - www.febraban.org.br
         *
         *   Entrada:
         *     $num: string num�rica para a qual se deseja calcularo digito verificador;
         *     $base: valor maximo de multiplicacao [2-$base]
         *     $r: quando especificado um devolve somente o resto
         *
         *   Saída:
         *     Retorna o Digito verificador.
         *
         *   Observações:
         *     - Script desenvolvido sem nenhum reaproveitamento de código pré existente.
         *     - Assume-se que a verificação do formato das variáveis de entrada é feita antes da execução deste script.
         */

        $soma = 0;
        $fator = 2;

        /* Separacao dos numeros */
        for ($i = strlen($num); $i > 0; $i--) {
            // pega cada numero isoladamente
            $numeros[$i] = substr($num,$i-1,1);
            // Efetua multiplicacao do numero pelo falor
            $parcial[$i] = $numeros[$i] * $fator;
            // Soma dos digitos
            $soma += $parcial[$i];
            if ($fator == $base) {
                // restaura fator de multiplicacao para 2
                $fator = 1;
            }
            $fator++;
        }

        /* Calculo do modulo 11 */
        if ($r == 0) {
            $soma *= 10;
            $digito = $soma % 11;
            if ($digito == 10) {
                $digito = 0;
            }
            return $digito;
        } elseif ($r == 1){
            if ($soma < 11) {
                return $soma;
            }
            $resto = $soma % 11;
            return $resto;
        }
    }
}