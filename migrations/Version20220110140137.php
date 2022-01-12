<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220110140137 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE juniors (id INT AUTO_INCREMENT NOT NULL, city_id INT NOT NULL, profession_id INT NOT NULL, diploma_id INT NOT NULL, email VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, avatar VARCHAR(255) NOT NULL, year_of_experience VARCHAR(255) NOT NULL, INDEX IDX_1EE796ED8BAC62AF (city_id), INDEX IDX_1EE796EDFDEF8996 (profession_id), INDEX IDX_1EE796EDA99ACEB5 (diploma_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE juniors ADD CONSTRAINT FK_1EE796ED8BAC62AF FOREIGN KEY (city_id) REFERENCES cities (id)');
        $this->addSql('ALTER TABLE juniors ADD CONSTRAINT FK_1EE796EDFDEF8996 FOREIGN KEY (profession_id) REFERENCES profession (id)');
        $this->addSql('ALTER TABLE juniors ADD CONSTRAINT FK_1EE796EDA99ACEB5 FOREIGN KEY (diploma_id) REFERENCES diplomas (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE juniors');
    }
}
