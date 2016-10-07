<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Bieres;
use AppBundle\Form\BieresType;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of AdminController
 *
 * @author sebastien
 */
class AdminController extends Controller {

    /**
     * @Route("/admin", name="admin")
     * @Template(":admin:index.html.twig")
     */
    public function homeAdmin() {
        
    }

    /**
     * @Route("admin/brasserie", name="adminbrass")
     * @Template(":admin:brasserie.html.twig")
     */
    public function brasserieAdmin() {
        
    }

    /**
     * @Route("admin/biere", name="adminbiere")
     * @Template(":admin:biere.html.twig")
     */
    public function biereAdmin() {
        $em = $this->getDoctrine()->getManager();
        $rsm = new ResultSetMappingBuilder($em);
        $rsm->addRootEntityFromClassMetadata('AppBundle:Bieres', 'biere');
        $query = $em->createNativeQuery("select * from bieres", $rsm);
        $biere = $query->getResult();
        return array('biereAdmin' => $biere);
    }

    /**
     * @Route("admin/ajouter", name="ajouter")
     * @Template(":admin:ajouter.html.twig")
     */
    public function ajouterAdmin() {
        $biere = $this->createForm(BieresType::class, new Bieres());
        return array("biere" => $biere->createView());
    }

    /**
     * @Route("/admin/valide",name="valid")
     * @param Request $req
     */
    public function validation(Request $req) {
        $b = new Bieres();
        $biere = $this->createForm(BieresType::class,$b );
        if ($req->getMethod() == 'POST') {
            $biere->handleRequest($req);
            $em = $this->getDoctrine()->getManager();
            $em->persist($b);
            $em->flush();
            return $this->redirectToRoute('adminbiere');
        }
        return $this->redirectToRoute('ajouter');
    }

    /**
     * @Route("admin/fabrication", name="adminfab")
     * @Template(":admin:fabrication.html.twig")
     */
    public function fabricationAdmin() {
        
    }

    /**
     * @Route("admin/actualite", name="adminactu")
     * @Template(":admin:actualite.html.twig")
     */
    public function actualiteAdmin() {
        $em = $this->getDoctrine()->getManager();
        $rsm = new ResultSetMappingBuilder($em);
        $rsm->addRootEntityFromClassMetadata('AppBundle:Actualite', 'actualite');
        $query = $em->createNativeQuery("select * from actualite orderby date desc", $rsm);
        $actu = $query->getResult();
        return array('actu' => $actu);
    }

    /**
     * @Route("admin/deconnexion", name="deco")
     * @Template(":site:index.html.twig")
     */
    public function deconnexion() {
        
    }

}
