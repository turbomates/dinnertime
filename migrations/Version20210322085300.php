<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Symfony\Component\Uid\Uuid;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210322085300 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Changed type of the column user_id in the table basket and add column dish_id in the table basket_dish';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE basket ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE basket ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE basket ALTER COLUMN user_id SET DATA TYPE UUID USING user_id::UUID');
        $this->addSql('ALTER TABLE basket ALTER user_id DROP DEFAULT');
        $this->addSql('ALTER TABLE basket_dish ADD dish_id UUID DEFAULT NULL');
        $basketDishes = $this->connection->executeQuery('Select id, dish_name from basket_dish')->fetchAllAssociative();
        foreach ($basketDishes as $basketDish) {
           $dishId = $this->connection->executeQuery('Select id from dishes where name = :name', ['name' => $basketDish['dish_name']])->fetchOne();
           $this->addSql('UPDATE basket_dish SET dish_id = :id', ['id' => $dishId]);
        }
        $this->addSql('ALTER TABLE basket_dish ALTER COLUMN dish_id SET NOT NULL');
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
        $this->addSql('ALTER TABLE basket_dish DROP dish_id');
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
        $this->addSql('ALTER TABLE basket ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE basket ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE basket ALTER user_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE basket ALTER user_id DROP DEFAULT');
    }
}
