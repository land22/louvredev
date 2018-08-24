<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace tests\LouvreBundle\Services;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use LW\LouvreBundle\Entity\Orders;
use LW\LouvreBundle\Services\TarifDate;

/**
 * Description of TarifDateTest
 *
 * @author wlandry
 */
class TarifDateTest extends WebTestCase {

    //put your code here
    public function testCalculTarif() {
        $booking = new Orders();
        $tarif = new TarifDate();
        $this->assertEquals(0, $tarif->calculTarif($booking));
        
        $booking->setTypeOrder('demi-journée');
        foreach ($booking->getTickets() as $values ){
            $values->setReduction(True);
        }
        $this->assertEquals(0, $tarif->calculTarif($booking));
    }

}
