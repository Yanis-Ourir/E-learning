<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230809130248 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE profil (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, pseudo VARCHAR(255) NOT NULL, profil_picture VARCHAR(255) DEFAULT NULL, score INT NOT NULL, UNIQUE INDEX UNIQ_E6D6B29779F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profil_exercice (profil_id INT NOT NULL, exercice_id INT NOT NULL, INDEX IDX_F8F1B2E0275ED078 (profil_id), INDEX IDX_F8F1B2E089D40298 (exercice_id), PRIMARY KEY(profil_id, exercice_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE to_do_list (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE to_do_list_exercice (to_do_list_id INT NOT NULL, exercice_id INT NOT NULL, INDEX IDX_C9D74C65B3AB48EB (to_do_list_id), INDEX IDX_C9D74C6589D40298 (exercice_id), PRIMARY KEY(to_do_list_id, exercice_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE profil ADD CONSTRAINT FK_E6D6B29779F37AE5 FOREIGN KEY (id_user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE profil_exercice ADD CONSTRAINT FK_F8F1B2E0275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profil_exercice ADD CONSTRAINT FK_F8F1B2E089D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE to_do_list_exercice ADD CONSTRAINT FK_C9D74C65B3AB48EB FOREIGN KEY (to_do_list_id) REFERENCES to_do_list (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE to_do_list_exercice ADD CONSTRAINT FK_C9D74C6589D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profil DROP FOREIGN KEY FK_E6D6B29779F37AE5');
        $this->addSql('ALTER TABLE profil_exercice DROP FOREIGN KEY FK_F8F1B2E0275ED078');
        $this->addSql('ALTER TABLE profil_exercice DROP FOREIGN KEY FK_F8F1B2E089D40298');
        $this->addSql('ALTER TABLE to_do_list_exercice DROP FOREIGN KEY FK_C9D74C65B3AB48EB');
        $this->addSql('ALTER TABLE to_do_list_exercice DROP FOREIGN KEY FK_C9D74C6589D40298');
        $this->addSql('DROP TABLE profil');
        $this->addSql('DROP TABLE profil_exercice');
        $this->addSql('DROP TABLE to_do_list');
        $this->addSql('DROP TABLE to_do_list_exercice');
    }
}
