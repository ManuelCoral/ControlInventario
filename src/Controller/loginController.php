<?php

namespace App\Controller;

use App\Entity\user;
use App\Service\userServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Exception;

class loginController extends AbstractController
{
    /** 
     * @Route("/api/login", name="api_login")
     */
    public function login(Request $request): Response
    {
        $result = [];
        $data = $request->getContent();
        $data = json_decode($data, true);

        if (!isset($data["usuario"]) || !isset($data["pass"])) {
            throw new Exception('Los datos enviados no son válidos, revisar información enviada', 1);
        } else {
            $objUser = new user();
            $objUser->userName = $data["usuario"];
            $objUser->password = $data["pass"];
        }

        $response = new Response();

        try {
            $services = new userServices();
            $val = $services->login($objUser);

            if ($val > 0) {
                $result = array("success" => true);
            }
            else {
                $result = array(
                    "success" => false,
                    "msjError" => "Usuario o contra invalida."
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