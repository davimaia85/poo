<?php


declare(strict_types=1);

namespace App\Controller;

use App\Repository\UserRepository;

class AuthController extends AbstractController
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();

    }

    public function login():void
    {
        if(false === empty($_POST)){
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userRepository->findOneByEmail($email);

            return;
        }

    }
    
    public function logout():void
    {
        $this->render('auth/logout');
    }
}