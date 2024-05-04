<?php

namespace App\Controller\Api\Abstract;



use PHPUnit\Util\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class Action
{
    protected Request $request;

    protected Response $response;
    protected array $args;

    abstract protected function action(): Response;
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;

        try {
            return $this->action();
        } catch (Exception $e) {
            throw new Exception($this->request, $e->getMessage());
        }
    }

    protected function respondWithData(object|array $data = null, int $statusCode = 200): Response
    {
//        return $this->respond(new ActionPayload($statusCode, $data));
    }
}