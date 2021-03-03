<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210303153659 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE campus ADD id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE users ADD campus_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9AF5D55E1 FOREIGN KEY (campus_id) REFERENCES campus (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E9AF5D55E1 ON users (campus_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE campus MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE campus DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE campus DROP id');
        $this->addSql('ALTER TABLE campus ADD PRIMARY KEY (id_campus)');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9AF5D55E1');
        $this->addSql('DROP INDEX IDX_1483A5E9AF5D55E1 ON users');
        $this->addSql('ALTER TABLE users DROP campus_id');
    }
}
