<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220110134553 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE offers (id INT AUTO_INCREMENT NOT NULL, city_id INT NOT NULL, diploma_id INT NOT NULL, jobs VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, publication_date DATE NOT NULL, expiration_date DATE NOT NULL, image VARCHAR(255) NOT NULL, type_of_contract VARCHAR(255) NOT NULL, type_of_work VARCHAR(255) NOT NULL, INDEX IDX_DA460427979B1AD6 (company_id), INDEX IDX_DA4604278BAC62AF (city_id), INDEX IDX_DA460427A99ACEB5 (diploma_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA4604278BAC62AF FOREIGN KEY (city_id) REFERENCES cities (id)');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA460427A99ACEB5 FOREIGN KEY (diploma_id) REFERENCES diplomas (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE offers');
    }
}
