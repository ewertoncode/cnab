<?php

namespace Ewerton\Cnab\Cnab240\Banrisul;

use Ewerton\Cnab\Cnab240\Generico\HeaderArquivo as HeaderArquivoGenerico;
use Ewerton\Cnab\Cnab240\Banrisul\DadosBancarios;


class HeaderArquivoBanrisul extends HeaderArquivoGenerico
{

    use DadosBancarios;


    protected $numeroSequencialArquivo;

    protected $versaoLayoutArquivo = 40;

    protected $inscricao;

    protected $horaGeracao;

    protected $densidadeArquivoGravacao = 0000;

    /**
     * @return int
     */
    public function getDensidadeArquivoGravacao()
    {
        return sprintf("%05d", $this->densidadeArquivoGravacao);
    }


    /**
     * @return mixed
     */
    public function getHoraGeracao()
    {
        return $this->horaGeracao;
    }

    /**
     * @param mixed $horaGeracao
     * @return $this
     */
    public function setHoraGeracao($horaGeracao)
    {
        $this->horaGeracao = $horaGeracao;
        return $this;
    }

    /**
     *
     * @param integer $tipoEmpresa
     * @throws \Exception
     * @return $this
     */
    public function setTipoEmpresa($tipoEmpresa = 2)
    {
        if((int)$tipoEmpresa === 1 || (int) $tipoEmpresa === 2) {
            $this->tipoEmpresa = $tipoEmpresa;
        } else {
            throw new \Exception("Tipo de empresa inválido: 1 = CPF, 2 = CNPJ");
        }

        return $this;
    }


    /**
     * @return mixed
     */
    public function getNumeroSequencialArquivo()
    {
        return $this->numeroSequencialArquivo;
    }

    /**
     * @param mixed $numeroSequencialArquivo
     * @return $this
     */
    public function setNumeroSequencialArquivo($numeroSequencialArquivo)
    {
        $this->numeroSequencialArquivo = sprintf("%06d", $numeroSequencialArquivo);
        return $this;
    }

    /**
     * @return int
     */
    public function getVersaoLayoutArquivo()
    {
        return sprintf("%03d", $this->versaoLayoutArquivo);
    }


    /**
     * @return string
     */
    public function criaLinha()
    {
        //pos[1-3] - 3 dígitos
        $linha = '041';
        //pos[4-7] - 4
        $linha .= $this->getLote();
        //post[8-8] - 1
        $linha .= $this->getRegistro();
        //pos[9-17] - 9
        $linha .= sprintf(str_pad('', 9));
        //pos[18-18] - 1
        $linha .= $this->getTipoEmpresa();
        //post[19-32] - 14
        $linha .= $this->getInscricao();
        //pos[33-52] - 20
        $linha .= $this->getConvenio();
        //pos[53-57] - 5
        $linha .= $this->getAgencia();
        //pos[58-58] - 1 - Dígito agência
        $linha .= sprintf(str_pad('', 1));
        //pos[59-70] - 12
        $linha .= $this->getConta();
        //pos[71-71] - 1 - Dígito conta
        $linha .= $this->getContaDv();
        //pos[72-72] - 1 - Dígito A/C
        $linha .= sprintf(str_pad('', 1));
        //pos[73-102] - 30
        $linha .= $this->getNomeEmpresa();
        //pos[103-132] - 30
        $linha .= $this->getNomeBanco();
        //pos[133-142] - 10
        $linha .= sprintf(str_pad('', 10));
        //pos[143-143] -1
        $linha .= $this->getCodigoRemessa();
        //pos[144-151] 8
        $linha .= $this->getDataGeracao();
        //pos[152-157] - 6
        $linha .= $this->getHoraGeracao();
        //pos[158-163] - 6
        $linha .= $this->getNumeroSequencialArquivo();
        //pos[164-166] - 3
        $linha .=$this->getVersaoLayoutArquivo();
        //pos[167-171]  - 5
        $linha .=$this->getDensidadeArquivoGravacao();
        //pos[172-191] - 20
        $linha .= sprintf(str_pad('', 20));
        //pos[192-211] - 20
        $linha .= sprintf(str_pad('', 20));
        //pos[212-240] - 29
        $linha .= sprintf(str_pad('', 29));
        $linha .= "\n";

        return $linha;

    }

    /**
     * @param mixed $inscricao
     * @return $this
     */

    public function setInscricao($inscricao)
    {
        $this->inscricao = sprintf("%014d", preg_replace('/[[:punct:]]/', '', $inscricao));
        return $this;
    }


    public function getNomeBanco()
    {
        $banco = 'BANRISUL';
        return sprintf("%-30s", $banco);

    }

}