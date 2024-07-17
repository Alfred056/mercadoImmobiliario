<?php  

namespace App\repository;
use Psr\Container\ContainerInterface;
use Medoo\Medoo;

class RepoGeneral {

    protected $container;
  
    public function __construct(ContainerInterface $container){
        $this->container = $container;
    }

    public function minutasGenerales(){
        $service = $this->container->get('database'); 
        $data = $service->select("venta(v)",["[><]gerencia(g)" => ["v"."id_gerencia" => "g"."id_gerencia"],
                                 ["[><]categoria_gerencia(ct)" => ["ct"."id_categoria_gerencia" => "g"."id_categoria_gerencia"]]],
            [
                "nombre" => Medoo::raw('<nombre>'),
                "total" => Medoo::raw('SUM(<total>)'),
                "cantidad" => Medoo::raw('COUNT(<id_venta>)')
            ],
            Medoo::raw('WHERE
                    enable = 1 and 
                    fecha_minuta is not null
                    and year(<fecha_minuta>) = 02
                    and month(<fecha_minuta>) = 2022
                    and <v.check_otro_di> = 0
                    GROUP BY <ct.nombre> = DESC
                ')
        );
        return $data;
    }
}