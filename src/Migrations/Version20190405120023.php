<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190405120023 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE interview DROP FOREIGN KEY FK_CF1D3C349D86650F');
        $this->addSql('DROP INDEX IDX_CF1D3C349D86650F ON interview');
        $this->addSql('ALTER TABLE interview ADD interview_date DATE DEFAULT NULL, CHANGE user_id_id user_id VARCHAR(36) DEFAULT NULL');
        $this->addSql('ALTER TABLE interview ADD CONSTRAINT FK_CF1D3C34A76ED395 FOREIGN KEY (user_id) REFERENCES app_user (id)');
        $this->addSql('CREATE INDEX IDX_CF1D3C34A76ED395 ON interview (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE interview DROP FOREIGN KEY FK_CF1D3C34A76ED395');
        $this->addSql('DROP INDEX IDX_CF1D3C34A76ED395 ON interview');
        $this->addSql('ALTER TABLE interview DROP interview_date, CHANGE user_id user_id_id VARCHAR(36) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE interview ADD CONSTRAINT FK_CF1D3C349D86650F FOREIGN KEY (user_id_id) REFERENCES app_user (id)');
        $this->addSql('CREATE INDEX IDX_CF1D3C349D86650F ON interview (user_id_id)');
    }
}
