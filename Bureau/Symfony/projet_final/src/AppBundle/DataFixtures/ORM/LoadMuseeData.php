<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Musee;

class LoadMuseeData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $url="http://opendata.paris.fr/explore/dataset/liste-musees-de-france-a-paris/download/?format=json&timezone=Europe/Berlin";
        $contents = file_get_contents($url);
        $contents = utf8_encode($contents);
        $json = json_decode($contents, true);
        foreach ($json as $object)
        {
            $fields = $object['fields'];
            if (isset($fields['coordonnees_'])) {

                $musee = new Musee();

                $musee->setNom($fields['nom_du_musee']);
                $musee->setCoordonnees(implode(" ", $fields['coordonnees_']));

                //
                if (isset($fields['adr'])) {
                    $musee->setAdresse($fields['adr']);
                } else {
                    $musee->setAdresse(null);
                }
                //
                if (isset($fields['cp'])) {
                    $musee->setCodePostal($fields['cp']);
                } else {
                    $musee->setCodePostal(null);
                }
                //
                if (isset($fields['ville'])) {
                    $musee->setVille($fields['ville']);
                } else {
                    $musee->setVille(null);
                }
                //
                if (isset($fields['sitweb'])) {
                    $musee->setSiteWeb($fields['sitweb']);
                } else {
                    $musee->setSiteWeb(null);
                }
                //
                if (isset($fields['ferme'])) {
                    $musee->setStatut($fields['ferme']);
                } else {
                    $musee->setStatut(null);
                }
                //
                $musee->setReouverture(null);

                //
                if (isset($fields['fermeture_annuelle'])) {
                    $musee->setFermetureAnnuelle($fields['fermeture_annuelle']);
                } else {
                    $musee->setFermetureAnnuelle(null);
                }
                //
                if (isset($fields['periode_ouverture'])) {
                    $musee->setPeriodesOuverture($fields['periode_ouverture']);
                } else {
                    $musee->setPeriodesOuverture(null);
                }
                $manager->persist($musee);
            }
        }
        $manager->flush();
    }
}

?>