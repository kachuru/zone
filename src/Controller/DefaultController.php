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
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/map");
     */
    public function map()
    {
        return $this->render('default/map.html.twig', [
            'map' => $this->map
        ]);
    }
}
