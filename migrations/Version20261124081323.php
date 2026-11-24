<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261124081323 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Initial schema for Gigamemo: decks, cards, and images';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE card (id INT AUTO_INCREMENT NOT NULL, count_learning INT NOT NULL, count_reduce INT NOT NULL, count_maintain INT NOT NULL, count_extend INT NOT NULL, easy_factor DOUBLE PRECISION NOT NULL, `interval` INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, next_display_date DATETIME NOT NULL, position INT DEFAULT NULL, question LONGTEXT DEFAULT NULL, answer LONGTEXT DEFAULT NULL, answer_template LONGTEXT DEFAULT NULL, deck_id INT NOT NULL, INDEX IDX_161498D3111948DC (deck_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE deck (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(70) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, position INT DEFAULT NULL, deck_parent_id INT DEFAULT NULL, INDEX IDX_4FAC3637A743BC27 (deck_parent_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, question_card_id INT DEFAULT NULL, answer_card_id INT DEFAULT NULL, INDEX IDX_C53D045F44104F3D (question_card_id), INDEX IDX_C53D045F28C5551 (answer_card_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id))');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3111948DC FOREIGN KEY (deck_id) REFERENCES deck (id)');
        $this->addSql('ALTER TABLE deck ADD CONSTRAINT FK_4FAC3637A743BC27 FOREIGN KEY (deck_parent_id) REFERENCES deck (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F44104F3D FOREIGN KEY (question_card_id) REFERENCES card (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F28C5551 FOREIGN KEY (answer_card_id) REFERENCES card (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D3111948DC');
        $this->addSql('ALTER TABLE deck DROP FOREIGN KEY FK_4FAC3637A743BC27');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F44104F3D');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F28C5551');
        $this->addSql('DROP TABLE card');
        $this->addSql('DROP TABLE deck');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
