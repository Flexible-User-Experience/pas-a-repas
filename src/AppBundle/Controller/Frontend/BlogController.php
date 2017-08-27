<?php

namespace AppBundle\Controller\Frontend;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Category;
use AppBundle\Entity\Post;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BlogController
 *
 * @category Controller
 * @package  AppBundle\Controller\Frontend
 * @author   David Romaní <david@flux.cat>
 */
class BlogController extends Controller
{
    const PAGE_LIMIT = 5;

    /**
     * @Route("/blog/{pagina}", name="blog")
     *
     * @param int pagina
     *
     * @return Response
     */
    public function postsListAction($pagina = 1)
    {
        $paginator = $this->get('knp_paginator');
        $posts = $this->getDoctrine()->getRepository('AppBundle:Post')->getAllEnabledSortedByPublishedDateWithJoinUntilNow();
        $postsPaginator = $paginator->paginate($posts, $pagina, self::PAGE_LIMIT);
        $categories = $this->getDoctrine()->getRepository('AppBundle:Category')->getAllEnabledSortedByTitleWithJoin();

        return $this->render('Front/Blog/blog.html.twig', array(
            'posts' => $postsPaginator,
            'categories' => $categories,
        ));
    }

    /**
     * @Route("/blog/{year}/{month}/{day}/{slug}", name="blog_detail")
     * @param         $year
     * @param         $month
     * @param         $day
     * @param         $slug
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postDetailAction($year, $month, $day, $slug)
    {
        /** @var Post $post */
        $post = $this->getDoctrine()->getRepository('AppBundle:Post')->findOneBySlug($slug);
        $categories = $this->getDoctrine()->getRepository('AppBundle:Category')->getAllEnabledSortedByTitleWithJoin();
        if (!$post) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }
        if (!$post->getEnabled() && !$this->get('security.authorization_checker')->isGranted('ROLE_CMS')) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }
        if ($post->getPublishedAt()->format('Y-m-d') != $year . '-' . $month . '-' . $day) {
            throw $this->createNotFoundException('Wrong Post entity published date');
        }

        return $this->render('Front/Blog/blog_detail.html.twig', array(
            'post' => $post,
            'categories' => $categories,
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
        $posts = $this->getDoctrine()->getRepository('AppBundle:Post')->getPostsByCategoryEnabledSortedByPublishedDateWithJoinUntilNow($category);
        $categories = $this->getDoctrine()->getRepository('AppBundle:Category')->getAllEnabledSortedByTitleWithJoin();

        return $this->render('Front/Blog/category_detail.html.twig', array(
            'selectedCategory' => $category,
            'posts' => $posts,
            'categories' => $categories,
        ));
    }
}
