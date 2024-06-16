<?php

namespace App\Controller\Api\Abstract;



use PHPUnit\Util\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Psr\Http\Message\ResponseInterface as ResponseInterface;

abstract class Action
{
    protected Request $request;

    protected ResponseInterface $response;
    protected array $args;

    abstract protected function action(): ResponseInterface;
    public function __invoke(Request $request, ResponseInterface $response, array $args): ResponseInterface
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

    protected function respondWithData(object|array $data = null, int $statusCode = 200): ResponseInterface
    {
//        return $this->respond(new ActionPayload($statusCode, $data));
    }
}