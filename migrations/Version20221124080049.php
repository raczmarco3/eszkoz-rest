<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221124080049 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE eszkoz (id INT AUTO_INCREMENT NOT NULL, tulajdonos_id INT NOT NULL, marka VARCHAR(255) NOT NULL, tipus VARCHAR(255) NOT NULL, leiras VARCHAR(255) NOT NULL, jelleg VARCHAR(255) NOT NULL, INDEX IDX_453C2E26843FC954 (tulajdonos_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tulajdonos (id INT AUTO_INCREMENT NOT NULL, nev VARCHAR(255) NOT NULL, szemelyi VARCHAR(255) NOT NULL, szuldatum DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE eszkoz ADD CONSTRAINT FK_453C2E26843FC954 FOREIGN KEY (tulajdonos_id) REFERENCES tulajdonos (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eszkoz DROP FOREIGN KEY FK_453C2E26843FC954');
        $this->addSql('DROP TABLE eszkoz');
        $this->addSql('DROP TABLE tulajdonos');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
