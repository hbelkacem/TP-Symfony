<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Musee
 *
 * @ORM\Table(name="musee")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MuseeRepository")
 */
class Musee
{
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Commentaire" , mappedBy="musee")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $commentaire ;

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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="coordonnees", type="string", length=255)
     */
    private $coordonnees;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="codePostal", type="string", length=255, nullable=true)
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="siteWeb", type="string", length=255, nullable=true)
     */
    private $siteWeb;

    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=255, nullable=true)
     */
    private $statut;

    /**
     * @var string
     *
     * @ORM\Column(name="reouverture", type="string", length=255, nullable=true)
     */
    private $reouverture;

    /**
     * @var string
     *
     * @ORM\Column(name="fermetureAnnuelle", type="string", length=255, nullable=true)
     */
    private $fermetureAnnuelle;

    /**
     * @var string
     *
     * @ORM\Column(name="periodesOuverture", type="text", nullable=true)
     */
    private $periodesOuverture;


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
     * Set nom
     * @param string $nom
     * @return Musee
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set coordonnees
     *
     * @param string $coordonnees
     *
     * @return Musee
     */
    public function setCoordonnees($coordonnees)
    {
        $this->coordonnees = $coordonnees;

        return $this;
    }

    /**
     * Get coordonnees
     *
     * @return string
     */

    public function getCoordonnees()
    {
        return $this->coordonnees;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Musee
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set codePostal
     *
     * @param string $codePostal
     *
     * @return Musee
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return string
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Musee
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set siteWeb
     *
     * @param string $siteWeb
     *
     * @return Musee
     */
    public function setSiteWeb($siteWeb)
    {
        $this->siteWeb = $siteWeb;

        return $this;
    }

    /**
     * Get siteWeb
     *
     * @return string
     */
    public function getSiteWeb()
    {
        return $this->siteWeb;
    }

    /**
     * Set statut
     *
     * @param string $statut
     *
     * @return Musee
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set reouverture
     *
     * @param string $reouverture
     *
     * @return Musee
     */
    public function setReouverture($reouverture)
    {
        $this->reouverture = $reouverture;

        return $this;
    }

    /**
     * Get reouverture
     *
     * @return string
     */
    public function getReouverture()
    {
        return $this->reouverture;
    }

    /**
     * Set fermetureAnnuelle
     *
     * @param string $fermetureAnnuelle
     *
     * @return Musee
     */
    public function setFermetureAnnuelle($fermetureAnnuelle)
    {
        $this->fermetureAnnuelle = $fermetureAnnuelle;

        return $this;
    }

    /**
     * Get fermetureAnnuelle
     *
     * @return string
     */
    public function getFermetureAnnuelle()
    {
        return $this->fermetureAnnuelle;
    }

    /**
     * Set periodesOuverture
     *
     * @param string $periodesOuverture
     *
     * @return Musee
     */
    public function setPeriodesOuverture($periodesOuverture)
    {
        $this->periodesOuverture = $periodesOuverture;

        return $this;
    }

    /**
     * Get periodesOuverture
     *
     * @return string
     */
    public function getPeriodesOuverture()
    {
        return $this->periodesOuverture;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->commentaire = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add commentaire
     *
     * @param \AppBundle\Entity\Commentaire $commentaire
     *
     * @return Musee
     */
    public function addCommentaire(\AppBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaire[] = $commentaire;

        return $this;
    }

    /**
     * Remove commentaire
     *
     * @param \AppBundle\Entity\Commentaire $commentaire
     */
    public function removeCommentaire(\AppBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaire->removeElement($commentaire);
    }

    /**
     * Get commentaire
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    public function setMusee(\AppBundle\Entity\Musee $musee)
    {
        $this->musee = $musee;

        return $this;
    }

}
