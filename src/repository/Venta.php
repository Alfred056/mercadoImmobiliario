<?php  

namespace App\repository;
use Psr\Container\ContainerInterface;
use Medoo\Medoo;

class RepoVenta {

    protected $container;
  
    public function __construct(ContainerInterface $container){
        $this->container = $container;
    }

    public function minutasActuales($anio){
        $service = $this->container->get('database'); 
        $data = $service->select("venta",
            [
                "anio" => Medoo::raw('YEAR(<fecha_minuta>)'),
                "mes"  => Medoo::raw('MONTH(<fecha_minuta>)'),
                "unidades" => Medoo::raw('COUNT(<fecha_minuta>)')
            ],
            Medoo::raw('WHERE
                    enable = 1 and 
                    fecha_minuta is not null
                    and year(<fecha_minuta>) = '.$anio.'
                    GROUP BY year(<fecha_minuta>), month(<fecha_minuta>)
                    ORDER BY month(<fecha_minuta>)
                ')
        );
        return $data;
    }   
}