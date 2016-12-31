<?php
/**
 * Created by PhpStorm.
 * User: Ab2
 * Date: 7/21/2016
 * Time: 7:19 PM
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{

    /**
     * @Route("/category", name="category")
     */
    public function indexAction()
    {
        return $this->render(':category:category.html.twig');
    }

}