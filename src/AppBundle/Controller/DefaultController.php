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


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        /** @var Marker $marker */
        $marker = new Marker();
        $marker->setPrefixJavascriptVariable('marker_');
        $marker->setPosition(40.7061278, 0.5817055555555556, true);
        $marker->setAnimation(Animation::DROP);

        /** @var Map $mapObject */
        $mapObject = $this->get('ivory_google_map.map');
        $mapObject->setStylesheetOption('width', '100%');
        $mapObject->setStylesheetOption('height', '100%');
        $mapObject->setLanguage('es');
        $mapObject->setCenter(40.7061278, 0.5817055555555556, true);
        $mapObject->setMapOption('zoom', 15);
        //$mapObject->setBound(-2.1, -3.9, 2.6, 1.4, true, true);
        $mapObject->addMarker($marker);

        /** @var ContactType $contactType */
        $contactType = new ContactType();
        /** @var Contact $contactEntity */
        $contactEntity = new Contact();

        $form = $this->createForm($contactType, $contactEntity);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // ... perform some action, such as saving the task to the database
            $message = \Swift_Message::newInstance()
                ->setSubject('Pas a repàs contact form')
                ->setFrom($contactEntity->getEmail())
                ->setTo($this->container->getParameter('mailer_destination'))
                ->setBody($this->render('default/email.html.twig', array(
                    'contactEntity' => $contactEntity,
                )))
                ->setCharset('UTF-8')
                ->setContentType('text/html');
            $this->get('mailer')->send($message);

            $em = $this->getDoctrine()->getManager();
            //automatitzem la data actual a la entitat
            $contactEntity->setDate(new \DateTime());
            $em->persist($contactEntity);
            $em->flush();

            //Add flash message
            $this->addFlash('notice', 'ENVIAT!');
        }

        return $this->render('default/index.html.twig', array(
            'mapView' => $mapObject,
            'contactForm' => $form->createView(),
        ));
    }

    /**
     * @Route("/blog", name="blog")
     */
    public function postsListAction()
    {
        $posts = $this->getDoctrine()->getRepository('AppBundle:Post')->getAllEnabledSortedByPublishedDate();
        $categories = $this->getDoctrine()->getRepository('AppBundle:Category')->getAllEnabledSortedByTitle();

        return $this->render('default/blog.html.twig', array(
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

        return $this->render('default/blog_detail.html.twig', array('post' => $post));
    }

    /**
     * @Route("/blog/categories", name="categories")
     */
    public function categoriesListAction()
    {
        $categories = $this->getDoctrine()->getRepository('AppBundle:Category')->getAllEnabledSortedByTitle();

        return $this->render('default/categories.html.twig', array('categories' => $categories));
    }

    /**
     * @Route("/blog/category/{slug}", name="category_detail")
     */
    public function categoryDetailAction($slug)
    {
        $category = $this->getDoctrine()->getRepository('AppBundle:Category')->findOneBySlug($slug);

        return $this->render('default/category_detail.html.twig', array('category' => $category));
    }
}