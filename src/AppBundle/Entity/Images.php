<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints\File;

/**
 * Images
 *
 * @ORM\Table(name="images")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ImagesRepository")
 */
class Images
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="noms", type="string", length=512)
     */
    private $noms;
    
    /**
     * @var UploadedFile
     * @ORM\Column(name="images", type="string", length=512)
     * @File(mimeTypes={"image"})
     */
    private $images;
    function getImages() {
        return $this->images;
    }

    function setImages($images) {
        $this->images = $images;
    }

    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set noms
     *
     * @param string $noms
     *
     * @return Images
     */
    public function setNoms($noms)
    {
        $this->noms = $noms;

        return $this;
    }

    /**
     * Get noms
     *
     * @return string
     */
    public function getNoms()
    {
        return $this->noms;
    }
    
    public function __toString() {
        return $this->getNoms();
    }

}

