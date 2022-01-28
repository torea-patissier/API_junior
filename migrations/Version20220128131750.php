<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220128131750 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offers DROP FOREIGN KEY FK_DA460427A4AEAFEA');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA460427A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprises (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offers DROP FOREIGN KEY FK_DA460427A4AEAFEA');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA460427A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprises (id)');
    }
}
