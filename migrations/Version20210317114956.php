<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210317114956 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE basket (id UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, user_id UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE basket_dish (id UUID NOT NULL, basket_id UUID NOT NULL, dish_id UUID NOT NULL, dish_name VARCHAR(255) NOT NULL, dish_price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5EF2958D1BE1FB52 ON basket_dish (basket_id)');
        $this->addSql('CREATE TABLE order_items (id UUID NOT NULL, order_id UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, user_id UUID NOT NULL, total_price DOUBLE PRECISION NOT NULL, is_payed BOOLEAN NOT NULL, dishes JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_62809DB0A76ED395 ON order_items (user_id)');
        $this->addSql('CREATE INDEX IDX_62809DB08D9F6D38 ON order_items (order_id)');
        $this->addSql('CREATE TABLE orders (id UUID NOT NULL, order_user_id UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E52FFDEE51147ADE ON orders (order_user_id)');
        $this->addSql('ALTER TABLE basket_dish ADD CONSTRAINT FK_5EF2958D1BE1FB52 FOREIGN KEY (basket_id) REFERENCES basket (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE order_items ADD CONSTRAINT FK_62809DB08D9F6D38 FOREIGN KEY (order_id) REFERENCES orders (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE basket_dish DROP CONSTRAINT FK_5EF2958D1BE1FB52');
        $this->addSql('ALTER TABLE order_items DROP CONSTRAINT FK_62809DB08D9F6D38');
        $this->addSql('DROP TABLE basket');
        $this->addSql('DROP TABLE basket_dish');
        $this->addSql('DROP TABLE order_items');
        $this->addSql('DROP TABLE orders');
    }
}
