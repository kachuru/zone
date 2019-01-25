<?php

namespace App\Controller;

use Kachuru\Zone\Map\MapStencil;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    /**
     * @var MapStencil
     */
    private $map;

    public function __construct(MapStencil $map)
    {
        $this->map = $map;
    }

    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', [
            'map' => $this->map
        ]);
    }
}
