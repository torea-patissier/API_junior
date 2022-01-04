<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211209123902 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE offers (id INT AUTO_INCREMENT NOT NULL, enterprises_id INT DEFAULT NULL, jod_offer VARCHAR(255) NOT NULL, description_offer VARCHAR(255) NOT NULL, data_of_publication DATE NOT NULL, contract_type VARCHAR(255) NOT NULL, type_of_work VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, expiring_data DATE NOT NULL, INDEX IDX_DA460427E5B55335 (enterprises_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA460427E5B55335 FOREIGN KEY (enterprises_id) REFERENCES enterprises (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE offers');
    }
}
