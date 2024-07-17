<?php  

namespace App\repository;
use Psr\Container\ContainerInterface;

class RepoTasas {

    protected $container;
  
    public function __construct(ContainerInterface $container){
        $this->container = $container;
    }

    public function creditoHipotecario($anio){
        $service = $this->container->get('database'); 
        $dataCreditoHipo = $service->select("tasa_interes_hipotecario",[
            "[><]banco" =>["id_banco"]
        ],
        [
            "nombre",
            "monto"
        ],
        [
            "anio"=> $anio
        ]
        );
        return $dataCreditoHipo;
    }
}