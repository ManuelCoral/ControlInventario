<?php

namespace App\Controller;

use App\Entity\motocicleta;
use App\Entity\automovil;
use App\Service\moticicletaServices;
use App\Service\automovilServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Exception;

class vehiculoController extends AbstractController
{
    /** 
     * @Route("/api/getMotocicletas", name="api_getMotocicletas")
     */
    public function getMotocicletas(Request $request): Response
    {
        $result = [];
        $response = new Response();
        $data = $request->getContent();
        $data = json_decode($data, true);

        if (!isset($data["tipoVehiculo"])) {
            throw new Exception('Los datos enviados no son válidos, revisar información enviada', 1);
        }

        try {
            $services = new moticicletaServices();
            $val = $services->getVehiculosBD($data["tipoVehiculo"]);

            if ($val > 0) {
                $result = array(
                    "success" => true,
                    "datos" => $val
                );
            }

            $response->setStatusCode(200);
            $response->setContent(json_encode($result));
        } catch (\Exception $ex) {
            $response->setStatusCode(409);
            $response->setContent($ex->getMessage());
        }

        return $response;
    }

    /** 
     * @Route("/api/getAutomovil", name="api_getAutomovil")
     */
    public function getAutomovil(Request $request): Response
    {
        $result = [];
        $response = new Response();
        $data = $request->getContent();
        $data = json_decode($data, true);

        if (!isset($data["tipoVehiculo"])) {
            throw new Exception('Los datos enviados no son válidos, revisar información enviada', 1);
        }

        try {
            $services = new automovilServices();
            $val = $services->getVehiculosBD($data["tipoVehiculo"]);

            if ($val > 0) {
                $result = array(
                    "success" => true,
                    "datos" => $val
                );
            }

            $response->setStatusCode(200);
            $response->setContent(json_encode($result));
        } catch (\Exception $ex) {
            $response->setStatusCode(409);
            $response->setContent($ex->getMessage());
        }

        return $response;
    }

    /** 
     * @Route("/api/setAutomovil", name="api_setAutomovil")
     */
    public function setAutomovil(Request $request): Response
    {
        $result = [];
        $response = new Response();
        $data = $request->getContent();
        $data = json_decode($data, true);

        if (
            !isset($data["tipoVehiculo"]) || !isset($data["potencia"]) ||
            !isset($data["numPuerta"]) || !isset($data["matricula"])
        ) {
            throw new Exception('Los datos enviados no son válidos, revisar información enviada', 1);
        }

        try {
            $auto = new automovil();

            $auto->tipoVehiculo = $data["tipoVehiculo"];
            $auto->potencia = $data["potencia"];
            $auto->numPuertas = $data["numPuerta"];
            $auto->matricula = $data["matricula"];

            $services = new automovilServices();
            $val = $services->setVehiculosBD($auto);

            if ($val > 0) {
                $result = array(
                    "success" => $val
                );
            }

            $response->setStatusCode(200);
            $response->setContent(json_encode($result));
        } catch (\Exception $ex) {
            $response->setStatusCode(409);
            $response->setContent($ex->getMessage());
        }

        return $response;
    }

    /** 
     * @Route("/api/setMotocicleta", name="api_setMotocicleta")
     */
    public function setMotocicleta(Request $request): Response
    {
        $result = [];
        $response = new Response();
        $data = $request->getContent();
        $data = json_decode($data, true);

        if (
            !isset($data["tipoVehiculo"]) || !isset($data["potencia"]) ||
            !isset($data["matricula"])
        ) {
            throw new Exception('Los datos enviados no son válidos, revisar información enviada', 1);
        }

        try {
            $moto = new motocicleta();

            $moto->tipoVehiculo = $data["tipoVehiculo"];
            $moto->potencia = $data["potencia"];
            $moto->matricula = $data["matricula"];

            $services = new moticicletaServices();
            $val = $services->setVehiculosBD($moto);

            if ($val > 0) {
                $result = array(
                    "success" => $val
                );
            }

            $response->setStatusCode(200);
            $response->setContent(json_encode($result));
        } catch (\Exception $ex) {
            $response->setStatusCode(409);
            $response->setContent($ex->getMessage());
        }

        return $response;
    }

    /** 
     * @Route("/api/editAutomovil", name="api_editAutomovil")
     */
    public function editAutomovil(Request $request): Response
    {
        $result = [];
        $response = new Response();
        $data = $request->getContent();
        $data = json_decode($data, true);

        if (
            !isset($data["tipoVehiculo"]) || !isset($data["potencia"]) ||
            !isset($data["numPuerta"]) || !isset($data["matricula"])
        ) {
            throw new Exception('Los datos enviados no son válidos, revisar información enviada', 1);
        }

        try {
            $auto = new automovil();

            $auto->id = $data['id'];
            $auto->tipoVehiculo = $data["tipoVehiculo"];
            $auto->potencia = $data["potencia"];
            $auto->numPuertas = $data["numPuerta"];
            $auto->matricula = $data["matricula"];

            $services = new automovilServices();
            $val = $services->editVehiculosBD($auto);

            if ($val > 0) {
                $result = array(
                    "success" => $val
                );
            }

            $response->setStatusCode(200);
            $response->setContent(json_encode($result));
        } catch (\Exception $ex) {
            $response->setStatusCode(409);
            $response->setContent($ex->getMessage());
        }

        return $response;
    }

    /** 
     * @Route("/api/editMotocicleta", name="api_editMotocicleta")
     */
    public function editMotocicleta(Request $request): Response
    {
        $result = [];
        $response = new Response();
        $data = $request->getContent();
        $data = json_decode($data, true);

        if (
            !isset($data["tipoVehiculo"]) || !isset($data["potencia"]) ||
            !isset($data["matricula"])
        ) {
            throw new Exception('Los datos enviados no son válidos, revisar información enviada', 1);
        }

        try {
            $moto = new motocicleta();

            $moto->id = $data["id"];
            $moto->tipoVehiculo = $data["tipoVehiculo"];
            $moto->potencia = $data["potencia"];
            $moto->matricula = $data["matricula"];

            $services = new moticicletaServices();
            $val = $services->editVehiculosBD($moto);

            if ($val > 0) {
                $result = array(
                    "success" => $val
                );
            }

            $response->setStatusCode(200);
            $response->setContent(json_encode($result));
        } catch (\Exception $ex) {
            $response->setStatusCode(409);
            $response->setContent($ex->getMessage());
        }

        return $response;
    }

    /** 
     * @Route("/api/deleteMotocicleta", name="api_deleteMotocicleta")
     */
    public function deleteMotocicleta(Request $request): Response
    {
        $result = [];
        $response = new Response();
        $data = $request->getContent();
        $data = json_decode($data, true);

        if ( !isset($data["id"]) ) {
            throw new Exception('Los datos enviados no son válidos, revisar información enviada', 1);
        }

        try {   
            $id = $data["id"];

            $services = new moticicletaServices();
            $val = $services->deleteVehiculosBD($id);

            if ($val > 0) {
                $result = array(
                    "success" => $val
                );
            }

            $response->setStatusCode(200);
            $response->setContent(json_encode($result));
        } catch (\Exception $ex) {
            $response->setStatusCode(409);
            $response->setContent($ex->getMessage());
        }

        return $response;
    }
    
}