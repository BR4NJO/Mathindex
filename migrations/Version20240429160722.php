<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240429160722 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercise ADD course_id INT NOT NULL, CHANGE proposed_by_type proposed_by_type VARCHAR(255) DEFAULT NULL, CHANGE proposed_by_first_name proposed_by_first_name VARCHAR(255) DEFAULT NULL, CHANGE proposed_by_last_name proposed_by_last_name VARCHAR(255) DEFAULT NULL, CHANGE source_name source_name VARCHAR(255) DEFAULT NULL, CHANGE source_information source_information VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE exercise ADD CONSTRAINT FK_AEDAD51C591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('CREATE INDEX IDX_AEDAD51C591CC992 ON exercise (course_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercise DROP FOREIGN KEY FK_AEDAD51C591CC992');
        $this->addSql('DROP INDEX IDX_AEDAD51C591CC992 ON exercise');
        $this->addSql('ALTER TABLE exercise DROP course_id, CHANGE proposed_by_type proposed_by_type VARCHAR(255) NOT NULL, CHANGE proposed_by_first_name proposed_by_first_name VARCHAR(255) NOT NULL, CHANGE proposed_by_last_name proposed_by_last_name VARCHAR(255) NOT NULL, CHANGE source_name source_name VARCHAR(255) NOT NULL, CHANGE source_information source_information VARCHAR(255) NOT NULL');
    }
}
