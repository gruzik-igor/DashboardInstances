<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180619122241 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE instance (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instance_resource (id INT AUTO_INCREMENT NOT NULL, instance_id INT DEFAULT NULL, resource_id INT DEFAULT NULL, INDEX IDX_BE3BF3D13A51721D (instance_id), INDEX IDX_BE3BF3D189329D25 (resource_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice (id INT AUTO_INCREMENT NOT NULL, instance_id INT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, creation_date DATETIME DEFAULT NULL, status VARCHAR(255) NOT NULL, expiration_date DATE DEFAULT NULL, INDEX IDX_906517443A51721D (instance_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE license (id INT AUTO_INCREMENT NOT NULL, instance_id INT DEFAULT NULL, issued INT DEFAULT NULL, `usage` INT NOT NULL, rate INT DEFAULT NULL, INDEX IDX_5768F4193A51721D (instance_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resource (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) DEFAULT NULL, default_value VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE instance_resource ADD CONSTRAINT FK_BE3BF3D13A51721D FOREIGN KEY (instance_id) REFERENCES instance (id)');
        $this->addSql('ALTER TABLE instance_resource ADD CONSTRAINT FK_BE3BF3D189329D25 FOREIGN KEY (resource_id) REFERENCES resource (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_906517443A51721D FOREIGN KEY (instance_id) REFERENCES instance (id)');
        $this->addSql('ALTER TABLE license ADD CONSTRAINT FK_5768F4193A51721D FOREIGN KEY (instance_id) REFERENCES instance (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE instance_resource DROP FOREIGN KEY FK_BE3BF3D13A51721D');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_906517443A51721D');
        $this->addSql('ALTER TABLE license DROP FOREIGN KEY FK_5768F4193A51721D');
        $this->addSql('ALTER TABLE instance_resource DROP FOREIGN KEY FK_BE3BF3D189329D25');
        $this->addSql('DROP TABLE instance');
        $this->addSql('DROP TABLE instance_resource');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('DROP TABLE license');
        $this->addSql('DROP TABLE resource');
    }
}
