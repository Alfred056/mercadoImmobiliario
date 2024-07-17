<?php  

namespace App\repository;
use Psr\Container\ContainerInterface;

class RepoSeries {

    protected $container;
    public function __construct(ContainerInterface $container){
        $this->container = $container;
    }
    
    public function listarDistritos($tipoReporte){
        $service = $this->container->get('database'); 
        $distritos = $service->select("bcr_reporte_inmobiliario_series",
        [
            "codigo",
            "serie"
        ],
        [
            "id_rpt"=>$tipoReporte
        ]
        );
        return $distritos;
    }
    public function listarSeriesTipo($tipoReporte){
        $service = $this->container->get('database'); 
        $distritos = $service->select("bcr_reporte_inmobiliario_series",
        [
            "codigo",
            "serie"
        ],
        [
            "id_rpt"=>$tipoReporte
        ]
        );
        $codigos="";
        foreach($distritos as $row){
            $codigos = $codigos .'-'. $row['codigo'];
        }
        $codigos =substr($codigos,1,strlen($codigos));    
        return $codigos;
    }
}