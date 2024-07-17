<?php

namespace App\repository;
use Psr\Container\ContainerInterface;
use GuzzleHttp\Client;

class RepoSBS {
    protected $api_key = '7RCr7klR0DiHgY9HJTLZxJ0d2fEubeyyn2eFGGOkG4fR6C5I4p833EKfKeyW';
    protected $container;
    protected $BASE_URL ='https://www.sbs.gob.pe/app/xmltipocambio/';

    public function __construct(ContainerInterface $container){
        $this->container = $container;
    }

    public function consultarTipoCambio(){
        $client_sbs  = new Client(
            [
                'base_uri' => 'https://www.sbs.gob.pe/app/xmltipocambio/'  // TC_TI_Portal_xml.xml?_=1628816053683'
            ]
        );
        $ruta_tipo_cambio = 'TC_TI_Portal_xml.xml';
        $TipoCambioRpt = $client_sbs->get($ruta_tipo_cambio);
        $TipoCambioRpt =(string) $TipoCambioRpt->getBody();
        $TipoCambioRpt = explode("$",$TipoCambioRpt);
        $TipoCambio = (explode(" ",$TipoCambioRpt[1]));
        return $TipoCambio;
    }

    public function consultarTipoCambio2($api_key, $base_currency = 'USD', $target_currency = 'PEN'){
        $url = "https://api.peruapis.com/v1/exchange";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $api_key,
        'Accept: application/json'
        ]);
        $response = curl_exec($ch);
        curl_close($ch);
    
        $data = json_decode($response, true);

        if(isset($data['exchange_rate'])) {
            return [
                'compra' => $data['exchange']['compra'],
                'venta' => $data['exchange']['venta']
            ];
        } else {
            return [
                'compra' => 'N/A',
                'venta' => 'N/A'
            ];
        }
    }

    public function obtenerTipoCambio(){
        $TipoCambio = $this->consultarTipoCambio2($this->api_key);
        return $TipoCambio;
    }
}
