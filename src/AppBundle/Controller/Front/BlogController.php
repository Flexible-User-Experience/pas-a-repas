<?php

namespace AppBundle\Controller\Front;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Category;
use AppBundle\Entity\Post;

/**
 * Class BlogController
 *
 * @category Controller
 * @package  AppBundle\Controller\Front
 * @author   David Romaní <david@flux.cat>
 */
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
        /** @var Post $post */
        $post = $this->getDoctrine()->getRepository('AppBundle:Post')->findOneBySlug($slug);
        if (!$post || !$post->getEnabled()) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }
        if ($post->getPublishedDate()->format('Y-m-d') != $year . '-' . $month . '-' . $day) {
            throw $this->createNotFoundException('Wrong Post entity published date');
        }

        return $this->render('Front/Blog/blog_detail.html.twig', array(
            'post' => $post,
        ));
    }

    /**
     * @Route("/blog/categoria/{slug}", name="category_detail")
     * @param $slug
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function categoryDetailAction($slug)
    {
        /** @var Category $category */
        $category = $this->getDoctrine()->getRepository('AppBundle:Category')->findOneBySlug($slug);
        if (!$category || !$category->getEnabled()) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }
        $posts = $this->getDoctrine()->getRepository('AppBundle:Post')->getPostsByCategoryEnabledSortedByPublishedDate($category);
        $categories = $this->getDoctrine()->getRepository('AppBundle:Category')->getAllEnabledSortedByTitle();

        return $this->render('Front/Blog/category_detail.html.twig', array(
            'selectedCategory' => $category,
            'posts' => $posts,
            'categories' => $categories,
        ));
    }
}
