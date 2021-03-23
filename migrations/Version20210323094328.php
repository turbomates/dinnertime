<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210323094328 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE basket ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE basket ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE basket ALTER user_id TYPE UUID');
        $this->addSql('ALTER TABLE basket ALTER user_id DROP DEFAULT');
        $this->addSql('ALTER TABLE basket_dish ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE basket_dish ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE basket_dish ALTER basket_id TYPE UUID');
        $this->addSql('ALTER TABLE basket_dish ALTER basket_id DROP DEFAULT');
        $this->addSql('ALTER TABLE basket_dish ALTER dish_id TYPE UUID');
        $this->addSql('ALTER TABLE basket_dish ALTER dish_id DROP DEFAULT');
        $this->addSql('DROP INDEX uniq_62809db0a76ed395');
        $this->addSql('ALTER TABLE order_items ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE order_items ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE order_items ALTER order_id TYPE UUID');
        $this->addSql('ALTER TABLE order_items ALTER order_id DROP DEFAULT');
        $this->addSql('ALTER TABLE order_items ALTER user_id TYPE UUID');
        $this->addSql('ALTER TABLE order_items ALTER user_id DROP DEFAULT');
        $this->addSql('ALTER TABLE order_items RENAME COLUMN total_price TO total_dish_price');
        $this->addSql('DROP INDEX uniq_e52ffdee51147ade');
        $this->addSql('ALTER TABLE orders ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE orders ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE orders ALTER order_user_id TYPE UUID');
        $this->addSql('ALTER TABLE orders ALTER order_user_id DROP DEFAULT');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE basket ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE basket ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE basket ALTER user_id TYPE UUID');
        $this->addSql('ALTER TABLE basket ALTER user_id DROP DEFAULT');
        $this->addSql('ALTER TABLE basket_dish ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE basket_dish ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE basket_dish ALTER basket_id TYPE UUID');
        $this->addSql('ALTER TABLE basket_dish ALTER basket_id DROP DEFAULT');
        $this->addSql('ALTER TABLE basket_dish ALTER dish_id TYPE UUID');
        $this->addSql('ALTER TABLE basket_dish ALTER dish_id DROP DEFAULT');
        $this->addSql('ALTER TABLE orders ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE orders ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE orders ALTER order_user_id TYPE UUID');
        $this->addSql('ALTER TABLE orders ALTER order_user_id DROP DEFAULT');
        $this->addSql('CREATE UNIQUE INDEX uniq_e52ffdee51147ade ON orders (order_user_id)');
        $this->addSql('ALTER TABLE order_items ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE order_items ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE order_items ALTER order_id TYPE UUID');
        $this->addSql('ALTER TABLE order_items ALTER order_id DROP DEFAULT');
        $this->addSql('ALTER TABLE order_items ALTER user_id TYPE UUID');
        $this->addSql('ALTER TABLE order_items ALTER user_id DROP DEFAULT');
        $this->addSql('ALTER TABLE order_items RENAME COLUMN total_dish_price TO total_price');
        $this->addSql('CREATE UNIQUE INDEX uniq_62809db0a76ed395 ON order_items (user_id)');
    }
}
