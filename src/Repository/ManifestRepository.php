<?php

namespace App\Repository;

use App\Entity\Manifest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Manifest|null find($id, $lockMode = null, $lockVersion = null)
 * @method Manifest|null findOneBy(array $criteria, array $orderBy = null)
 * @method Manifest[]    findAll()
 * @method Manifest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ManifestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Manifest::class);
    }

    public function findByGameVersionAndPlatformId($platformId, $gameVersion): ?Manifest
    {
        $manifest = null;
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT id FROM manifest as m WHERE m.platform_id = $platformId AND JSON_CONTAINS(m.game_version, '\"" . $gameVersion . "\"') LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchOne();

        if (empty($res))
        {
            return null;
        }

        return $this->find($res);
    }

    public function findByIdDesc(int $id, int $limit): array
    {
        $qb = $this->createQueryBuilder('m')
            ->where('m.id < :minId')
            ->setParameter('minId', $id)
            ->orderBy('m.id', 'DESC')
            ->setMaxResults($limit);

        $query = $qb->getQuery();

        return $query->execute();
    }
}
