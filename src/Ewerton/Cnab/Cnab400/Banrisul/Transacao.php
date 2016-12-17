<?php
/**
 * Created by PhpStorm.
 * User: murilo
 * Date: 14/12/16
 * Time: 18:40
 */

namespace Ewerton\Cnab\Cnab400\Banrisul;


use Ewerton\Cnab\Cnab240\Generico\CnabInterface;
use Ewerton\Cnab\Utils\FormataString;

class Transacao implements CnabInterface
{

    const CARTEIRA = 1;
    const OCORRENCIA = '01';
    const COD_BANCO = '041';
    const TIPO_DOCUMENTO = '08';
    const ACEITE = 'N';
    const COD_MORA = '0';

    private $codigoCedente;
    private $numeroDocumeto;
    private $nossoNumero;
    private $seuNumero;
    private $vencimento;
    private $valor;
    private $dataEmissao;
    private $valorMoraDia;
    private $tipoInscricaoPagador;
    private $numeroInscricao;
    private $nomePagador;
    private $endereco;
    private $bairro;
    private $cep;
    private $cidade;
    private $estado;
    private $diasMulta;
    private $multa;
    private $sequencialRegistro;

    /**
     * @return mixed
     */
    public function getCodigoCedente()
    {
        return $this->codigoCedente;
    }

    /**
     * @param mixed $codigoCedente
     * @return $this
     */
    public function setCodigoCedente($codigoCedente)
    {
        $this->codigoCedente = sprintf("%013d", preg_replace('/[[:punct:]]/', '', $codigoCedente));
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumeroDocumeto()
    {
        return sprintf("%-25d", $this->numeroDocumeto);
    }

    /**
     * @param mixed $numeroDocumeto
     * @return Transacao
     */
    public function setNumeroDocumeto($numeroDocumeto)
    {
        $this->numeroDocumeto = $numeroDocumeto;
        $this->nossoNumero = $numeroDocumeto;
        $this->seuNumero = $numeroDocumeto;
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
     * @return mixed
     */
    public function getSeuNumero()
    {
        return sprintf("%-10d", $this->seuNumero);
    }

    /**
     * @return mixed
     */
    public function getVencimento()
    {
        return sprintf("%06d", $this->vencimento);
    }

    /**
     * @param \DateTime $vencimento
     * @return $this
     */
    public function setVencimento(\DateTime $vencimento)
    {
        $this->vencimento = (int)$vencimento->format('dmy');
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValor()
    {
        return sprintf("%013d", number_format($this->valor, 2, '', ''));
    }

    /**
     * @param mixed $valor
     * @return $this
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDataEmissao()
    {
        return sprintf("%06d", $this->dataEmissao);
    }

    /**
     * @param \DateTime $dataEmissao
     * @return $this
     */
    public function setDataEmissao(\DateTime $dataEmissao)
    {
        $this->dataEmissao = $dataEmissao->format('dmy');
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValorMoraDia()
    {
        return sprintf("%012d", number_format($this->valorMoraDia, 2, '', ''));
    }

    /**
     * @param float $valor
     * @param float $juros
     * @return $this
     */
    public function setValorMoraDia($valor, $juros)
    {
        $valorJuros = $valor * ($juros / 100);
        $this->valorMoraDia = $valorJuros;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTipoInscricaoPagador()
    {
        return sprintf("%02d", $this->tipoInscricaoPagador);
    }

    /**
     * @param mixed $tipoInscricaoPagador
     * @return $this
     */
    public function setTipoInscricaoPagador($tipoInscricaoPagador)
    {
        $this->tipoInscricaoPagador = $tipoInscricaoPagador;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumeroInscricao()
    {
        return sprintf("%014d", preg_replace('/[[:punct:]]/', '', $this->numeroInscricao));
    }

    /**
     * @param mixed $numeroInscricao
     * @return $this
     */
    public function setNumeroInscricao($numeroInscricao)
    {
        $this->numeroInscricao = $numeroInscricao;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNomePagador()
    {
        return str_pad(strtoupper(substr($this->nomePagador, 0,35)), 35, ' ', STR_PAD_RIGHT);
    }

    /**
     * @param mixed $nomePagador
     * @return $this
     */
    public function setNomePagador($nomePagador)
    {
        $this->nomePagador = $nomePagador;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEndereco()
    {
        return str_pad(strtoupper(substr($this->endereco. ' '. $this->bairro, 0,40)), 40, ' ', STR_PAD_RIGHT);
    }

    /**
     * @param mixed $endereco
     * @return $this
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
        return $this;
    }


    /**
     * @param mixed $bairro
     * @return $this
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCep()
    {
        return  sprintf("%08d", preg_replace('/[[:punct:]]/', '', $this->cep));
    }

    /**
     * @param mixed $cep
     * @return $this
     */
    public function setCep($cep)
    {
        $this->cep = $cep;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCidade()
    {
        $cidade = FormataString::retiraCaracteresEspecial($this->cidade);
        return str_pad(strtoupper(substr($cidade, 0,15)), 15, ' ', STR_PAD_RIGHT);
    }

    /**
     * @param mixed $cidade
     * @return $this
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     * @return $this
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDiasMulta()
    {
        return sprintf("%02d", $this->diasMulta);
    }

    /**
     * @param \DateTime $vencimento
     * @return $this
     */
    public function setDiasMulta($diasMulta)
    {


        $this->diasMulta = $diasMulta;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMulta()
    {
        return sprintf("%03d", number_format($this->multa, 1,'',''));
    }

    /**
     * @param float $multa
     * @return $this
     */
    public function setMulta($multa)
    {
        $this->multa = $multa;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSequencialRegistro()
    {
        return sprintf("%06d",$this->sequencialRegistro);
    }

    /**
     * @param mixed $sequencialRegistro
     * @return Transacao
     */
    public function setSequencialRegistro($sequencialRegistro)
    {
        $this->sequencialRegistro = $sequencialRegistro;
        return $this;
    }




    public function criaLinha()
    {
        // TODO: Implement criaLinha() method.
        //pos [1-1]
        $linha = 1;
        //pos [2-17]
        $linha .= str_pad('', 16);
        //pos [18-30]
        $linha .= $this->getCodigoCedente();
        //pos [31-37]
        $linha .= str_pad('', 7);
        //pos [38-62]
        $linha .= $this->getNumeroDocumeto();
        //pos[63-72]
        $linha .= $this->getNossoNumero();
        //pos[73-107]
        $linha .= str_pad('', 35);
        //pos[108-108]
        $linha .= self::CARTEIRA;
        //pos [109-110]
        $linha .= self::OCORRENCIA;
        //pos [111-120]
        $linha .= $this->getSeuNumero();
        //pos [121-126]
        $linha .= $this->getVencimento();
        //pos [127-139]
        $linha .= $this->getValor();
        //pos [140-142]
        $linha .= self::COD_BANCO;
        //pos [143-147]
        $linha .= str_pad('', 5);
        //pos [148-149]
        $linha .= self::TIPO_DOCUMENTO;
        //pos [150-150]
        $linha .= self::ACEITE;
        //pos [151-156]
        $linha .= $this->getDataEmissao();
        //pos [157-158]
        $linha .= 18;
        //pos [159-160]
        $linha .= str_pad('', 2, 0);
        //pos [161-161]
        $linha .= self::COD_MORA;
        //pos [162-173]
        $linha .= $this->getValorMoraDia();
        //pos [174-218]
        $linha .= str_pad('', 45, 0);
        //pos[219-220]
        $linha .= $this->getTipoInscricaoPagador();
        //pos[221-234]
        $linha .= $this->getNumeroInscricao();
        //pos[235-269]
        $linha .= $this->getNomePagador();
        //pos[270-274]
        $linha .= str_pad('', 5);
        //pos[275-314]
        $linha .= $this->getEndereco();
        //pos[315-321]
        $linha .= str_pad('', 7);
        //pos[222-224]
        $linha .= $this->getMulta();
        //pos [225-226]
        $linha .= '00';
        //pos [227-334]
        $linha .= $this->getCep();
        //pos [335-349]
        $linha .= $this->getCidade();
        //pos [350-351]
        $linha .= $this->getEstado();
        //pos [352-355]
        $linha .= str_pad('', 4, 0);
        //pos [356-357]
        $linha .= str_pad('', 2);
        //pos [358-371]
        $linha .= str_pad('', 14, 0);
        //pos [372-394]
        $linha .= str_pad('', 23);
        //pos [395-400]
        $linha .= $this->getSequencialRegistro();





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

    private function modulo_11($num, $base = 9, $r = 0)
    {
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
            $numeros[$i] = substr($num, $i - 1, 1);
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
        } elseif ($r == 1) {
            if ($soma < 11) {
                return $soma;
            }
            $resto = $soma % 11;
            return $resto;
        }
    }
}