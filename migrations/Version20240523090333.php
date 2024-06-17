<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240523090333 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chauffeur (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, matriculechauffeur VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE detentionvoiture (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, matriculepersonnel_id INTEGER DEFAULT NULL, matriculevoiture_id INTEGER DEFAULT NULL, numdetention VARCHAR(255) NOT NULL, datedetention DATE NOT NULL, CONSTRAINT FK_32377E78B51467 FOREIGN KEY (matriculepersonnel_id) REFERENCES personneldetenteur (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_32377E4CB72ECD FOREIGN KEY (matriculevoiture_id) REFERENCES voiture (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_32377E78B51467 ON detentionvoiture (matriculepersonnel_id)');
        $this->addSql('CREATE INDEX IDX_32377E4CB72ECD ON detentionvoiture (matriculevoiture_id)');
        $this->addSql('CREATE TABLE direction (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, abrdirection VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE etatvoiture (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, abrdirection_id INTEGER DEFAULT NULL, matriculevoiture_id INTEGER DEFAULT NULL, numetat VARCHAR(255) NOT NULL, etat VARCHAR(255) NOT NULL, dateetat DATE NOT NULL, CONSTRAINT FK_A22AFA884FAB005F FOREIGN KEY (abrdirection_id) REFERENCES direction (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_A22AFA884CB72ECD FOREIGN KEY (matriculevoiture_id) REFERENCES voiture (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_A22AFA884FAB005F ON etatvoiture (abrdirection_id)');
        $this->addSql('CREATE INDEX IDX_A22AFA884CB72ECD ON etatvoiture (matriculevoiture_id)');
        $this->addSql('CREATE TABLE genre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, genre VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE marque (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, marque VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE personneldetenteur (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, matriculevoiture_id INTEGER DEFAULT NULL, abrdirection_id INTEGER DEFAULT NULL, matriculepersonnel VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, CONSTRAINT FK_DA2234A24CB72ECD FOREIGN KEY (matriculevoiture_id) REFERENCES voiture (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_DA2234A24FAB005F FOREIGN KEY (abrdirection_id) REFERENCES direction (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_DA2234A24CB72ECD ON personneldetenteur (matriculevoiture_id)');
        $this->addSql('CREATE INDEX IDX_DA2234A24FAB005F ON personneldetenteur (abrdirection_id)');
        $this->addSql('CREATE TABLE type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE voiture (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, matriculechauffeur_id INTEGER DEFAULT NULL, type_id INTEGER DEFAULT NULL, marque_id INTEGER DEFAULT NULL, genre_id INTEGER DEFAULT NULL, abrdirection_id INTEGER DEFAULT NULL, matriculevoiture VARCHAR(255) NOT NULL, dateentrevoiture DATE NOT NULL, CONSTRAINT FK_E9E2810FE16537AC FOREIGN KEY (matriculechauffeur_id) REFERENCES chauffeur (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E9E2810FC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E9E2810F4827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E9E2810F4296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E9E2810F4FAB005F FOREIGN KEY (abrdirection_id) REFERENCES direction (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_E9E2810FE16537AC ON voiture (matriculechauffeur_id)');
        $this->addSql('CREATE INDEX IDX_E9E2810FC54C8C93 ON voiture (type_id)');
        $this->addSql('CREATE INDEX IDX_E9E2810F4827B9B2 ON voiture (marque_id)');
        $this->addSql('CREATE INDEX IDX_E9E2810F4296D31F ON voiture (genre_id)');
        $this->addSql('CREATE INDEX IDX_E9E2810F4FAB005F ON voiture (abrdirection_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__messenger_messages AS SELECT id, body, headers, queue_name, created_at, available_at, delivered_at FROM messenger_messages');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO messenger_messages (id, body, headers, queue_name, created_at, available_at, delivered_at) SELECT id, body, headers, queue_name, created_at, available_at, delivered_at FROM __temp__messenger_messages');
        $this->addSql('DROP TABLE __temp__messenger_messages');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE chauffeur');
        $this->addSql('DROP TABLE detentionvoiture');
        $this->addSql('DROP TABLE direction');
        $this->addSql('DROP TABLE etatvoiture');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE marque');
        $this->addSql('DROP TABLE personneldetenteur');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE voiture');
        $this->addSql('CREATE TEMPORARY TABLE __temp__messenger_messages AS SELECT id, body, headers, queue_name, created_at, available_at, delivered_at FROM messenger_messages');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('INSERT INTO messenger_messages (id, body, headers, queue_name, created_at, available_at, delivered_at) SELECT id, body, headers, queue_name, created_at, available_at, delivered_at FROM __temp__messenger_messages');
        $this->addSql('DROP TABLE __temp__messenger_messages');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }
}
