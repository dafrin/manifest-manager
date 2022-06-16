<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210218115531 extends AbstractMigration
{

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE manifest (id INT AUTO_INCREMENT NOT NULL, platform_id INT NOT NULL, game_version LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE manifest_bundle (manifest_id INT NOT NULL, bundle_id INT NOT NULL) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE manifest_bundle ADD PRIMARY KEY (manifest_id, bundle_id)');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE manifest');
        $this->addSql('DROP TABLE manifest_bundle');
    }
}
