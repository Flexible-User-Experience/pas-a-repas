<?php

namespace AppBundle\Listener;

use AppBundle\Entity\Category;
use AppBundle\Entity\Post;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Presta\SitemapBundle\Service\SitemapListenerInterface;
use Presta\SitemapBundle\Event\SitemapPopulateEvent;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class SitemapListener
 *
 * @category Listener
 * @package  AppBundle\Listener
 * @author   Anton Serra <aserratorta@gmail.com>
 */
class SitemapListener implements SitemapListenerInterface
{
    /** @var RouterInterface */
    private $router;

    /** @var EntityManager */
    private $em;

    /** @var ArrayCollection */
    private $categories;

    /** @var ArrayCollection */
    private $posts;

    /**
     * SitemapListener constructor
     *
     * @param RouterInterface $router
     * @param EntityManager   $em
     */
    public function __construct(RouterInterface $router, EntityManager $em)
    {
        $this->router = $router;
        $this->em = $em;
        $this->categories = $this->em->getRepository('AppBundle:Category')->getAllEnabledSortedByTitle();
        $this->posts = $this->em->getRepository('AppBundle:Post')->getAllEnabledSortedByPublishedDateWithJoin(
        );
    }

    /**
     * @param SitemapPopulateEvent $event
     */
    public function populateSitemap(SitemapPopulateEvent $event)
    {
        $section = $event->getSection();
        if (is_null($section) || $section == 'default') {
            // Homepage
            $event
                ->getUrlContainer()
                ->addUrl(
                    new UrlConcrete(
                        $this->router->generate('homepage', array(), UrlGeneratorInterface::ABSOLUTE_URL),
                        new \DateTime(),
                        UrlConcrete::CHANGEFREQ_HOURLY,
                        1
                    ),
                    'default'
                );
            // Blog categories list
            /** @var Category $category */
            foreach ($this->categories as $category) {
                $url = $this->router->generate(
                    'category_detail',
                    array(
                        'slug' => $category->getSlug(),
                    ),
                    UrlGeneratorInterface::ABSOLUTE_URL
                );
                $event
                    ->getUrlContainer()
                    ->addUrl(
                        new UrlConcrete(
                            $url,
                            new \DateTime(),
                            UrlConcrete::CHANGEFREQ_HOURLY,
                            1
                        ),
                        'default'
                    );
            }
            // Blog main view
            $url = $this->router->generate(
                'blog', array(), UrlGeneratorInterface::ABSOLUTE_URL
            );
            $event
                ->getUrlContainer()
                ->addUrl(
                    new UrlConcrete(
                        $url,
                        new \DateTime(),
                        UrlConcrete::CHANGEFREQ_HOURLY,
                        1
                    ),
                    'default'
                );
            // Posts detail view list
            /** @var Post $post */
            foreach ($this->posts as $post) {
                $url = $this->router->generate(
                    'blog_detail',
                    array(
                        'year' => $post->getPublishedAt()->format('Y'),
                        'month' => $post->getPublishedAt()->format('m'),
                        'day' => $post->getPublishedAt()->format('d'),
                        'slug' => $post->getSlug(),
                    ),
                    UrlGeneratorInterface::ABSOLUTE_URL
                );
                $event
                    ->getUrlContainer()
                    ->addUrl(
                        new UrlConcrete(
                            $url,
                            new \DateTime(),
                            UrlConcrete::CHANGEFREQ_HOURLY,
                            1
                        ),
                        'default'
                    );
            }
            // Credits view
            $url = $this->router->generate(
                'credits', array(), UrlGeneratorInterface::ABSOLUTE_URL
            );
            $event
                ->getUrlContainer()
                ->addUrl(
                    new UrlConcrete(
                        $url,
                        new \DateTime(),
                        UrlConcrete::CHANGEFREQ_HOURLY,
                        1
                    ),
                    'default'
                );
        }
    }
}
