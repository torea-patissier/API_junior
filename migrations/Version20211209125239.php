<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211209125239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offers ADD cities_id INT DEFAULT NULL, ADD diplomer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA460427CAC75398 FOREIGN KEY (cities_id) REFERENCES cities (id)');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA46042711EFA14D FOREIGN KEY (diplomer_id) REFERENCES diplomer (id)');
        $this->addSql('CREATE INDEX IDX_DA460427CAC75398 ON offers (cities_id)');
        $this->addSql('CREATE INDEX IDX_DA46042711EFA14D ON offers (diplomer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offers DROP FOREIGN KEY FK_DA460427CAC75398');
        $this->addSql('ALTER TABLE offers DROP FOREIGN KEY FK_DA46042711EFA14D');
        $this->addSql('DROP INDEX IDX_DA460427CAC75398 ON offers');
        $this->addSql('DROP INDEX IDX_DA46042711EFA14D ON offers');
        $this->addSql('ALTER TABLE offers DROP cities_id, DROP diplomer_id');
    }
}
