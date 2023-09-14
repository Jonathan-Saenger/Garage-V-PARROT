<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230807201337 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin ADD email VARCHAR(255) NOT NULL, ADD password VARCHAR(255) NOT NULL, DROP mail, DROP motdepasse');
        $this->addSql('ALTER TABLE employe ADD email VARCHAR(255) NOT NULL, ADD password VARCHAR(255) NOT NULL, DROP mail, DROP motdepasse');
        $this->addSql('ALTER TABLE horaire CHANGE admin_id admin_id INT DEFAULT NULL, CHANGE garage_id garage_id INT DEFAULT NULL, CHANGE heure_ouverture heure_ouverture TIME DEFAULT NULL, CHANGE heure_fermeture heure_fermeture TIME DEFAULT NULL, CHANGE ouverture_soir ouverture_soir TIME DEFAULT NULL, CHANGE fermeture_soir fermeture_soir TIME DEFAULT NULL');
        $this->addSql('ALTER TABLE service CHANGE admin_id admin_id INT NOT NULL, CHANGE garage_id garage_id INT NOT NULL, CHANGE photo photo LONGBLOB NOT NULL');
        $this->addSql('ALTER TABLE temoignage CHANGE garage_id garage_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin ADD mail VARCHAR(255) NOT NULL, ADD motdepasse VARCHAR(255) NOT NULL, DROP email, DROP password');
        $this->addSql('ALTER TABLE employe ADD mail VARCHAR(255) NOT NULL, ADD motdepasse VARCHAR(255) NOT NULL, DROP email, DROP password');
        $this->addSql('ALTER TABLE horaire CHANGE admin_id admin_id INT DEFAULT NULL, CHANGE garage_id garage_id INT DEFAULT NULL, CHANGE heure_ouverture heure_ouverture TIME DEFAULT NULL, CHANGE heure_fermeture heure_fermeture TIME DEFAULT NULL, CHANGE ouverture_soir ouverture_soir TIME DEFAULT NULL, CHANGE fermeture_soir fermeture_soir TIME DEFAULT NULL');
        $this->addSql('ALTER TABLE service CHANGE admin_id admin_id INT DEFAULT NULL, CHANGE garage_id garage_id INT DEFAULT NULL, CHANGE photo photo LONGBLOB DEFAULT NULL');
        $this->addSql('ALTER TABLE temoignage CHANGE garage_id garage_id INT DEFAULT NULL');
    }
}
