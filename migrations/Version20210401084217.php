<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210401084217 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Added column user_info with type JSON in the table orders';
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
        $this->addSql('ALTER TABLE order_items ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE order_items ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE order_items ALTER order_id TYPE UUID');
        $this->addSql('ALTER TABLE order_items ALTER order_id DROP DEFAULT');
        $this->addSql('ALTER TABLE order_items ALTER user_id TYPE UUID');
        $this->addSql('ALTER TABLE order_items ALTER user_id DROP DEFAULT');
        $this->addSql('ALTER TABLE orders ADD user_info JSON DEFAULT NULL');

        $users = $this->connection->executeQuery('Select order_user_id from orders')->fetchAllAssociative();
        foreach ($users as $user){
            $name = json_encode($this->connection->executeQuery('Select first_name, last_name from users where id = :id', ['id' => $user['order_user_id']])->fetchAllAssociative());
            $this->addSql('UPDATE orders SET user_info = :userInfo', ['userInfo' => $name]);
        }
        $this->addSql('ALTER TABLE orders ALTER COLUMN user_info SET NOT NULL');
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
        $this->addSql('ALTER TABLE orders DROP user_info');
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
