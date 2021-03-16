<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210224122527 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Changed in table dishes name column picture to path, name column price to amount,
                changed type columns name, weight.
                In table restaurants add prefixes to columns delivery_min_price_amount and delivery_cost_amount';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dishes ADD path VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE dishes DROP picture');
        $this->addSql('ALTER TABLE dishes ALTER name TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE dishes ALTER weight TYPE SMALLINT');
        $this->addSql('ALTER TABLE dishes ALTER weight DROP DEFAULT');
        $this->addSql('ALTER TABLE dishes RENAME COLUMN price TO amount');
        $this->addSql('ALTER TABLE restaurants ADD delivery_min_price_amount DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE restaurants ADD delivery_cost_amount DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE restaurants DROP min_delivery_price');
        $this->addSql('ALTER TABLE restaurants DROP delivery_cost');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurants ADD min_delivery_price DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE restaurants ADD delivery_cost DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE restaurants DROP delivery_min_price_amount');
        $this->addSql('ALTER TABLE restaurants DROP delivery_cost_amount');
        $this->addSql('ALTER TABLE dishes ADD picture VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE dishes DROP path');
        $this->addSql('ALTER TABLE dishes ALTER name TYPE VARCHAR(100)');
        $this->addSql('ALTER TABLE dishes ALTER weight TYPE DOUBLE PRECISION');
        $this->addSql('ALTER TABLE dishes ALTER weight DROP DEFAULT');
        $this->addSql('ALTER TABLE dishes RENAME COLUMN amount TO price');
    }
}
