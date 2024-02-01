<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240201105111 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE notifiable (id INT AUTO_INCREMENT NOT NULL, notification_id INT NOT NULL, notifiable_id INT NOT NULL, notifiable_type VARCHAR(255) NOT NULL, INDEX IDX_EF9C43B3EF1A9D84 (notification_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notification (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(10) NOT NULL, sujet VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, action VARCHAR(255) DEFAULT NULL, lu TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE notifiable ADD CONSTRAINT FK_EF9C43B3EF1A9D84 FOREIGN KEY (notification_id) REFERENCES notification (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE notifiable DROP FOREIGN KEY FK_EF9C43B3EF1A9D84');
        $this->addSql('DROP TABLE notifiable');
        $this->addSql('DROP TABLE notification');
    }
}
