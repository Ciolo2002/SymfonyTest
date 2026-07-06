<?php

namespace App\Controller;

use HWI\Bundle\OAuthBundle\OAuth\ResourceOwner\GoogleResourceOwner;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\OAuth2User;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin_index')]
    public function index()
    {

        return $this->render('admin.html.twig');
    }
}