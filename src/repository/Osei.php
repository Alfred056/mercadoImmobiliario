<?php  

namespace App\repository;
use Psr\Container\ContainerInterface;

class RepoOSEI {

    protected $container;
  

    public function __construct(ContainerInterface $container){
        $this->container = $container;
    }

    public function listarData($anio){
        $service = $this->container->get('database'); 
        $dataOsei = $service->select("osei",
            [
                "anio",
                "mes",
                "unidades"
            ],
            [
                "anio"=>$anio
            ]
        );
        return $dataOsei;
    }
}