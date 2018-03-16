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
use Zend\Http\Request;

class RezerwacjaController extends AbstractActionController {

    public function indexAction() {
        var_dump($this->params()->fromQuery());
        return new ViewModel();
    }

    public function rezerwujAction() {
        //wczytanie modeli
        //widok
        $view = new ViewModel();
        //flota
        $modelFlota = new Flota();
        //rezerwacja
        $modelRezerwacja = new Rezerwacja();
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
        } else {
            die();
        }
        
        //sprawdza czy formularz rezerwacji jest wyslany
        if ($request->isPost()) {
            $klient = $this->params()->fromPost();
            $view->setVariable('klient', $klient);
        } else {
            return $view;
        }
        
//        if($krok == 'potwierdzenie'){
//            $data = $klient;
//            $data['id_flota'] = $samochodInfo['id'];
//            $data['id_lokalizacja'] = 1;
//            var_dump($data);
//            $modelRezerwacja->dodajAction($data);
//        }
        
        //zwraca na widok
        return $view;
    }

}
