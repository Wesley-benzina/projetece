<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200903204417 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE devis ADD projet_id INT NOT NULL, DROP linkto');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BC18272 FOREIGN KEY (projet_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_8B27C52BC18272 ON devis (projet_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BC18272');
        $this->addSql('DROP INDEX IDX_8B27C52BC18272 ON devis');
        $this->addSql('ALTER TABLE devis ADD linkto VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP projet_id');
    }
}
