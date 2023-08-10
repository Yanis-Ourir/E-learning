<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230809141018 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE achievement_list (id INT AUTO_INCREMENT NOT NULL, achievement_name VARCHAR(255) NOT NULL, achievement_icon VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exercice ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE exercice ADD CONSTRAINT FK_E418C74DA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_E418C74DA76ED395 ON exercice (user_id)');
        $this->addSql('ALTER TABLE profil ADD to_do_list_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE profil ADD CONSTRAINT FK_E6D6B297B3AB48EB FOREIGN KEY (to_do_list_id) REFERENCES to_do_list (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E6D6B297B3AB48EB ON profil (to_do_list_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE achievement_list');
        $this->addSql('ALTER TABLE exercice DROP FOREIGN KEY FK_E418C74DA76ED395');
        $this->addSql('DROP INDEX IDX_E418C74DA76ED395 ON exercice');
        $this->addSql('ALTER TABLE exercice DROP user_id');
        $this->addSql('ALTER TABLE profil DROP FOREIGN KEY FK_E6D6B297B3AB48EB');
        $this->addSql('DROP INDEX UNIQ_E6D6B297B3AB48EB ON profil');
        $this->addSql('ALTER TABLE profil DROP to_do_list_id');
    }
}
