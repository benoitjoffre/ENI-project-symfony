<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210303154231 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users ADD campus_nom_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E95615BA2F FOREIGN KEY (campus_nom_id) REFERENCES campus (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E95615BA2F ON users (campus_nom_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E95615BA2F');
        $this->addSql('DROP INDEX IDX_1483A5E95615BA2F ON users');
        $this->addSql('ALTER TABLE users DROP campus_nom_id');
    }
}
