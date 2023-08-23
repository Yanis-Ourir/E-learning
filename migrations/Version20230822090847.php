<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230822090847 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profil DROP FOREIGN KEY FK_E6D6B297B3AB48EB');
        $this->addSql('ALTER TABLE profil ADD CONSTRAINT FK_E6D6B297B3AB48EB FOREIGN KEY (to_do_list_id) REFERENCES to_do_list (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profil DROP FOREIGN KEY FK_E6D6B297B3AB48EB');
        $this->addSql('ALTER TABLE profil ADD CONSTRAINT FK_E6D6B297B3AB48EB FOREIGN KEY (to_do_list_id) REFERENCES to_do_list (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
