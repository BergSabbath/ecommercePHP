<?php

namespace Hcode;

use Rain\Tpl;

class Page 
{
    //atributos da classse
    private $tpl;
    private $options = [];
    private $defaults = [
        "data" => []
    ];
    // construct method
    public function __construct($opts = array())
    {
        // mescla os array e o ultimo sobscreve o primeiro
        $this->options = array_merge($this->defaults, $opts);
        //template configuration
        /*precisa de uma pasta para pegar os arquivos HTML e
        uma pasta em cache*/
        //$_SERVER vai dizer onde esta a pasta, o diretorio root do servidor
        $config = array(
            "tpl_dir"       =>$_SERVER["DOCUMENT_ROOT"] . "/views/", // pasta criada
            "cache_dir"     =>$_SERVER["DOCUMENT_ROOT"] . "/views-cache/", // pasta criada
            "debug"         => false 
        );

        Tpl::configure( $config );

        $this->tpl = new Tpl;

        $this->setData($this->options["data"]);//chamando o metodo setData que está 
        //criando na linha 42.

        $this->tpl->draw("header");// para criar o cabeça iniciais do HTML
    
    }

    //para pegar os dados
    private function setData($data = array())
    {
        foreach ($data as $key => $value) {
            $this->tpl->assign($key, $value);
        }

    }
    
    public function setTpl($name, $data = array(), $returnHTML = false)
    {
        $this->setdata($data);

        return $this->tpl->draw($name, $returnHTML);
    }
    //destruct method
    public function __destruct()
    {
        $this->tpl->draw("footer");// criar a parte final da pagina HTML
    

    }

}


?>