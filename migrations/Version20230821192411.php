<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230821192411 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce ADD carburant VARCHAR(255) DEFAULT NULL, ADD boite_vitesse VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE horaire CHANGE admin_id admin_id INT DEFAULT NULL, CHANGE garage_id garage_id INT DEFAULT NULL, CHANGE heure_ouverture heure_ouverture TIME NOT NULL, CHANGE heure_fermeture heure_fermeture TIME NOT NULL, CHANGE ouverture_soir ouverture_soir TIME NOT NULL, CHANGE fermeture_soir fermeture_soir TIME NOT NULL');
        $this->addSql('ALTER TABLE temoignage CHANGE garage_id garage_id INT DEFAULT NULL, CHANGE note note INT NOT NULL, CHANGE jourpublication jourpublication DATE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce DROP carburant, DROP boite_vitesse');
        $this->addSql('ALTER TABLE horaire CHANGE admin_id admin_id INT DEFAULT NULL, CHANGE garage_id garage_id INT DEFAULT NULL, CHANGE heure_ouverture heure_ouverture TIME DEFAULT NULL, CHANGE heure_fermeture heure_fermeture TIME DEFAULT NULL, CHANGE ouverture_soir ouverture_soir TIME DEFAULT NULL, CHANGE fermeture_soir fermeture_soir TIME DEFAULT NULL');
        $this->addSql('ALTER TABLE temoignage CHANGE garage_id garage_id INT DEFAULT NULL, CHANGE note note INT DEFAULT NULL, CHANGE jourpublication jourpublication DATE DEFAULT NULL');
    }
}
