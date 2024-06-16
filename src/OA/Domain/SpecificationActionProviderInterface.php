<?php
declare(strict_types=1);

namespace App\OA\Domain;

interface SpecificationActionProviderInterface
{
    /**
     * Provide the OpenAPI specification.
     *
     * @return object
     */
    public function provide(): object;
}