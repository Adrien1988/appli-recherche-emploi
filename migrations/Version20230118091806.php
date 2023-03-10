<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230118091806 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE applications (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, offers_id INT NOT NULL, results_id INT NOT NULL, sending_date DATE NOT NULL, send_mode VARCHAR(200) NOT NULL, type VARCHAR(200) NOT NULL, release_date DATE NOT NULL, support VARCHAR(150) NOT NULL, curriculum VARCHAR(255) DEFAULT NULL, cover_letter VARCHAR(255) DEFAULT NULL, INDEX IDX_F7C966F067B3B43D (users_id), INDEX IDX_F7C966F0A090B42E (offers_id), UNIQUE INDEX UNIQ_F7C966F08A30AB9 (results_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enterprises (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, address VARCHAR(255) NOT NULL, zipcode VARCHAR(5) NOT NULL, city VARCHAR(150) NOT NULL, website VARCHAR(255) NOT NULL, contact VARCHAR(150) NOT NULL, contact_function VARCHAR(150) NOT NULL, phone_number VARCHAR(10) NOT NULL, email VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offers (id INT AUTO_INCREMENT NOT NULL, enterprises_id INT NOT NULL, reference VARCHAR(50) NOT NULL, job VARCHAR(150) NOT NULL, description LONGTEXT NOT NULL, link VARCHAR(255) NOT NULL, INDEX IDX_DA460427E5B55335 (enterprises_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reminders (id INT AUTO_INCREMENT NOT NULL, applications_id INT NOT NULL, reminder_date DATE NOT NULL, relaunch_mode VARCHAR(150) NOT NULL, job_interwiew_date DATE DEFAULT NULL, INDEX IDX_6D92B9D429A0022 (applications_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE results (id INT AUTO_INCREMENT NOT NULL, answer VARCHAR(200) NOT NULL, comment LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, lastname VARCHAR(100) NOT NULL, firstname VARCHAR(100) NOT NULL, address VARCHAR(255) NOT NULL, zipcode VARCHAR(5) NOT NULL, city VARCHAR(150) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE applications ADD CONSTRAINT FK_F7C966F067B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE applications ADD CONSTRAINT FK_F7C966F0A090B42E FOREIGN KEY (offers_id) REFERENCES offers (id)');
        $this->addSql('ALTER TABLE applications ADD CONSTRAINT FK_F7C966F08A30AB9 FOREIGN KEY (results_id) REFERENCES results (id)');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA460427E5B55335 FOREIGN KEY (enterprises_id) REFERENCES enterprises (id)');
        $this->addSql('ALTER TABLE reminders ADD CONSTRAINT FK_6D92B9D429A0022 FOREIGN KEY (applications_id) REFERENCES applications (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE applications DROP FOREIGN KEY FK_F7C966F067B3B43D');
        $this->addSql('ALTER TABLE applications DROP FOREIGN KEY FK_F7C966F0A090B42E');
        $this->addSql('ALTER TABLE applications DROP FOREIGN KEY FK_F7C966F08A30AB9');
        $this->addSql('ALTER TABLE offers DROP FOREIGN KEY FK_DA460427E5B55335');
        $this->addSql('ALTER TABLE reminders DROP FOREIGN KEY FK_6D92B9D429A0022');
        $this->addSql('DROP TABLE applications');
        $this->addSql('DROP TABLE enterprises');
        $this->addSql('DROP TABLE offers');
        $this->addSql('DROP TABLE reminders');
        $this->addSql('DROP TABLE results');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
