<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
/**
 * Description of ViewController
 *
 * @author sebastien
 */
class ViewController extends Controller{
    /**
     * @Route("/", name="home")
     * @Template(":site:index.html.twig")
     */
    public function home()
    {
     
    }
    /**
     * @Route("/brasserie", name="brass")
     * @Template(":site:brasserie.html.twig")
     */
    public function brasserie()
    {
     
    }
    /**
     * @Route("/biere", name="biere")
     * @Template(":site:biere.html.twig")
     */
    public function biere()
    {
     
    }
    /**
     * @Route("/fabrication", name="fab")
     * @Template(":site:fabrication.html.twig")
     */
    public function fabrication()
    {
     
    }
    /**
     * @Route("/actualite", name="actu")
     * @Template(":site:actualite.html.twig")
     */
    public function actualite()
    {
     
    }
    /**
     * @Route("/contact", name="contact")
     * @Template(":site:contact.html.twig")
     */
    public function contact()
    {
     
    }
}
