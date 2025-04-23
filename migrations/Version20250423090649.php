<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250423090649 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE hotel (id SERIAL NOT NULL, owner_id INT NOT NULL, name VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, price_base DOUBLE PRECISION NOT NULL, min_price DOUBLE PRECISION NOT NULL, description TEXT NOT NULL, lat DOUBLE PRECISION NOT NULL, lng DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3535ED97E3C61F9 ON hotel (owner_id)');
        $this->addSql('ALTER TABLE hotel ADD CONSTRAINT FK_3535ED97E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE hotel DROP CONSTRAINT FK_3535ED97E3C61F9');
        $this->addSql('DROP TABLE hotel');
    }
}
