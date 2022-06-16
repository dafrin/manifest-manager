<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210805062651 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $platforms = [
            32 => 'TRAIL_WEB_GL'
        ];
        foreach ($platforms as $id => $name)
        {
            $this->addSql("DELETE FROM platform WHERE id=$id");
            $this->addSql("INSERT INTO platform (id, `name`) VALUES ($id, '$name')");
        }
    }

    public function down(Schema $schema): void
    {
    }
}
