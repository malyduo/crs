<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Helper;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
       //$this->_helper->layout->setLayout('layout_1');
       $this->layout()->setTemplate('layout/front-page');
       return new ViewModel();
    }
    
    public function samochodyAction()
    {
        $samochody = 'samochody';
        return new ViewModel([
            'samochody' => $samochody,
        ]);
    }
    
    public function kontaktAction()
    {
       return new ViewModel();
    }
    
    public function regulaminAction()
    {
       return new ViewModel();
    }
}
