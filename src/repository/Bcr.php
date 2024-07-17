<?php  

namespace App\repository;
use Psr\Container\ContainerInterface;
use GuzzleHttp\Client;

class RepoBCR {

    protected $container;
    protected $BASE_URL ='https://estadisticas.bcrp.gob.pe/estadisticas/series/api/';

    public function __construct(ContainerInterface $container){
        $this->container = $container;
    }
    /* https://estadisticas.bcrp.gob.pe/estadisticas/series/api/PN01288PM-PN01289PM/json/2013-1/2016-9 */
    public function ejecutarConsultar($tipo,$series,$desde,$hasta){
        $client = new Client([
            'base_uri' => $this->BASE_URL,
            'timeout'  => 2.0,
        ]);
        $ruta = $series.'/json/'. $desde.'/'. $hasta.'/';
        $apiBcr = $client->request('GET',$ruta);
        $data = (json_decode($apiBcr->getBody()->getContents(), true, 100, JSON_INVALID_UTF8_IGNORE));
        return $data;
    }
}