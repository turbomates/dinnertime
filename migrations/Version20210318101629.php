<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210318101629 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Deleted column dish_id in the table BASKET_ID and changed type of user_id column in the table BASKET';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE basket ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE basket ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE basket ALTER user_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE basket ALTER user_id DROP DEFAULT');
        $this->addSql('ALTER TABLE basket_dish DROP dish_id');
        $this->addSql('ALTER TABLE basket_dish ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE basket_dish ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE basket_dish ALTER basket_id TYPE UUID');
        $this->addSql('ALTER TABLE basket_dish ALTER basket_id DROP DEFAULT');
        $this->addSql('ALTER TABLE order_items ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE order_items ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE order_items ALTER order_id TYPE UUID');
        $this->addSql('ALTER TABLE order_items ALTER order_id DROP DEFAULT');
        $this->addSql('ALTER TABLE order_items ALTER user_id TYPE UUID');
        $this->addSql('ALTER TABLE order_items ALTER user_id DROP DEFAULT');
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
        $this->addSql('ALTER TABLE basket_dish ADD dish_id UUID NOT NULL');
        $this->addSql('ALTER TABLE basket_dish ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE basket_dish ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE basket_dish ALTER basket_id TYPE UUID');
        $this->addSql('ALTER TABLE basket_dish ALTER basket_id DROP DEFAULT');
        $this->addSql('ALTER TABLE orders ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE orders ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE orders ALTER order_user_id TYPE UUID');
        $this->addSql('ALTER TABLE orders ALTER order_user_id DROP DEFAULT');
        $this->addSql('ALTER TABLE order_items ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE order_items ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE order_items ALTER order_id TYPE UUID');
        $this->addSql('ALTER TABLE order_items ALTER order_id DROP DEFAULT');
        $this->addSql('ALTER TABLE order_items ALTER user_id TYPE UUID');
        $this->addSql('ALTER TABLE order_items ALTER user_id DROP DEFAULT');
    }
}
