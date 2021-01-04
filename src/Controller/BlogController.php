<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class BlogController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(PostRepository $ripo)
    {    $posts = $ripo->findAll();

        return $this->render('blog/index.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/posts/{id}", name="show_post")
     */

    public function show(Post $post)
    {
        return $this->render('blog/post.html.twig', [
            'post' => $post
        ]);

    }






}
