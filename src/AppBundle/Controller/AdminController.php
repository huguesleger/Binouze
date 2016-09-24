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
 * Description of AdminController
 *
 * @author sebastien
 */
class AdminController extends Controller{
    /**
     * @Route("/admin", name="home")
     * @Template(":admin:base.html.twig")
     */
    public function indexAction()
    {
        
    }
    
    /**
     * @Route("/admin/brasserie", name="admbrass")
     * @Template(":admin:index.html.twig")
     */
    public function getBrasserie()
    {
        
    }
}
