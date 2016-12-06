<?php

/**
 * @autor Ewerton Cardoso
 */

namespace Ewerton\Cnab\Cnab240\Generico;


use Ewerton\Cnab\Cnab240\Generico\CnabInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use Zend\I18n\Validator\DateTime;

abstract class SegmentoR implements CnabInterface
{
    use Arquivo;

    protected $numeroSequencialArquivo;

    /**
     * @var string
     */
    protected $codSegmento = 'R';

    /**
     * @var integer
     */
    protected $codMovimentoRemessa;

    /**
     * @var integer
     */
    protected $dataMulta;

    /**
     * @var integer
     */
    protected $valorMulta;


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
    public function getDataMulta()
    {
        return sprintf("%08d", $this->dataMulta);
    }

    /**
     * @param \DateTime $vencimento
     * @return SegmentoR
     */
    public function setDataMulta(\DateTime $vencimento, $addDias)
    {

        $novaData = $vencimento->add(new \DateInterval("P{$addDias}D"));
        $this->dataMulta = $novaData->format("dmY");
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValorMulta()
    {
        return sprintf("%015d", number_format($this->valorMulta, 2,'',''));
    }

    /**
     * @param float $valor
     * @param float $multa
     * @return SegmentoR
     */
    public function setValorMulta($valor, $multa)
    {
        $valorMulta = $valor * ($multa/100);
        $this->valorMulta = $valorMulta;
        return $this;
    }


}