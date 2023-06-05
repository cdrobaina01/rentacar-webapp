<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230602143231 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brand (id INT IDENTITY NOT NULL, name VARCHAR(MAX) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE model (id INT IDENTITY NOT NULL, brand_id INT NOT NULL, name VARCHAR(MAX) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_D79572D944F5D008 ON model (brand_id)');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D944F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE tourist DROP CONSTRAINT FK_9891FEDED8A48BBD');
        $this->addSql('DROP INDEX IDX_9891FEDED8A48BBD ON tourist');
        $this->addSql('sp_rename \'tourist.country_id_id\', \'country_id\', \'COLUMN\'');
        $this->addSql('ALTER TABLE tourist ADD CONSTRAINT FK_9891FEDEF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_9891FEDEF92F3E70 ON tourist (country_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA db_accessadmin');
        $this->addSql('CREATE SCHEMA db_backupoperator');
        $this->addSql('CREATE SCHEMA db_datareader');
        $this->addSql('CREATE SCHEMA db_datawriter');
        $this->addSql('CREATE SCHEMA db_ddladmin');
        $this->addSql('CREATE SCHEMA db_denydatareader');
        $this->addSql('CREATE SCHEMA db_denydatawriter');
        $this->addSql('CREATE SCHEMA db_owner');
        $this->addSql('CREATE SCHEMA db_securityadmin');
        $this->addSql('CREATE SCHEMA dbo');
        $this->addSql('ALTER TABLE model DROP CONSTRAINT FK_D79572D944F5D008');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE model');
        $this->addSql('ALTER TABLE tourist DROP CONSTRAINT FK_9891FEDEF92F3E70');
        $this->addSql('DROP INDEX IDX_9891FEDEF92F3E70 ON tourist');
        $this->addSql('sp_rename \'tourist.country_id\', \'country_id_id\', \'COLUMN\'');
        $this->addSql('ALTER TABLE tourist ADD CONSTRAINT FK_9891FEDED8A48BBD FOREIGN KEY (country_id_id) REFERENCES country (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE NONCLUSTERED INDEX IDX_9891FEDED8A48BBD ON tourist (country_id_id)');
    }
}
