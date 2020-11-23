<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201122231146 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user__users (uuid VARCHAR(128) NOT NULL, username VARCHAR(60) NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT "(DC2Type:array)", created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_FBE95248F85E0677 (username), UNIQUE INDEX UNIQ_FBE95248E7927C74 (email), PRIMARY KEY(uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE "utf8mb4_unicode_ci" ENGINE = InnoDB;');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user__users');
    }
}
