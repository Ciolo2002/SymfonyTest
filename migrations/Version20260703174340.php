<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260703174340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE starship ADD captain_id INT NOT NULL');
        $this->addSql('ALTER TABLE starship ADD CONSTRAINT FK_C414E64A3346729B FOREIGN KEY (captain_id) REFERENCES captain (id)');
        $this->addSql('CREATE INDEX IDX_C414E64A3346729B ON starship (captain_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE starship DROP FOREIGN KEY FK_C414E64A3346729B');
        $this->addSql('DROP INDEX IDX_C414E64A3346729B ON starship');
        $this->addSql('ALTER TABLE starship DROP captain_id');
    }
}
