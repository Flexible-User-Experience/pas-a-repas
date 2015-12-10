<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use AppBundle\Form\Type\ContactType;
use Ivory\GoogleMapBundle\Entity\Map;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Ivory\GoogleMap\Overlays\Animation;
use Ivory\GoogleMap\Overlays\Marker;
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

        return $this->render('Blog/blog.html.twig', array(
            'posts' => $posts,
            'categories' => $categories,
        ));
    }

    /**
     * @Route("/blog/{year}/{month}/{day}/{slug}", name="blog_detail")
     */
    public function postDetailAction($year, $month, $day, $slug)
    {
        $post = $this->getDoctrine()->getRepository('AppBundle:Post')->findOneBySlug($slug);

        return $this->render('Blog/blog_detail.html.twig', array('post' => $post));
    }

    /**
     * @Route("/blog/categories", name="categories")
     */
    public function categoriesListAction()
    {
        $categories = $this->getDoctrine()->getRepository('AppBundle:Category')->getAllEnabledSortedByTitle();

        return $this->render('Blog/categories.html.twig', array('categories' => $categories));
    }

    /**
     * @Route("/blog/category/{slug}", name="category_detail")
     */
    public function categoryDetailAction($slug)
    {
        $category = $this->getDoctrine()->getRepository('AppBundle:Category')->findOneBySlug($slug);

        return $this->render('Blog/category_detail.html.twig', array('category' => $category));
    }

}