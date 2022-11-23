<?php
    declare(strict_types=1);
    abstract class AbstractController
         {
            public function render(string $view, array $dados = []): void
            {
               include_once '../views/template/header.phtml';
               include_once "../views/{$views}.phtml";
               include_once '../views/template/footer.phtml';
            }
            
         }