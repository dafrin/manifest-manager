<?php

namespace App\Controller;

use App\Entity\Bundle;
use App\Form\BundleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BundleController extends AbstractController
{
    private string $indexRoute;
    private string $createRoute;
    private string $editRoute;
    private string $deleteRoute;
    /**
     * @var string[]
     */
    private array $fields;

    public function __construct()
    {
        $this->indexRoute = 'bundle-index';
        $this->createRoute = 'bundle-create';
        $this->editRoute = 'bundle-edit';
        $this->deleteRoute = '';
        $this->fields = [
            'id' => 'ID',
            'name' => 'Название',
            'techName' => 'Тех.название',
            'version' => 'Версия',
            'platform' => 'Платформа',
        ];
    }

    public function index(Request $request): Response
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(Bundle::class);
        return $this->render('bundle/list.html.twig', [
            'models' => $repository->findAll(),
            'createRoute' => $this->createRoute,
            'editRoute' => $this->editRoute,
            'deleteRoute' => $this->deleteRoute,
            'fields' => $this->fields,
        ]);
    }

    public function create(Request $request): Response
    {
        $user = new Bundle();
        $form = $this->createForm(BundleType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute($this->indexRoute);
        }

        return $this->render('default/form_card.html.twig', [
            'cardHeader' => 'Добавление: Бандл',
            'form' => $form->createView(),
        ]);
    }

    public function edit(Request $request): Response
    {
        $id = $request->query->get('id');
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Bundle::class);
        $model = $repo->find($id);

        $form = $this->createForm(BundleType::class, $model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute($this->indexRoute);
        }

        return $this->render('default/form_card.html.twig', [
            'cardHeader' => 'Редактирование: Бандл',
            'form' => $form->createView(),
        ]);
    }
}
