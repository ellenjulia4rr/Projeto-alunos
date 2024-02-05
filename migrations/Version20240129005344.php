<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240129005344 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Cria uma relação many to many entre os alunos e os cursos';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alunos_cursos (curso_id INT NOT NULL, aluno_id INT NOT NULL, INDEX IDX_C630144187CB4A1F (curso_id), INDEX IDX_C6301441B2DDF7F4 (aluno_id), PRIMARY KEY(curso_id, aluno_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alunos_cursos ADD CONSTRAINT FK_C630144187CB4A1F FOREIGN KEY (curso_id) REFERENCES cursos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE alunos_cursos ADD CONSTRAINT FK_C6301441B2DDF7F4 FOREIGN KEY (aluno_id) REFERENCES alunos (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alunos_cursos DROP FOREIGN KEY FK_C630144187CB4A1F');
        $this->addSql('ALTER TABLE alunos_cursos DROP FOREIGN KEY FK_C6301441B2DDF7F4');
        $this->addSql('DROP TABLE alunos_cursos');
    }
}
