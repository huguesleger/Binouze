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
     * @Route("admin/bieres", name="adminbiere")
     * @Template(":admin:biere.html.twig")
     */
    public function getBieres(){
        $em = $this->getDoctrine()->getEntityManager();
        $rsm = new ResultSetMappingBuilder($em);
        $rsm->addRootEntityFromClassMetadata('AppBundle:Bieres', 'bieres');
        $query = $em->createNativeQuery("select * from bieres", $rsm);
        $project = $query->getResult();
        return array ('projects' => $project);
    }
    
      /**
     * @Route ("/admin/add",name="form")
     * @Template (":admin:ajouter.html.twig")
     * @param Request $request
     */
    public function formBieres(Request $request) {
        //on créé un objet vide
        $project = new Bieres();
        //on lie un formulaire avec l'objet créé
        $f= $this->createForm(BieresType::class, $project);
       
        return array("formNews" => $f->createView());
    }
    
    /**
     * @Route ("/admin/val", name="valid")
     */
    public function addNews(Request $request) {
       $niouzes = new Bieres();
        //liaison de l'objet avec le formulaire temporaire
        //creation du formulaire tampon
        
        $f = $this->createForm(BieresType::class, $niouzes);
        //on fait quand meme une verif pour s'assurer d'avoir eu un POST comme requete http
        if ($request->getMethod() == 'POST') {
            //on lie le formulaire temporaire avec les valeurs de la requete de type post
            //en gros on se retrouve avec un fork de notre formulaire en local ;) 
            $f->handleRequest($request);
//            
//            $nomDuFichier = md5(uniqid()).".".$niouzes->getImage()->getClientOriginalExtension();
//            $niouzes->getImage()->move('web/uploads/img', $nomDuFichier);
//            $niouzes->setImage($nomDuFichier);
            //Partie persistance des données ou l'on sauvegarde notre news en base de données
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($niouzes);
            $em->flush();
            //J'avoue n'avoir implementer aucun test pour m'assurer de la validité des données en database
            //quoi qu'il en soit après avoir ajouter une news on appele la methode qui va nous afficher la liste des news
            //Bien entendu j'utilise les alias pour le routage ;) 
            //faire un redirect vers getNews();
            return $this->redirectToRoute('adminbiere');
        }
        //si jamais le post a pas marché je reviens vers l'edition
        //faire un redirect sur ajout de news
        return $this->redirectToRoute('form');
    }
}
