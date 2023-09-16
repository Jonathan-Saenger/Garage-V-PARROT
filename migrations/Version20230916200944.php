<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230916200944 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce CHANGE photo photo LONGBLOB DEFAULT NULL');
        $this->addSql('ALTER TABLE horaire CHANGE heure_ouverture heure_ouverture TIME DEFAULT NULL, CHANGE heure_fermeture heure_fermeture TIME DEFAULT NULL, CHANGE ouverture_soir ouverture_soir TIME DEFAULT NULL, CHANGE fermeture_soir fermeture_soir TIME DEFAULT NULL');
        $this->addSql('ALTER TABLE service CHANGE garage_id garage_id INT DEFAULT NULL, CHANGE photo photo LONGBLOB DEFAULT NULL');
        $this->addSql('ALTER TABLE temoignage CHANGE garage_id garage_id INT DEFAULT NULL, CHANGE publication publication TINYINT(1) DEFAULT NULL, CHANGE jourpublication jourpublication DATE DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce CHANGE photo photo LONGBLOB DEFAULT NULL');
        $this->addSql('ALTER TABLE horaire CHANGE heure_ouverture heure_ouverture TIME DEFAULT NULL, CHANGE heure_fermeture heure_fermeture TIME DEFAULT NULL, CHANGE ouverture_soir ouverture_soir TIME DEFAULT NULL, CHANGE fermeture_soir fermeture_soir TIME DEFAULT NULL');
        $this->addSql('ALTER TABLE service CHANGE garage_id garage_id INT DEFAULT NULL, CHANGE photo photo LONGBLOB DEFAULT NULL');
        $this->addSql('ALTER TABLE temoignage CHANGE garage_id garage_id INT DEFAULT NULL, CHANGE publication publication TINYINT(1) DEFAULT NULL, CHANGE jourpublication jourpublication DATE DEFAULT NULL');
    }
}
