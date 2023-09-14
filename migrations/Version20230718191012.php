<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230718191012 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce CHANGE photo photo LONGBLOB DEFAULT NULL');
        $this->addSql('ALTER TABLE horaire CHANGE admin_id admin_id INT DEFAULT NULL, CHANGE garage_id garage_id INT DEFAULT NULL, CHANGE heure_ouverture heure_ouverture TIME DEFAULT NULL, CHANGE heure_fermeture heure_fermeture TIME DEFAULT NULL, CHANGE ouverture_soir ouverture_soir TIME DEFAULT NULL, CHANGE fermeture_soir fermeture_soir TIME DEFAULT NULL');
        $this->addSql('ALTER TABLE service ADD image_name VARCHAR(255) DEFAULT NULL, ADD image_size INT DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE temoignage CHANGE garage_id garage_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce CHANGE photo photo LONGBLOB DEFAULT NULL');
        $this->addSql('ALTER TABLE horaire CHANGE admin_id admin_id INT DEFAULT NULL, CHANGE garage_id garage_id INT DEFAULT NULL, CHANGE heure_ouverture heure_ouverture TIME DEFAULT NULL, CHANGE heure_fermeture heure_fermeture TIME DEFAULT NULL, CHANGE ouverture_soir ouverture_soir TIME DEFAULT NULL, CHANGE fermeture_soir fermeture_soir TIME DEFAULT NULL');
        $this->addSql('ALTER TABLE service DROP image_name, DROP image_size, DROP updated_at');
        $this->addSql('ALTER TABLE temoignage CHANGE garage_id garage_id INT DEFAULT NULL');
    }
}
