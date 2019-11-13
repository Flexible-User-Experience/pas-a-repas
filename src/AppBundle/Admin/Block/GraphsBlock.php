<?php

namespace AppBundle\Admin\Block;

use Doctrine\ORM\EntityManager;
use Sonata\BlockBundle\Block\Service\AbstractBlockService;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GraphsBlock.
 *
 * @category Block
 */
class GraphsBlock extends AbstractBlockService
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * Methods.
     */

    /**
     * Constructor.
     *
     * @param string          $name
     * @param EngineInterface $templating
     * @param EntityManager   $em
     */
    public function __construct($name, EngineInterface $templating, EntityManager $em)
    {
        parent::__construct($name, $templating);
        $this->em = $em;
    }

    /**
     * Execute.
     *
     * @param BlockContextInterface $blockContext
     * @param Response              $response
     *
     * @return Response
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        return $this->renderResponse(
            $blockContext->getTemplate(),
            array(
                'block' => $blockContext->getBlock(),
                'settings' => $blockContext->getSettings(),
                'title' => 'backend.admin.block.title',
                'graphs' => $this->em->getRepository('AppBundle:Old\Receipt')->getReceiptCollectedAmount(),
                'graphs2' => $this->em->getRepository('AppBundle:Old\Receipt')->getReceiptNotCollectedAmount(),
            ),
            $response
        );
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return 'graphs';
    }

    /**
     * Set defaultSettings.
     *
     * @param OptionsResolver $resolver
     */
    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'title' => 'Resume',
                'content' => 'Default content',
                'template' => '::Admin/Blocks/block_graphs.html.twig',
            )
        );
    }
}
