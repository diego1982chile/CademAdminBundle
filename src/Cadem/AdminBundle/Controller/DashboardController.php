<?php

namespace Cadem\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        return $this->render('CademAdminBundle:Dashboard:index.html.twig');
    }
}
