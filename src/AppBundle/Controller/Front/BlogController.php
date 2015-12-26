<?php

namespace AppBundle\Controller\Front;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Category;
use AppBundle\Entity\Post;

class BlogController extends Controller
{
    /**
     * @Route("/blog", name="blog")
     */
    public function postsListAction()
    {
        $posts = $this->getDoctrine()->getRepository('AppBundle:Post')->getAllEnabledSortedByPublishedDate();
        $categories = $this->getDoctrine()->getRepository('AppBundle:Category')->getAllEnabledSortedByTitle();

        return $this->render('Front/Blog/blog.html.twig', array(
            'posts' => $posts,
            'categories' => $categories,
        ));
    }

    /**
     * @Route("/blog/{year}/{month}/{day}/{slug}", name="blog_detail")
     * @param $year
     * @param $month
     * @param $day
     * @param $slug
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postDetailAction($year, $month, $day, $slug)
    {
        $post = $this->getDoctrine()->getRepository('AppBundle:Post')->findOneBySlug($slug);

        return $this->render('Front/Blog/blog_detail.html.twig', array('post' => $post));
    }

    /**
     * @Route("/blog/categoria/{slug}", name="category_detail")
     * @param $slug
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function categoryDetailAction($slug)
    {
        $category = $this->getDoctrine()->getRepository('AppBundle:Category')->findOneBySlug($slug);

        return $this->render('Front/Blog/category_detail.html.twig', array('category' => $category));
    }
}
