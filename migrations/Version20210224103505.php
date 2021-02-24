<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210224103505 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dishes (id UUID NOT NULL, restaurant_id UUID NOT NULL, name VARCHAR(255) NOT NULL, amount DOUBLE PRECISION NOT NULL, picture VARCHAR(255) NOT NULL, weight SMALLINT NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_584DD35DB1E7706E ON dishes (restaurant_id)');
        $this->addSql('COMMENT ON COLUMN dishes.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN dishes.restaurant_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE restaurants (id UUID NOT NULL, name VARCHAR(100) NOT NULL, delivery_min_price DOUBLE PRECISION NOT NULL, delivery_cost DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN restaurants.id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE dishes ADD CONSTRAINT FK_584DD35DB1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurants (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE dishes DROP CONSTRAINT FK_584DD35DB1E7706E');
        $this->addSql('DROP TABLE dishes');
        $this->addSql('DROP TABLE restaurants');
    }
}
