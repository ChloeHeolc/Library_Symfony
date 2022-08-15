<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220812164448 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book ADD imageone_id INT DEFAULT NULL, ADD image INT NOT NULL');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A33166E7A626 FOREIGN KEY (imageone_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_CBE5A33166E7A626 ON book (imageone_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A33166E7A626');
        $this->addSql('DROP INDEX IDX_CBE5A33166E7A626 ON book');
        $this->addSql('ALTER TABLE book DROP imageone_id, DROP image');
    }
}
