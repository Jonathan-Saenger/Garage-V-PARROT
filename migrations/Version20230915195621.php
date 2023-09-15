<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230915195621 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce CHANGE photo photo LONGBLOB DEFAULT NULL');
        $this->addSql('ALTER TABLE horaire CHANGE garage_id garage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE service CHANGE garage_id garage_id INT DEFAULT NULL, CHANGE photo photo LONGBLOB NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce CHANGE photo photo LONGBLOB DEFAULT NULL');
        $this->addSql('ALTER TABLE horaire CHANGE garage_id garage_id INT NOT NULL');
        $this->addSql('ALTER TABLE service CHANGE garage_id garage_id INT DEFAULT NULL, CHANGE photo photo LONGBLOB DEFAULT NULL');
    }
}
