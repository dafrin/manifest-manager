<?php

namespace App\Controller;

use App\Entity\Bundle;
use App\Entity\Manifest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{
    public function getNewVersion(Request $request): JsonResponse
    {
        $requestData = $request->toArray();
        if (empty($requestData) || !isset($requestData['bundles']))
        {
            return new JsonResponse(['error' => 'Empty request']);
        }

        $bundles = [];
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Bundle::class);
        foreach ($requestData['bundles'] as $bundleId)
        {
            $bundle = $repo->find($bundleId);
            if ($bundle instanceof Bundle)
            {
                $bundle->setVersion(++$bundle->version);
                $bundles[] = $bundle;
            }
        }

        $this->getDoctrine()->getManager()->flush();


        return new JsonResponse(['bundles' => $bundles]);
    }

    public function getManifest(Request $request): JsonResponse
    {
        $platformId = $request->get('platform_id');
        $gameVersion = $request->get('game_version');
        if (empty($platformId) || empty($gameVersion))
        {
            return new JsonResponse(['error' => 'Empty request']);
        }

        $rep = $this->getDoctrine()->getManager()->getRepository(Manifest::class);
        $manifest = $rep->findByGameVersionAndPlatformId($platformId, $gameVersion);
        return new JsonResponse(['manifest' => $manifest]);
    }

    public function addVersionToManifest(Request $request, int $manifestId): JsonResponse
    {
        $gameVersion = $request->get('game_version');
        if (empty($gameVersion))
        {
            return new JsonResponse(['error' => 'Empty game_version']);
        }

        $rep = $this->getDoctrine()->getManager()->getRepository(Manifest::class);
        $manifest = $rep->find($manifestId);
        if (!($manifest instanceof Manifest))
        {
            return new JsonResponse(['error' => 'Manifest to found by id:' . $manifestId]);
        }

        $manifest->addGameVersion($gameVersion);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse();
    }
}
