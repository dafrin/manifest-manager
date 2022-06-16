<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211005063718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $rows = $this->connection->fetchAllAssociative("select * from bundle where name not like '%_win'");
        $this->alterBundles();

        $this->connection->executeStatement("UPDATE bundle SET name=concat(name,'_android') where name not like '%_win' and id not in (78,80)");

        $this->createBundles($rows, 3, '_ios');
        $this->createBundles($rows, 32, '_trail');
        $this->createBundles($rows, 31, '_steam');
    }

    private function createBundles($rows, $pid, $suffix)
    {
        $this->connection->executeStatement("INSERT INTO manifest (platform_id, game_version) values ($pid, '[]')");
        $manifestID = $this->connection->lastInsertId();
        foreach ($rows as $data)
        {
            if ($data['id'] == 78 || $data['id'] == 80)
            {
                continue;
            }

            $this->connection->executeStatement("INSERT INTO bundle (tech_name,`name`, critical_data, is_local, is_low_definition, version, platform_id) 
VALUES (?,?,?,?,?,?,?)", [
                $data['tech_name'],
                $data['name'] . $suffix,
                $data['critical_data'],
                $data['is_local'],
                $data['is_low_definition'],
                $data['version'],
                $pid
            ]);

            $bid = $this->connection->lastInsertId();

            $this->connection->executeStatement("INSERT INTO manifest_bundle (manifest_id, bundle_id) values (?,?)", [$manifestID, $bid]);
        }
    }

    private function alterBundles()
    {
        $this->connection->executeStatement("ALTER TABLE bundle add platform_id smallint not null default 0");
        $this->connection->executeStatement("UPDATE bundle SET platform_id=20 where name like '%_win'");
        $this->connection->executeStatement("UPDATE bundle SET platform_id=4 where name not like '%_win'");
        $this->connection->executeStatement("UPDATE bundle SET platform_id=32 where id in (78,80);");
    }

    public function down(Schema $schema): void
    {
    }
}
