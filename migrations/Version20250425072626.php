<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250425072626 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bookings (id SERIAL NOT NULL, user_id INT DEFAULT NULL, hotel_id INT DEFAULT NULL, room_type_id INT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, date_from DATE NOT NULL, date_to DATE NOT NULL, status VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7A853C35A76ED395 ON bookings (user_id)');
        $this->addSql('CREATE INDEX IDX_7A853C353243BB18 ON bookings (hotel_id)');
        $this->addSql('CREATE INDEX IDX_7A853C35296E3073 ON bookings (room_type_id)');
        $this->addSql('COMMENT ON COLUMN bookings.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE hotel (id SERIAL NOT NULL, owner_id INT NOT NULL, name VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, description TEXT NOT NULL, lat DOUBLE PRECISION NOT NULL, lng DOUBLE PRECISION NOT NULL, stars INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3535ED97E3C61F9 ON hotel (owner_id)');
        $this->addSql('CREATE TABLE image (id SERIAL NOT NULL, hotel_id INT DEFAULT NULL, room_type_id INT DEFAULT NULL, url VARCHAR(255) NOT NULL, alt_text VARCHAR(255) NOT NULL, is_main BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C53D045F3243BB18 ON image (hotel_id)');
        $this->addSql('CREATE INDEX IDX_C53D045F296E3073 ON image (room_type_id)');
        $this->addSql('CREATE TABLE negotiations (id SERIAL NOT NULL, user_id INT DEFAULT NULL, hotel_id INT DEFAULT NULL, room_type_id INT DEFAULT NULL, proposed_price DOUBLE PRECISION NOT NULL, counter_offer DOUBLE PRECISION DEFAULT NULL, status VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E5CD4CE8A76ED395 ON negotiations (user_id)');
        $this->addSql('CREATE INDEX IDX_E5CD4CE83243BB18 ON negotiations (hotel_id)');
        $this->addSql('CREATE INDEX IDX_E5CD4CE8296E3073 ON negotiations (room_type_id)');
        $this->addSql('COMMENT ON COLUMN negotiations.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE room_category (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE room_type (id SERIAL NOT NULL, hotel_id INT DEFAULT NULL, category_id INT DEFAULT NULL, description TEXT NOT NULL, capacity INT NOT NULL, price DOUBLE PRECISION NOT NULL, surface DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EFDABD4D3243BB18 ON room_type (hotel_id)');
        $this->addSql('CREATE INDEX IDX_EFDABD4D12469DE2 ON room_type (category_id)');
        $this->addSql('CREATE TABLE swipes (id SERIAL NOT NULL, user_id INT DEFAULT NULL, action VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B4DF8DAEA76ED395 ON swipes (user_id)');
        $this->addSql('COMMENT ON COLUMN swipes.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE "user" (id SERIAL NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, level VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('ALTER TABLE bookings ADD CONSTRAINT FK_7A853C35A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE bookings ADD CONSTRAINT FK_7A853C353243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE bookings ADD CONSTRAINT FK_7A853C35296E3073 FOREIGN KEY (room_type_id) REFERENCES room_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE hotel ADD CONSTRAINT FK_3535ED97E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F3243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F296E3073 FOREIGN KEY (room_type_id) REFERENCES room_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE negotiations ADD CONSTRAINT FK_E5CD4CE8A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE negotiations ADD CONSTRAINT FK_E5CD4CE83243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE negotiations ADD CONSTRAINT FK_E5CD4CE8296E3073 FOREIGN KEY (room_type_id) REFERENCES room_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE room_type ADD CONSTRAINT FK_EFDABD4D3243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE room_type ADD CONSTRAINT FK_EFDABD4D12469DE2 FOREIGN KEY (category_id) REFERENCES room_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE swipes ADD CONSTRAINT FK_B4DF8DAEA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE bookings DROP CONSTRAINT FK_7A853C35A76ED395');
        $this->addSql('ALTER TABLE bookings DROP CONSTRAINT FK_7A853C353243BB18');
        $this->addSql('ALTER TABLE bookings DROP CONSTRAINT FK_7A853C35296E3073');
        $this->addSql('ALTER TABLE hotel DROP CONSTRAINT FK_3535ED97E3C61F9');
        $this->addSql('ALTER TABLE image DROP CONSTRAINT FK_C53D045F3243BB18');
        $this->addSql('ALTER TABLE image DROP CONSTRAINT FK_C53D045F296E3073');
        $this->addSql('ALTER TABLE negotiations DROP CONSTRAINT FK_E5CD4CE8A76ED395');
        $this->addSql('ALTER TABLE negotiations DROP CONSTRAINT FK_E5CD4CE83243BB18');
        $this->addSql('ALTER TABLE negotiations DROP CONSTRAINT FK_E5CD4CE8296E3073');
        $this->addSql('ALTER TABLE room_type DROP CONSTRAINT FK_EFDABD4D3243BB18');
        $this->addSql('ALTER TABLE room_type DROP CONSTRAINT FK_EFDABD4D12469DE2');
        $this->addSql('ALTER TABLE swipes DROP CONSTRAINT FK_B4DF8DAEA76ED395');
        $this->addSql('DROP TABLE bookings');
        $this->addSql('DROP TABLE hotel');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE negotiations');
        $this->addSql('DROP TABLE room_category');
        $this->addSql('DROP TABLE room_type');
        $this->addSql('DROP TABLE swipes');
        $this->addSql('DROP TABLE "user"');
    }
}
