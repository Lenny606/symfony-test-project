<?php

namespace App\OA\Domain;

use App\Controller\Api\Abstract\Action;
use Exception;
use Psr\Http\Message\ResponseInterface;

class SpecificationAction extends Action
{
    public function __construct(
        private readonly SpecificationActionProviderInterface $specProvider
    ) {
    }

    protected function action(): ResponseInterface
    {
        $json = json_encode($this->specProvider->provide(), JSON_PRETTY_PRINT);

        if (!$json) {
            throw new Exception("Cannot serialize OpenAPI specification.");
        }

        $this->response->getBody()->write($json);

        return $this->response
            ->withHeader('Content-Type', 'application/json');
    }
}