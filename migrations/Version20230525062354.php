<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230525062354 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE player_team (id INT AUTO_INCREMENT NOT NULL, team_id INT NOT NULL, user_id INT NOT NULL, manager_id INT DEFAULT NULL, INDEX IDX_66FAF62CB842D717 (team_id), UNIQUE INDEX UNIQ_66FAF62C9D86650F (user_id), INDEX IDX_66FAF62C569B5E6D (manager_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE player_team ADD CONSTRAINT FK_66FAF62CB842D717 FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE player_team ADD CONSTRAINT FK_66FAF62C9D86650F FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE player_team ADD CONSTRAINT FK_66FAF62C569B5E6D FOREIGN KEY (manager_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD price DOUBLE PRECISION DEFAULT NULL, DROP u_type_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player_team DROP FOREIGN KEY FK_66FAF62CB842D717');
        $this->addSql('ALTER TABLE player_team DROP FOREIGN KEY FK_66FAF62C9D86650F');
        $this->addSql('ALTER TABLE player_team DROP FOREIGN KEY FK_66FAF62C569B5E6D');
        $this->addSql('DROP TABLE player_team');
        $this->addSql('ALTER TABLE user ADD u_type_id TINYINT(1) NOT NULL, DROP price');
    }
}
