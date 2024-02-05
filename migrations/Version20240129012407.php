<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240129012407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE matriculas (id INT AUTO_INCREMENT NOT NULL, aluno_id INT DEFAULT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, status INT NOT NULL, INDEX IDX_86C967BCB2DDF7F4 (aluno_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE matriculas ADD CONSTRAINT FK_86C967BCB2DDF7F4 FOREIGN KEY (aluno_id) REFERENCES alunos (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matriculas DROP FOREIGN KEY FK_86C967BCB2DDF7F4');
        $this->addSql('DROP TABLE matriculas');
    }
}
