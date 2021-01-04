<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class MyAPIController extends AbstractController
{

    /**
     * @Route("/a/p/i", name="a_p_i", methods={"GET"})
     */
    public function getMonAPI(PostRepository $postRepository): JsonResponse
    {
        $posts = $postRepository->findAll();
        $data = [];
        foreach ($posts as $post) {
            $data [] = [
                'id' => $post->getId(),
                'title' => $post->getTitle(),
                'author' => $post->getAuthor(),
                'content' => $post->getContent(),
                'createdAt' => $post->getCreatedAt(),
            ];
        }
        return new JsonResponse($data, Response::HTTP_OK);
    }


    /**
     * @Route("/fetchGitHubInformation", name="fetch_GitHub_Information")
     */
    public function fetchGitHubInformation(HttpClientInterface $client): Response
    {
        $response = $client->request(
            'GET',
            'http://medouaz-blog.herokuapp.com/api/posts'
        );

        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

        return $this->render('api/client.html.twig', [
            'posts' => $content
        ]);
    }

}
