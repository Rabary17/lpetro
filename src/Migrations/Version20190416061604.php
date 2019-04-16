<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190416061604 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE language ADD speakinglevel INT DEFAULT NULL, ADD writinglevel INT DEFAULT NULL');
        $this->addSql('ALTER TABLE skill CHANGE id id VARCHAR(36) NOT NULL');
        $this->addSql('ALTER TABLE user_skill CHANGE skill_id skill_id VARCHAR(36) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE language DROP speakinglevel, DROP writinglevel');
        $this->addSql('ALTER TABLE skill CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE user_skill CHANGE skill_id skill_id INT DEFAULT NULL');
    }
}
