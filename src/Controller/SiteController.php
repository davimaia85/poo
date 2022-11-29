<?php

declare(strict_types=1);

namespace App\Controller;

class SiteController extends AbstractController
{
    public function inicio(): void
    {
        $this->checkLogin();
        $this->redirect('/login');
    }

    
}