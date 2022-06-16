<?php

namespace App\Controller;

use App\Entity\Manifest;
use App\Form\ManifestType;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ManifestController extends AbstractController
{
    private string $indexRoute;
    private string $createRoute;
    private string $editRoute;
    private string $deleteRoute;

    private const LIMIT_INDEX = 15;
    private const LIMIT_LOAD_MORE = 10;

    public function __construct()
    {
        $this->indexRoute = 'manifest-index';
        $this->createRoute = 'manifest-create';
        $this->editRoute = 'manifest-edit';
        $this->deleteRoute = '';
    }

    private function getRepository(): ObjectRepository
    {
        return $this->getDoctrine()->getManager()->getRepository(Manifest::class);
    }

    public function index(Request $request): Response
    {
        return $this->render('manifest/list.html.twig', [
            'models' => $this->getRepository()->findBy([], ['id' => 'DESC'], self::LIMIT_INDEX),
            'createRoute' => $this->createRoute,
            'editRoute' => $this->editRoute,
            'deleteRoute' => $this->deleteRoute,
        ]);
    }


    public function create(Request $request): Response
    {
        $user = new Manifest();
        $form = $this->createForm(ManifestType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute($this->indexRoute);
        }

        return $this->render('default/form_card.html.twig', [
            'cardHeader' => 'Добавление: Манифест',
            'form' => $form->createView(),
        ]);
    }

    public function edit(Request $request): Response
    {
        $id = $request->query->get('id');
        $model = $this->getRepository()->find($id);

        $form = $this->createForm(ManifestType::class, $model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute($this->indexRoute);
        }

        return $this->render('default/form_card.html.twig', [
            'cardHeader' => 'Редактирование: Манифест',
            'form' => $form->createView(),
        ]);
    }

    public function copy(Request $request): Response
    {
        $id = $request->query->get('id');
        $model = $this->getRepository()->find($id);
        $modelId = $model->id;

        if ($model instanceof Manifest && !empty($modelId))
        {
            $newModel = clone $model;
            $em = $this->getDoctrine()->getManager();
            $em->persist($newModel);
            $em->flush();
        }

        return $this->redirectToRoute($this->indexRoute);
    }

    public function loadMore(Request $request): Response
    {
        $id = (int)$request->get('id');

        return $this->render('manifest/rows.html.twig', [
            'rows' => $this->getRepository()->findByIdDesc($id, self::LIMIT_LOAD_MORE),
            'editRoute' => $this->editRoute,
            'deleteRoute' => $this->deleteRoute,
        ]);
    }
}
