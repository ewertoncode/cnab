<?php

/**
 * @autor Ewerton Cardoso
 */

namespace Ewerton\Cnab\Cnab240\Generico;


use Ewerton\Cnab\Cnab240\Generico\CnabInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use Zend\I18n\Validator\DateTime;

abstract class SegmentoP implements CnabInterface
{
    use Arquivo;

    protected $numeroSequencialArquivo;

    /**
     * @var string
     */
    protected $codSegmento = 'P';

    /**
     * @var integer
     */
    protected $codMovimentoRemessa;

    /**
     * @var integer
     */
    protected $nossoNumero;

    /**
     * @var integer
     */
    protected $numeroDocumento;

    /**
     * @var integer
     */
    protected $vencimento;

    /**
     * @var integer
     */
    protected $valor;

    /**
     * @var integer
     */
    protected $especie;

    /**
     * @var string
     */
    protected $aceite = 'N';

    /**
     * @var integer
     */
    protected $dataEmissao;

    /**
     * @var integer
     */
    protected $dataJurosMora;

    /**
     * @var integer
     */
    protected $valorMoraDia;

    /**
     * @var
     */
    protected $codigoDesconto = 0;

    /**
     * @var
     */
    protected $valorDesconto = 0;

    /**
     * @var
     */
    protected $dataDesconto = 0;

    /**
     * @return mixed
     */
    public function getNumeroSequencialArquivo()
    {
        return sprintf("%05d", $this->numeroSequencialArquivo);
    }

    /**
     * @param mixed $numeroSequencialArquivo
     * @return SegmentoP
     * @throws \Exception
     */
    public function setNumeroSequencialArquivo($numeroSequencialArquivo)
    {
        if((int)$numeroSequencialArquivo > 0) {
            $this->numeroSequencialArquivo = $numeroSequencialArquivo;
        } else {
            throw new \Exception("Número sequencial deve ser maior que 0");
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCodSegmento()
    {
        return $this->codSegmento;
    }

    /**
     * @return mixed
     */
    public function getCodMovimentoRemessa()
    {
        return sprintf("%02d", $this->codMovimentoRemessa);
    }

    /**
     * @param integer $codMovimentoRemessa
     * @return SegmentoP
     */
    public function setCodMovimentoRemessa($codMovimentoRemessa)
    {
        $this->codMovimentoRemessa = $codMovimentoRemessa;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNossoNumero()
    {
        $dv = $this->modulo_11($this->nossoNumero, 9 ,0);

        return sprintf("%013d", $this->nossoNumero.$dv);
    }

    /**
     * @param mixed $nossoNumero
     * @return SegmentoP
     * @throws \Exception
     */
    public function setNossoNumero($nossoNumero)
    {
        if((int) $nossoNumero > 0) {
            $this->nossoNumero = $nossoNumero;
        } else {
            throw new \Exception("Nosso número inválido");
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getNumeroDocumento()
    {
        return str_pad($this->numeroDocumento, 15, ' ', STR_PAD_RIGHT);
    }

    /**
     * @param int $numeroDocumento
     * @return SegmentoP
     */
    public function setNumeroDocumento($numeroDocumento)
    {
        $this->numeroDocumento = $numeroDocumento;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVencimento()
    {
        return sprintf("%08d", $this->vencimento);
    }

    /**
     * @param \DateTime $vencimento
     * @return SegmentoP
     */
    public function setVencimento(\DateTime $vencimento)
    {
        $this->vencimento = (int)$vencimento->format('dmY');
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValor()
    {
        return sprintf("%015d", number_format($this->valor, 2,'',''));
    }

    /**
     * @param mixed $valor
     * @return SegmentoP
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEspecie()
    {
        return sprintf("%02d", $this->especie);
    }

    /**
     * @param mixed $especie
     * @return SegmentoP
     */
    public function setEspecie($especie)
    {
        $this->especie = $especie;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAceite()
    {
        return $this->aceite;
    }

    /**
     * @return mixed
     */
    public function getDataEmissao()
    {
        return sprintf("%08d", $this->dataEmissao);
    }

    /**
     * @param \DateTime $dataEmissao
     * @return SegmentoP
     */
    public function setDataEmissao(\DateTime $dataEmissao)
    {
        $this->dataEmissao = $dataEmissao->format('dmY');
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValorDesconto()
    {
        return sprintf("%015d", number_format($this->valorDesconto, 2,'',''));
    }

    /**
     * @param mixed $valorDesconto
     * @return SegmentoP
     */
    public function setValorDesconto($valorDesconto)
    {
        $this->valorDesconto = $valorDesconto;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDataDesconto()
    {
        return sprintf("%08d", $this->dataDesconto);
    }

    /**
     * @param mixed $dataDesconto
     * @return SegmentoP
     */
    public function setDataDesconto(\DateTime $dataDesconto)
    {
        if ($this->valorDesconto > 0){
            $this->codigoDesconto = 1;
            $this->dataDesconto = $dataDesconto->format('dmY');
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCodigoDesconto()
    {
        return $this->codigoDesconto;
    }



    /**
     * @return int
     */
    public function getDataJurosMora()
    {
        return sprintf("%08d", $this->dataJurosMora);
    }

    /**
     * @param \DateTime $vencimento
     * @param integer $addDias
     * @return SegmentoP
     */
    public function setDataJurosMora(\DateTime $vencimento, $addDias)
    {
        $novaData = $vencimento->add(new \DateInterval("P{$addDias}D"));
        $this->dataJurosMora = $novaData->format("dmY");
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValorMoraDia()
    {
        return sprintf("%015d", number_format($this->valorMoraDia, 2,'',''));
    }

    /**
     * @param float $valor
     * @param float $juros
     * @return SegmentoP
     */
    public function setValorMoraDia($valor, $juros)
    {
        $valorJuros = $valor * ($juros/100);
        $this->valorMoraDia = $valorJuros;
        return $this;
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
            $resto = $soma % 11;
            return $resto;
        }
    }


}