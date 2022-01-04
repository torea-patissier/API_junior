<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211209125040 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE students ADD cities_id INT DEFAULT NULL, ADD profession_id INT DEFAULT NULL, ADD diplomer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE students ADD CONSTRAINT FK_A4698DB2CAC75398 FOREIGN KEY (cities_id) REFERENCES cities (id)');
        $this->addSql('ALTER TABLE students ADD CONSTRAINT FK_A4698DB2FDEF8996 FOREIGN KEY (profession_id) REFERENCES professions (id)');
        $this->addSql('ALTER TABLE students ADD CONSTRAINT FK_A4698DB211EFA14D FOREIGN KEY (diplomer_id) REFERENCES diplomer (id)');
        $this->addSql('CREATE INDEX IDX_A4698DB2CAC75398 ON students (cities_id)');
        $this->addSql('CREATE INDEX IDX_A4698DB2FDEF8996 ON students (profession_id)');
        $this->addSql('CREATE INDEX IDX_A4698DB211EFA14D ON students (diplomer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE students DROP FOREIGN KEY FK_A4698DB2CAC75398');
        $this->addSql('ALTER TABLE students DROP FOREIGN KEY FK_A4698DB2FDEF8996');
        $this->addSql('ALTER TABLE students DROP FOREIGN KEY FK_A4698DB211EFA14D');
        $this->addSql('DROP INDEX IDX_A4698DB2CAC75398 ON students');
        $this->addSql('DROP INDEX IDX_A4698DB2FDEF8996 ON students');
        $this->addSql('DROP INDEX IDX_A4698DB211EFA14D ON students');
        $this->addSql('ALTER TABLE students DROP cities_id, DROP profession_id, DROP diplomer_id');
    }
}
