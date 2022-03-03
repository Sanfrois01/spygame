<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220213091539 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'make relations';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agent ADD mission_id INT NOT NULL');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9DBE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id)');
        $this->addSql('CREATE INDEX IDX_268B9C9DBE6CAE90 ON agent (mission_id)');
        $this->addSql('ALTER TABLE hideaway ADD mission_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE hideaway ADD CONSTRAINT FK_3DAEA5EDBE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id)');
        $this->addSql('CREATE INDEX IDX_3DAEA5EDBE6CAE90 ON hideaway (mission_id)');
        $this->addSql('ALTER TABLE mission ADD contact_id INT NOT NULL');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23CE7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9067F23CE7A1254A ON mission (contact_id)');
        $this->addSql('ALTER TABLE target ADD mission_id INT NOT NULL');
        $this->addSql('ALTER TABLE target ADD CONSTRAINT FK_466F2FFCBE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id)');
        $this->addSql('CREATE INDEX IDX_466F2FFCBE6CAE90 ON target (mission_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agent DROP FOREIGN KEY FK_268B9C9DBE6CAE90');
        $this->addSql('DROP INDEX IDX_268B9C9DBE6CAE90 ON agent');
        $this->addSql('ALTER TABLE agent DROP mission_id, CHANGE fullname fullname VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nationality nationality VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE contact CHANGE fullname fullname VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nationality nationality VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE hideaway DROP FOREIGN KEY FK_3DAEA5EDBE6CAE90');
        $this->addSql('DROP INDEX IDX_3DAEA5EDBE6CAE90 ON hideaway');
        $this->addSql('ALTER TABLE hideaway DROP mission_id, CHANGE location location VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE country country VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE hideaway_type hideaway_type VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23CE7A1254A');
        $this->addSql('DROP INDEX UNIQ_9067F23CE7A1254A ON mission');
        $this->addSql('ALTER TABLE mission DROP contact_id, CHANGE title title VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE country country VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE mission_type mission_type VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE mission_status mission_status VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE specialities CHANGE type type VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE target DROP FOREIGN KEY FK_466F2FFCBE6CAE90');
        $this->addSql('DROP INDEX IDX_466F2FFCBE6CAE90 ON target');
        $this->addSql('ALTER TABLE target DROP mission_id, CHANGE fullname fullname VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nationality nationality VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE fullname fullname VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
