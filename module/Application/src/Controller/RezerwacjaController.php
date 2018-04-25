<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Flota;
use Application\Model\Rezerwacja;
use Application\Model\Lokalizacja;
use Zend\Http\Request;

class RezerwacjaController extends AbstractActionController {

    public function indexAction() {
        var_dump($this->params()->fromQuery());
        return new ViewModel();
    }

    public function rezerwujAction() {
        //start sesji
        session_start();
        
        //wczytanie modeli
        $view = new ViewModel();
        $modelFlota = new Flota();
        $modelRezerwacja = new Rezerwacja();
        $modelLokalizacja = new Lokalizacja();
        
        //request
        $request = new Request();
        $request = $this->getRequest();

        
        
        $params = $this->params()->fromQuery();
        $id = $params['id'];
        $krok = $params['krok'];
        $view->setVariable('krok', $krok);

        //pobranie wszystkich wartosci z bazy flota
        $samochodInfo = $modelFlota->sprawdzSamochod($id);

        //definiuje zmienne widoku
        if ($samochodInfo) {
            $view->setVariable('samochodInfo', $samochodInfo);
            //lista lokalizacji
            $lokalizacja = $modelLokalizacja->fetchAll();
            $view->setVariable('lokalizacja', $lokalizacja);
        } else {
            die();
        }
        
        //sprawdza czy formularz rezerwacji jest wyslany
        if ($request->isPost() && $krok == 'podsumowanie') {
            $klient = $this->params()->fromPost();
            $view->setVariable('klient', $klient);
            $_SESSION['klient'] = $klient;
        } elseif(!empty($_SESSION['klient'])){
            $view->setVariable('klient', $_SESSION['klient']);
        }
        
        //sprawdza czy potwierdzenie jest wyslane
        if ($krok == 'potwierdzenie' && !empty($_SESSION['klient'])) {
            
            //przygotowanie danych do dodania
            $data = array(
                'id_flota' => $id,
                'id_lokalizacja' => 1,
                'imie' => $_SESSION['klient']['imie'],
                'nazwisko' => $_SESSION['klient']['nazwisko'],
                'telefon' => $_SESSION['klient']['telefon'],
                'email' => $_SESSION['klient']['email'],
                'ulica' => $_SESSION['klient']['ulica'],
                'miejscowosc' => $_SESSION['klient']['miejscowosc'],
                'kod_pocztowy' => $_SESSION['klient']['kod_pocztowy'],
                'data_wypozyczenia' => $_SESSION['klient']['data_wypozyczenia'],
                'data_zwrotu' => $_SESSION['klient']['data_zwrotu']
            );
//            var_dump($data);
            $modelRezerwacja->rezerwujAction($data);
            unset($_SESSION['klient']);
//            echo 'SUKCES';
        }
        
        //definiuje tytuł strony
        $this->layout()->setVariable('title', 'Rezerwacja samochodu');
        
        //zwraca na widok
        return $view;
    }

}
