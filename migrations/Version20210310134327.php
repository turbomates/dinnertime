<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210310134327 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dishes DROP CONSTRAINT fk_584dd35db1e7706e');
        $this->addSql('DROP INDEX idx_584dd35db1e7706e');
        $this->addSql('ALTER TABLE restaurants DROP id');
        $this->addSql('ALTER TABLE restaurants ADD PRIMARY KEY (name)');
        $this->addSql('ALTER TABLE dishes ADD restaurant_name VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE dishes DROP restaurant_id');
        $this->addSql('ALTER TABLE dishes ADD CONSTRAINT FK_584DD35D9C35EE62 FOREIGN KEY (restaurant_name) REFERENCES restaurants (name) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_584DD35D9C35EE62 ON dishes (restaurant_name)');;
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX restaurants_pkey');
        $this->addSql('ALTER TABLE restaurants ADD id UUID NOT NULL');
        $this->addSql('COMMENT ON COLUMN restaurants.id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE restaurants ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE dishes DROP CONSTRAINT FK_584DD35D9C35EE62');
        $this->addSql('DROP INDEX IDX_584DD35D9C35EE62');
        $this->addSql('ALTER TABLE dishes ADD restaurant_id UUID NOT NULL');
        $this->addSql('ALTER TABLE dishes DROP restaurant_name');
        $this->addSql('COMMENT ON COLUMN dishes.restaurant_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE dishes ADD CONSTRAINT fk_584dd35db1e7706e FOREIGN KEY (restaurant_id) REFERENCES restaurants (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_584dd35db1e7706e ON dishes (restaurant_id)');
    }
}
