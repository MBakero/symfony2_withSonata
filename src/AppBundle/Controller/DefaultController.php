<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/symfony", name="symfony_page")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }

    /**
     * @Route("/", name="home_page")
     */
    public function homeAction(Request $request)
    {
        $posts = $this->getDoctrine()
            ->getRepository('ApplicationSonataNewsBundle:Post')
            ->findAll();
        if(!$posts) {
            throw $this->createNotFoundException('no post found');
        }

        return $this->render('home/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'), 'posts' => $posts,
        ));
    }

    /**
     * @Route("/test", name="test_page")
     */
    public function testAction(Request $request)
    {
        /*$repository = $this->getDoctrine()
            ->getRepository('ApplicationSonataNewsBundle:Post');

        $objects = $repository->findBy(array('enabled' => '1'), array('createdAt' => 'DESC'), 4);

        if(!$objects) {
            throw $this->createNotFoundException('no post found');
        }*/

/*
        $query = $repository->createQueryBuilder('p')
            ->orderBy('p.id', 'ASC')
            ->getQuery();

        $objects = $query->getResult();
        $objects = $query->setMaxResults(1)->getOneOrNullResult();
*/

        //$objects = $repository->findAll();



        return $this->render('default/test_post.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
/*
        return $this->render('AppBundle:default:test.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));*/
    }

    public function categoryAction(Request $request)
    {
        $objects = $this->getDoctrine()
            ->getRepository('ApplicationSonataClassificationBundle:Category')
            ->findAll();
        if(!$objects) {
            throw $this->createNotFoundException('no category found');
        }

        return $this->render('AppBundle:Classification:menu/category.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'), 'objects' => $objects,
        ));
    }

    public function tagAction(Request $request)
    {
        $objects = $this->getDoctrine()
            ->getRepository('ApplicationSonataClassificationBundle:Tag')
            ->findAll();
        if(!$objects) {
            throw $this->createNotFoundException('no tag found');
        }

        return $this->render('AppBundle:Classification:menu/tag.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'), 'objects' => $objects,
        ));
    }

    public function latest_postsAction(Request $request)
    {
        $repository = $this->getDoctrine()
            ->getRepository('ApplicationSonataNewsBundle:Post');

        $objects = $repository->findBy(array('enabled' => '1'), array('createdAt' => 'DESC'), 4);

        if(!$objects) {
            throw $this->createNotFoundException('no post found');
        }

        return $this->render('AppBundle:Post:menu/latest_posts.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'), 'objects' => $objects,
        ));
    }
}
