<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220127160139 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cities (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE diplomas (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprises (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_56B1B7A9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offers (id INT AUTO_INCREMENT NOT NULL, city_id INT NOT NULL, diploma_id INT NOT NULL, jobs VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, publication_date DATE NOT NULL, expiration_date DATE NOT NULL, image VARCHAR(255) NOT NULL, type_of_contract VARCHAR(255) NOT NULL, type_of_work VARCHAR(255) NOT NULL, INDEX IDX_DA4604278BAC62AF (city_id), INDEX IDX_DA460427A99ACEB5 (diploma_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profession (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE refresh_tokens (id INT AUTO_INCREMENT NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid DATETIME NOT NULL, UNIQUE INDEX UNIQ_9BACE7E1C74F2195 (refresh_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, city_id INT NOT NULL, profession_id INT NOT NULL, diploma_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, avatar VARCHAR(255) NOT NULL, year_of_experience VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D6498BAC62AF (city_id), INDEX IDX_8D93D649FDEF8996 (profession_id), INDEX IDX_8D93D649A99ACEB5 (diploma_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA4604278BAC62AF FOREIGN KEY (city_id) REFERENCES cities (id)');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA460427A99ACEB5 FOREIGN KEY (diploma_id) REFERENCES diplomas (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498BAC62AF FOREIGN KEY (city_id) REFERENCES cities (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649FDEF8996 FOREIGN KEY (profession_id) REFERENCES profession (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A99ACEB5 FOREIGN KEY (diploma_id) REFERENCES diplomas (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offers DROP FOREIGN KEY FK_DA4604278BAC62AF');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498BAC62AF');
        $this->addSql('ALTER TABLE offers DROP FOREIGN KEY FK_DA460427A99ACEB5');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A99ACEB5');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649FDEF8996');
        $this->addSql('DROP TABLE cities');
        $this->addSql('DROP TABLE diplomas');
        $this->addSql('DROP TABLE entreprises');
        $this->addSql('DROP TABLE offers');
        $this->addSql('DROP TABLE profession');
        $this->addSql('DROP TABLE refresh_tokens');
        $this->addSql('DROP TABLE user');
    }
}
