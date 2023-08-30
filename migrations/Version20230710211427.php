<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230710211427 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE employe_annonce (employe_id INT NOT NULL, annonce_id INT NOT NULL, INDEX IDX_325AFF461B65292 (employe_id), INDEX IDX_325AFF468805AB2F (annonce_id), PRIMARY KEY(employe_id, annonce_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employe_temoignage (employe_id INT NOT NULL, temoignage_id INT NOT NULL, INDEX IDX_3F6466811B65292 (employe_id), INDEX IDX_3F646681F2410A1E (temoignage_id), PRIMARY KEY(employe_id, temoignage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE employe_annonce ADD CONSTRAINT FK_325AFF461B65292 FOREIGN KEY (employe_id) REFERENCES employe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employe_annonce ADD CONSTRAINT FK_325AFF468805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employe_temoignage ADD CONSTRAINT FK_3F6466811B65292 FOREIGN KEY (employe_id) REFERENCES employe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employe_temoignage ADD CONSTRAINT FK_3F646681F2410A1E FOREIGN KEY (temoignage_id) REFERENCES temoignage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE annonce ADD garage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5C4FFF555 FOREIGN KEY (garage_id) REFERENCES garage (id)');
        $this->addSql('CREATE INDEX IDX_F65593E5C4FFF555 ON annonce (garage_id)');
        $this->addSql('ALTER TABLE employe ADD admin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B9642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_F804D3B9642B8210 ON employe (admin_id)');
        $this->addSql('ALTER TABLE horaire ADD admin_id INT DEFAULT NULL, ADD garage_id INT DEFAULT NULL'); // MODIFIE EN DEFAUT NULL
        $this->addSql('ALTER TABLE horaire ADD CONSTRAINT FK_BBC83DB6642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE horaire ADD CONSTRAINT FK_BBC83DB6C4FFF555 FOREIGN KEY (garage_id) REFERENCES garage (id)');
        $this->addSql('CREATE INDEX IDX_BBC83DB6642B8210 ON horaire (admin_id)');
        $this->addSql('CREATE INDEX IDX_BBC83DB6C4FFF555 ON horaire (garage_id)');
        $this->addSql('ALTER TABLE service ADD admin_id INT DEFAULT NULL, ADD garage_id INT DEFAULT NULL'); // MODIFIE EN DEFAUT NULL
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2C4FFF555 FOREIGN KEY (garage_id) REFERENCES garage (id)');
        $this->addSql('CREATE INDEX IDX_E19D9AD2642B8210 ON service (admin_id)');
        $this->addSql('CREATE INDEX IDX_E19D9AD2C4FFF555 ON service (garage_id)');
        $this->addSql('ALTER TABLE temoignage ADD garage_id INT NOT NULL');
        $this->addSql('ALTER TABLE temoignage ADD CONSTRAINT FK_BDADBC46C4FFF555 FOREIGN KEY (garage_id) REFERENCES garage (id)');
        $this->addSql('CREATE INDEX IDX_BDADBC46C4FFF555 ON temoignage (garage_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employe_annonce DROP FOREIGN KEY FK_325AFF461B65292');
        $this->addSql('ALTER TABLE employe_annonce DROP FOREIGN KEY FK_325AFF468805AB2F');
        $this->addSql('ALTER TABLE employe_temoignage DROP FOREIGN KEY FK_3F6466811B65292');
        $this->addSql('ALTER TABLE employe_temoignage DROP FOREIGN KEY FK_3F646681F2410A1E');
        $this->addSql('DROP TABLE employe_annonce');
        $this->addSql('DROP TABLE employe_temoignage');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5C4FFF555');
        $this->addSql('DROP INDEX IDX_F65593E5C4FFF555 ON annonce');
        $this->addSql('ALTER TABLE annonce DROP garage_id');
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B9642B8210');
        $this->addSql('DROP INDEX IDX_F804D3B9642B8210 ON employe');
        $this->addSql('ALTER TABLE employe DROP admin_id');
        $this->addSql('ALTER TABLE horaire DROP FOREIGN KEY FK_BBC83DB6642B8210');
        $this->addSql('ALTER TABLE horaire DROP FOREIGN KEY FK_BBC83DB6C4FFF555');
        $this->addSql('DROP INDEX IDX_BBC83DB6642B8210 ON horaire');
        $this->addSql('DROP INDEX IDX_BBC83DB6C4FFF555 ON horaire');
        $this->addSql('ALTER TABLE horaire DROP admin_id, DROP garage_id');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2642B8210');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2C4FFF555');
        $this->addSql('DROP INDEX IDX_E19D9AD2642B8210 ON service');
        $this->addSql('DROP INDEX IDX_E19D9AD2C4FFF555 ON service');
        $this->addSql('ALTER TABLE service DROP admin_id, DROP garage_id');
        $this->addSql('ALTER TABLE temoignage DROP FOREIGN KEY FK_BDADBC46C4FFF555');
        $this->addSql('DROP INDEX IDX_BDADBC46C4FFF555 ON temoignage');
        $this->addSql('ALTER TABLE temoignage DROP garage_id');
    }
}
