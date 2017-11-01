<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ZombieController extends Controller
{
    public $aliments;

    
    public function manger() {
        return rand(0, 1);
    }

    public function getRandomAliment($aliments) {
        return array_rand($aliments, 1);
    }
    
    /**
     * @Route("/zombie")
     */
    public function zombieAction() {
        $members = 4;
        $step = 20;
        $aliments = [
            'ail' => -1, 
            'banane' => -1,
            'poivron' => -1,
            'pizza' => 1
        ];

        $journey = array();

        for ($i = 1; $i <= $step && $members > 0; $i++) {
            $estcequelezombiemange = $this->manger();

            if ($estcequelezombiemange == 1) {
                $randomAliment = $this->getRandomAliment($aliments);
                $value = $aliments[$randomAliment];
                $members = $members + $value;
                if ($members > 4) {
                    $members = 4;
                }
                if ($members < 1) {
                    $journey[] = ['mort', 0];
                } else {
                    $journey[] = [$randomAliment, $members];
                }
    
            } else {
                $journey[] = ['rien', $members];
            }
        }

        return $this->render('zombie.html.twig', array(
            'journey' => $journey,
        ));
    }
}