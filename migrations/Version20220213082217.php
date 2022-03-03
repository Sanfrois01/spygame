<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220213082217 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add hideaway table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hideaway (id INT AUTO_INCREMENT NOT NULL, location VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, hideaway_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE hideaway');
        $this->addSql('ALTER TABLE agent CHANGE fullname fullname VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nationality nationality VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE mission CHANGE title title VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE country country VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE mission_type mission_type VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE mission_status mission_status VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}