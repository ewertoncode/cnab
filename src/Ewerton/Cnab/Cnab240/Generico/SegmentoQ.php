<?php

/**
 * @autor Ewerton Cardoso
 */

namespace Ewerton\Cnab\Cnab240\Generico;


use Ewerton\Cnab\Cnab240\Generico\CnabInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use Zend\I18n\Validator\DateTime;

abstract class SegmentoQ implements CnabInterface
{
    use Arquivo;

    protected $numeroSequencialArquivo;

    /**
     * @var string
     */
    protected $codSegmento = 'Q';

    /**
     * @var integer
     */
    protected $codMovimentoRemessa;

    /**
     * @var integer
     */
    protected $tipoInscricaoPagador;

    /**
     * @var integer
     */
    protected $numeroInscricao;

    /**
     * @var string
     */
    protected $nomePagador;

    /**
     * @var string
     */
    protected $endereco;

    /**
     * @var string
     */
    protected $bairro;

    /**
     * @var integer
     */
    protected $cep;

    /**
     * @var string
     */
    protected $cidade;

    /**
     * @var string
     */
    protected $estado;

    /**
     * @var integer
     */
    protected $identificadorCarne;

    /**
     * @var integer
     */
    protected $numeroParcela;

    /**
     * @var integer
     */
    protected $totalParcelas;

    /**
     * @var integer
     */
    protected $numeroPlano;

    /**
     * @var
     */

    /**
     * @return mixed
     */
    public function getNumeroSequencialArquivo()
    {
        return sprintf("%05d", $this->numeroSequencialArquivo);
    }

    /**
     * @param mixed $numeroSequencialArquivo
     * @return SegmentoQ
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
     * @return string
     */
    public function getCodSegmento()
    {
        return $this->codSegmento;
    }

    /**
     * @return int
     */
    public function getCodMovimentoRemessa()
    {
        return sprintf("%02d", $this->codMovimentoRemessa);
    }

    /**
     * @param int $codMovimentoRemessa
     * @return SegmentoQ
     */
    public function setCodMovimentoRemessa($codMovimentoRemessa)
    {
        $this->codMovimentoRemessa = $codMovimentoRemessa;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTipoInscricaoPagador()
    {
        return $this->tipoInscricaoPagador;
    }

    /**
     * @param mixed $tipoInscricaoPagador
     * @return SegmentoQ
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
        return sprintf("%015d", preg_replace('/[[:punct:]]/', '', $this->numeroInscricao));
    }

    /**
     * @param mixed $numeroInscricao
     * @return SegmentoQ
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
        return str_pad(strtoupper(substr($this->nomePagador, 0,40)), 40, ' ', STR_PAD_RIGHT);
    }

    /**
     * @param mixed $nomePagador
     * @return SegmentoQ
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
        return str_pad(strtoupper(substr($this->endereco, 0,40)), 40, ' ', STR_PAD_RIGHT);
    }

    /**
     * @param mixed $endereco
     * @return SegmentoQ
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBairro()
    {
        return str_pad(strtoupper(substr($this->bairro, 0,15)), 15, ' ', STR_PAD_RIGHT);
    }

    /**
     * @param mixed $bairro
     * @return SegmentoQ
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
     * @return SegmentoQ
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
        $cidade = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$this->cidade);
        return str_pad(strtoupper(substr($cidade, 0,15)), 15, ' ', STR_PAD_RIGHT);
    }

    /**
     * @param mixed $cidade
     * @return SegmentoQ
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
     * @return SegmentoQ
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdentificadorCarne()
    {
        return sprintf("%03d", $this->identificadorCarne);
    }

    /**
     * @param mixed $identificadorCarne
     * @return SegmentoQ
     */
    public function setIdentificadorCarne($identificadorCarne)
    {
        $this->identificadorCarne = $identificadorCarne;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumeroParcela()
    {
        return sprintf("%03d", $this->numeroParcela);
    }

    /**
     * @param mixed $numeroParcela
     * @return SegmentoQ
     */
    public function setNumeroParcela($numeroParcela)
    {
        $this->numeroParcela = $numeroParcela;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalParcelas()
    {
        return sprintf("%03d", $this->totalParcelas);
    }

    /**
     * @param mixed $totalParcelas
     * @return SegmentoQ
     */
    public function setTotalParcelas($totalParcelas)
    {
        $this->totalParcelas = $totalParcelas;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumeroPlano()
    {
        return sprintf("%03d", $this->numeroPlano);
    }

    /**
     * @param mixed $numeroPlano
     * @return SegmentoQ
     */
    public function setNumeroPlano($numeroPlano)
    {
        $this->numeroPlano = $numeroPlano;
        return $this;
    }


}