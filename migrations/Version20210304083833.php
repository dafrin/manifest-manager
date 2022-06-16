<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210304083833 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE platform (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $platforms = [
            3 => 'IPHONE',
            4 => 'ANDROID',
            9 => 'AMAZON',
            20 => 'WIN8_STORE',
            27 => 'ANDROID_SAMSUNG',
            30 => 'ANDROID_BETA',
            31 => 'STEAM'
        ];
        foreach ($platforms as $id => $name)
        {
            $this->addSql("INSERT INTO platform (id, `name`) VALUES ($id, '$name')");
        }
        $this->addSql('ALTER TABLE manifest_bundle MODIFY bundle_id VARCHAR(255)');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE platform');
    }
}
