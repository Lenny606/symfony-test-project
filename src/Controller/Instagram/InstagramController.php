<?php

namespace App\Controller\Instagram;

use App\Services\InstagramService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InstagramController extends AbstractController
{
    public function __construct(private InstagramService $instagramService)
    {
    }

    #[Route('/instagram/auth', name: 'app_instagram_auth')]
    public function index(Request $request): Response
    {

        $link = InstagramService::getCodeLink();

        if ($code = $request->query->get('code')) {
            $httpClient = HttpClient::create();
//            $code = json_decode(file_get_contents($this->getJsonFileName('instagram-code.json')), true)['code'];
            $url = 'https://graph.facebook.com/v13.0/oauth/access_token';
            $data = [
                'client_id' => '2602910283210589',
                'client_secret' => '6a85a7212da116b3deee31f65386b389',
                'grant_type' => 'authorization_code',
                'redirect_uri' => InstagramService::getRedirectURI(),
                'code' => $code,
            ];

            // Send a POST request
            $response = $httpClient->request('POST', $url, ['json' => $data]);
    var_dump($response);
            // Get the response body as JSON
//            $accessToken = $response->toArray()['access_token'];

            // Handle the access token
            // ...
        }


        return $this->render('instagram/index.html.twig', [
            'controller_name' => 'InstagramController',
            'link' => $link
        ]);
    }

    #[Route('/instagram/posts', name: 'app_instagram_posts')]
    public function showPosts(): Response
    {
        return $this->render('instagram/index.html.twig', [
            'controller_name' => 'InstagramController',
        ]);
    }
}
