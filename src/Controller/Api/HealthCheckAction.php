<?php

namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HealthCheckAction
{
    #[Route("/health", name: "health")]
    public function __invoke(): JsonResponse
    {
        // You can perform any health checks here

        // For example, check if the database connection is successful
//        $dbConnected = $this->checkDatabaseConnection();
//
//        // Define the health status based on the result of your health checks
//        $healthStatus = $dbConnected ? 'healthy' : 'unhealthy';

        // Return a JSON response indicating the health status
        return new JsonResponse(['status' => "OK"]);
    }

    private function checkDatabaseConnection(): bool
    {
        // Perform database connection check
        // Replace this with your actual database connection check logic
        // Return true if the database connection is successful, otherwise return false
        try {
            // Example: Check if the database connection can be established
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->getConnection()->connect();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}