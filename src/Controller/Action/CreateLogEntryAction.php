<?php

declare(strict_types=1);

namespace Setono\SyliusLogEntryPlugin\Controller\Action;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use InvalidArgumentException;
use RuntimeException;
use function Safe\sprintf;
use Setono\SyliusLogEntryPlugin\Model\LogEntriesAwareInterface;
use Setono\SyliusLogEntryPlugin\Model\LogEntryInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Webmozart\Assert\Assert;

final class CreateLogEntryAction
{
    /** @var Environment */
    private $twig;

    /** @var FormFactoryInterface */
    private $formFactory;

    /** @var ManagerRegistry */
    private $managerRegistry;

    /** @var EntityManagerInterface|null */
    private $manager;

    public function __construct(Environment $twig, FormFactoryInterface $formFactory, ManagerRegistry $managerRegistry)
    {
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->managerRegistry = $managerRegistry;
    }

    /**
     * @throws ORMException
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function __invoke(Request $request): Response
    {
        $config = $request->attributes->get('_setono_sylius_log_entry');
        self::assertConfigArray($config);

        $owningId = $request->get('id');
        if (!is_scalar($owningId)) {
            throw new InvalidArgumentException('No owning id present in the request. Your path in your route definition should look something like this: /admin/orders/{id}/log-entry');
        }

        $form = $this->formFactory->create($config['form']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $obj = $form->getData();

            if (!$obj instanceof LogEntryInterface) {
                throw new InvalidArgumentException(sprintf('The data class of the form is not an instance of %s', LogEntryInterface::class));
            }

            $manager = $this->getManager($obj);

            /** @var LogEntriesAwareInterface $owner */
            $owner = $manager->getReference($config['owner'], $owningId);
            $obj->setOwner($owner);

            $manager->persist($obj);
            $manager->flush();

            return new RedirectResponse($request->headers->get('referer'));
        }

        $template = $config['template'] ?? '@SetonoSyliusLogEntryPlugin/Admin/log_entry.html.twig';

        return new Response($this->twig->render($template, [
            'form' => $form->createView(),
        ]));
    }

    private function getManager(object $obj): EntityManagerInterface
    {
        if (null === $this->manager) {
            $em = $this->managerRegistry->getManagerForClass(get_class($obj));

            if (!$em instanceof EntityManagerInterface) {
                throw new RuntimeException('This plugin only works with doctrine/orm');
            }

            $this->manager = $em;
        }

        return $this->manager;
    }

    /**
     * @param mixed $config
     */
    private static function assertConfigArray($config): void
    {
        Assert::isArray($config, sprintf(
            'The controller %s needs a config to be able to resolve the correct classes to use',
            __CLASS__
        ));

        Assert::keyExists($config, 'form');
        Assert::keyExists($config, 'owner');
    }
}
