<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230901130303 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE profil_achievement (profil_id INT NOT NULL, achievement_id INT NOT NULL, INDEX IDX_CC4D66B1275ED078 (profil_id), INDEX IDX_CC4D66B1B3EC99FE (achievement_id), PRIMARY KEY(profil_id, achievement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE profil_achievement ADD CONSTRAINT FK_CC4D66B1275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profil_achievement ADD CONSTRAINT FK_CC4D66B1B3EC99FE FOREIGN KEY (achievement_id) REFERENCES achievement (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profil_achievement DROP FOREIGN KEY FK_CC4D66B1275ED078');
        $this->addSql('ALTER TABLE profil_achievement DROP FOREIGN KEY FK_CC4D66B1B3EC99FE');
        $this->addSql('DROP TABLE profil_achievement');
    }
}
