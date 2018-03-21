<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Db\Adapter\Adapter;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Flota;
use Zend\Form\Element;
use Zend\Form\Fieldset;
use Zend\Form\Form;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;

class FlotaController extends AbstractActionController
{
    public function indexAction()
    {
        //model widoku
        $view = new ViewModel();
        
        //pobranie wszystkich wartosci z bazy flota
        $modelFlota = new Flota();
        $results = $modelFlota->fetchAll();
        
        //definiuje zmienne widoku
        $view->setVariable('results', $results);
        
        //definiuje tytuł strony
        $this->layout()->setVariable('title', 'Flota');
        
        //zwraca na widok
        return $view;
        
        
    }
    
    public function dodajAction()
    {
        //model widoku
        $view = new ViewModel();
        
        $name = new Element('name');
        $name->setLabel('Your name');
        $name->setAttributes([
            'type' => 'text',
        ]);
        
        $email = new Element\Email('email');
        $email->setLabel('Your email address');
        
        $subject = new Element('subject');
        $subject->setLabel('Subject');
        $subject->setAttributes([
            'type' => 'text',
        ]);
        
        $message = new Element\Textarea('message');
        $message->setLabel('Message');

        $send = new Element('send');
        $send->setValue('Submit');
        $send->setAttributes([
            'type' => 'submit',
        ]);

        $form = new Form('contact');
        $form->add($name);
        $form->add($email);
        $form->add($subject);
        $form->add($message);
        $form->add($send);
        
        //definiuje zmienne widoku
        $view->setVariable('form', $form);
        
        //zwraca na widok
        return $view;
    }
}