<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211209130509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cities (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE diplomer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enterprises (id INT AUTO_INCREMENT NOT NULL, cities_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description_enterprise VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, avater_enterprise VARCHAR(255) NOT NULL, INDEX IDX_82B62DDBCAC75398 (cities_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offers (id INT AUTO_INCREMENT NOT NULL, enterprises_id INT DEFAULT NULL, cities_id INT DEFAULT NULL, diplomer_id INT DEFAULT NULL, jod_offer VARCHAR(255) NOT NULL, description_offer VARCHAR(255) NOT NULL, data_of_publication DATE NOT NULL, contract_type VARCHAR(255) NOT NULL, type_of_work VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, expiring_data DATE NOT NULL, INDEX IDX_DA460427E5B55335 (enterprises_id), INDEX IDX_DA460427CAC75398 (cities_id), INDEX IDX_DA46042711EFA14D (diplomer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professions (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE students (id INT AUTO_INCREMENT NOT NULL, cities_id INT DEFAULT NULL, profession_id INT DEFAULT NULL, diplomer_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, avater VARCHAR(255) NOT NULL, experience VARCHAR(255) NOT NULL, INDEX IDX_A4698DB2CAC75398 (cities_id), INDEX IDX_A4698DB2FDEF8996 (profession_id), INDEX IDX_A4698DB211EFA14D (diplomer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE enterprises ADD CONSTRAINT FK_82B62DDBCAC75398 FOREIGN KEY (cities_id) REFERENCES cities (id)');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA460427E5B55335 FOREIGN KEY (enterprises_id) REFERENCES enterprises (id)');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA460427CAC75398 FOREIGN KEY (cities_id) REFERENCES cities (id)');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA46042711EFA14D FOREIGN KEY (diplomer_id) REFERENCES diplomer (id)');
        $this->addSql('ALTER TABLE students ADD CONSTRAINT FK_A4698DB2CAC75398 FOREIGN KEY (cities_id) REFERENCES cities (id)');
        $this->addSql('ALTER TABLE students ADD CONSTRAINT FK_A4698DB2FDEF8996 FOREIGN KEY (profession_id) REFERENCES professions (id)');
        $this->addSql('ALTER TABLE students ADD CONSTRAINT FK_A4698DB211EFA14D FOREIGN KEY (diplomer_id) REFERENCES diplomer (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE enterprises DROP FOREIGN KEY FK_82B62DDBCAC75398');
        $this->addSql('ALTER TABLE offers DROP FOREIGN KEY FK_DA460427CAC75398');
        $this->addSql('ALTER TABLE students DROP FOREIGN KEY FK_A4698DB2CAC75398');
        $this->addSql('ALTER TABLE offers DROP FOREIGN KEY FK_DA46042711EFA14D');
        $this->addSql('ALTER TABLE students DROP FOREIGN KEY FK_A4698DB211EFA14D');
        $this->addSql('ALTER TABLE offers DROP FOREIGN KEY FK_DA460427E5B55335');
        $this->addSql('ALTER TABLE students DROP FOREIGN KEY FK_A4698DB2FDEF8996');
        $this->addSql('DROP TABLE cities');
        $this->addSql('DROP TABLE diplomer');
        $this->addSql('DROP TABLE enterprises');
        $this->addSql('DROP TABLE offers');
        $this->addSql('DROP TABLE professions');
        $this->addSql('DROP TABLE students');
    }
}
