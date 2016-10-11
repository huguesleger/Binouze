<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Actualite;
use AppBundle\Entity\Bieres;
use AppBundle\Entity\Images;
use AppBundle\Form\ActualiteType;
use AppBundle\Form\BieresType;
use AppBundle\Form\ImagesType;
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
    public function ajouterBiere() {
        $biere = $this->createForm(BieresType::class);
        return array("biere" => $biere->createView());
    }

    /**
     * @Route("admin/modif{id}", name="modif")
     * @Template(":admin:ajouter.html.twig")
     */
    public function modifierBiere($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $biere = $em->find('AppBundle:Bieres', $id);
        $f = $this->createForm(BieresType::class, $biere);
        return array("biere" => $f->createView(), "id" => $id);
    }

    /**
     * @Route("admin/supp{id}", name="supp")
     */
    public function supprimerBiere($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $u = $em->find('AppBundle:Bieres', $id);
        $this->createForm(BieresType::class, $u);
        $u->setAjouter(0);
        $em->merge($u);
        $em->flush();

        return $this->redirectToRoute("adminbiere");
    }

    /**
     * @Route("admin/maj{id}", name="maj")
     */
    public function majBiere(Request $req, $id) {
        $em = $this->getDoctrine()->getEntityManager();
        $b = $em->find('AppBundle:Bieres', $id);
        $biere = $this->createForm(BieresType::class, $b);
        if ($req->getMethod() == 'POST') {
            $biere->handleRequest($req);
            $em = $this->getDoctrine()->getEntityManager();
            $em->merge($b);
            $em->flush();

            return $this->redirect($this->generateUrl('adminbiere'));
        }
    }

    /**
     * @Route("/admin/valide",name="valid")
     * @param Request $req
     */
    public function validationBiere(Request $req) {
        $b = new Bieres();
        $biere = $this->createForm(BieresType::class, $b);
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
        $query = $em->createNativeQuery("select * from actualite ORDER BY date DESC", $rsm);
        $actu = $query->getResult();
        return array('actus' => $actu);
    }

    /**
     * @Route("admin/addActu", name="addActu")
     * @Template(":admin:ajouterActu.html.twig")
     */
    public function ajouterActualite() {
        $actu = $this->createForm(ActualiteType::class);
        return array("actu" => $actu->createView());
    }

    /**
     * @Route("admin/actumodif{id}", name="actumodif")
     * @Template(":admin:ajouterActu.html.twig")
     */
    public function modifierActu($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $biere = $em->find('AppBundle:Actualite', $id);
        $f = $this->createForm(ActualiteType::class, $biere);
        return array("actu" => $f->createView(), "id" => $id);
    }

    /**
     * @Route("admin/actuMaj{id}", name="actumaj")
     */
    public function majActu(Request $req, $id) {
        $em = $this->getDoctrine()->getEntityManager();
        $b = $em->find('AppBundle:Actualite', $id);
        $biere = $this->createForm(ActualiteType::class, $b);
        if ($req->getMethod() == 'POST') {
            $biere->handleRequest($req);
            $em = $this->getDoctrine()->getEntityManager();
            $em->merge($b);
            $em->flush();
            return $this->redirect($this->generateUrl('adminactu'));
        }
    }

    /**
     * @Route("/admin/actuValide",name="actuValid")
     * @param Request $req
     */
    public function validationActualite(Request $req) {
        $b = new Actualite();
        $biere = $this->createForm(ActualiteType::class, $b);
        if ($req->getMethod() == 'POST') {
            $biere->handleRequest($req);
            $em = $this->getDoctrine()->getManager();
            $em->persist($b);
            $em->flush();
            return $this->redirectToRoute('adminactu');
        }
        return $this->redirectToRoute('ajouter');
    }

    /**
     * @Route("admin/publication{id}", name="publi")
     */
    function ajouterSite($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $u = $em->find('AppBundle:Bieres', $id);
        $this->createForm(BieresType::class, $u);

        $u->setAjouter(1);

        $em->merge($u);
        $em->flush();

        return $this->redirectToRoute("adminbiere");
    }

    /**
     * @Route ("/admin/val", name="validimages")
     */
    public function addImages(Request $request) {
        $img = new Images();
        //liaison de l'objet avec le formulaire temporaire
        //creation du formulaire tampon

        $f = $this->createForm(ImagesType::class, $img);
        //on fait quand meme une verif pour s'assurer d'avoir eu un POST comme requete http
        if ($request->getMethod() == 'POST') {
            //on lie le formulaire temporaire avec les valeurs de la requete de type post
            //en gros on se retrouve avec un fork de notre formulaire en local ;) 
            $f->handleRequest($request);

            $nomDuFichier = md5(uniqid()) . "." . $img->getImages()->getClientOriginalExtension();
            $img->getImages()->move('uploads/img', $nomDuFichier);
            $img->setImages($nomDuFichier);
            //Partie persistance des données ou l'on sauvegarde notre news en base de données
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($img);
            $em->flush();
            //J'avoue n'avoir implementer aucun test pour m'assurer de la validité des données en database
            //quoi qu'il en soit après avoir ajouter une news on appele la methode qui va nous afficher la liste des news
            //Bien entendu j'utilise les alias pour le routage ;) 
            //faire un redirect vers getNews();
            return $this->redirectToRoute('img');
        }
        //si jamais le post a pas marché je reviens vers l'edition
        //faire un redirect sur ajout de news
        return $this->redirectToRoute('img');
    }

    /**
     * @Route("admin/addImg", name="img")
     * @Template(":admin:ajouterImg.html.twig")
     */
    public function ajouterImages() {
        $img = $this->createForm(ImagesType::class);
        return array("addImg" => $img->createView());
    }

    /**
     * @Route("admin/deconnexion", name="deco")
     * @Template(":site:index.html.twig")
     */
    public function deconnexion() {
        
    }

}
