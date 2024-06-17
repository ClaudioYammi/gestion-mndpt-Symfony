<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240523101733 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chauffeur ADD COLUMN permis VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__chauffeur AS SELECT id, matriculechauffeur, nom, prenom, telephone, adresse FROM chauffeur');
        $this->addSql('DROP TABLE chauffeur');
        $this->addSql('CREATE TABLE chauffeur (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, matriculechauffeur VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO chauffeur (id, matriculechauffeur, nom, prenom, telephone, adresse) SELECT id, matriculechauffeur, nom, prenom, telephone, adresse FROM __temp__chauffeur');
        $this->addSql('DROP TABLE __temp__chauffeur');
    }
}
