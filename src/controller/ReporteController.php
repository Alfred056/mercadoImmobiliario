<?php 

    namespace App\Controller;

    use Psr\Container\ContainerInterface;    
    use Psr\Http\Message\ServerRequestInterface as Request;   
    use Slim\Psr7\Response as Response;
    //use Psr\Http\Message\ResponseInterface as Response;

    
    use Slim\Views\PhpRenderer;
    use App\repository\{
        RepoSeries,
        RepoBCR,
        RepoSBS,
        RepoOSEI,
        RepoVenta,
        RepoTasas
    };



    class ReporteController
    {
        protected $container;
        
        public function __construct(ContainerInterface $container){
            $this->container = $container;

        }

        public function report( Request $request, Response $response, $args) {

            $ANIO = '2021';

            $repoSerie = new RepoSeries($this->container);
            $repoBcr   = new RepoBCR($this->container);
            $repoSbs   = new RepoSBS($this->container);
            $repoOsei  = new RepoOSEI($this->container);
            $repoVenta = new RepoVenta($this->container);
            $repoTasa  = new RepoTasas($this->container);
            
            $distritos      = $repoSerie->listarDistritos(4);
            $codigos        = $repoSerie->listarSeriesTipo(4);
          
            $data           = $repoBcr->ejecutarConsultar('GET',$codigos,'2021-1','2021-1');
            $PrecioM2Data   = $repoBcr->ejecutarConsultar('GET','PD37944PQ','2021-1','2021-1');
            $TipoCambio     = $repoSbs->obtenerTipoCambio();
            $DataOsei       = $repoOsei->listarData($ANIO);
            $dataOptima     = $repoVenta->minutasActuales($ANIO);
            $dataCreditoHipo     = $repoTasa->creditoHipotecario($ANIO);
            
           /*  var_dump($data);die(); */
            $variables = [
                "distritos" => $distritos,
                "ventas" => $data['periods'][0]['values'],
                "precioM2" => $PrecioM2Data['periods'][0]['values'],
                "tcVenta" => $TipoCambio['venta'],
                "tcCompra" => $TipoCambio['compra'],
                "dataOsei" => $DataOsei,
                "dataOptima" => $dataOptima,
                "dataCreditoHipo" => $dataCreditoHipo
            ];
           
          //  echo __DIR__;die();
          //  $content =  $this->container->get('view')->fetch('rpt.twig', $variables);
        
            $renderer = new PhpRenderer(__DIR__ . '/../template/',$variables);
            return $renderer->render($response, "reporte.php", $args);

       }


    }
    