<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180817154557 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, full_name VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(255) DEFAULT \'ROLE_SUPER_ADMIN\', salt VARCHAR(255) DEFAULT NULL, registration_date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE license (id INT AUTO_INCREMENT NOT NULL, instance_id INT DEFAULT NULL, issued INT DEFAULT NULL, rate INT DEFAULT NULL, UNIQUE INDEX UNIQ_5768F4193A51721D (instance_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE license_request (id INT AUTO_INCREMENT NOT NULL, instance_id INT DEFAULT NULL, requested_licenses INT NOT NULL, requestion_date DATETIME DEFAULT NULL, INDEX IDX_D28EC4C43A51721D (instance_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instance_resource (id INT AUTO_INCREMENT NOT NULL, instance_id INT DEFAULT NULL, resource_id INT DEFAULT NULL, value VARCHAR(255) NOT NULL, INDEX IDX_BE3BF3D13A51721D (instance_id), INDEX IDX_BE3BF3D189329D25 (resource_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resource (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) DEFAULT NULL, default_value VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice (id INT AUTO_INCREMENT NOT NULL, instance_id INT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, creation_date DATE DEFAULT NULL, status VARCHAR(255) NOT NULL, expiration_date DATE DEFAULT NULL, UNIQUE INDEX UNIQ_906517443A51721D (instance_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instance (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, contact_person VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, deploying_status VARCHAR(255) NOT NULL, deploying_date DATE DEFAULT NULL, domain VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE license ADD CONSTRAINT FK_5768F4193A51721D FOREIGN KEY (instance_id) REFERENCES instance (id)');
        $this->addSql('ALTER TABLE license_request ADD CONSTRAINT FK_D28EC4C43A51721D FOREIGN KEY (instance_id) REFERENCES instance (id)');
        $this->addSql('ALTER TABLE instance_resource ADD CONSTRAINT FK_BE3BF3D13A51721D FOREIGN KEY (instance_id) REFERENCES instance (id)');
        $this->addSql('ALTER TABLE instance_resource ADD CONSTRAINT FK_BE3BF3D189329D25 FOREIGN KEY (resource_id) REFERENCES resource (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_906517443A51721D FOREIGN KEY (instance_id) REFERENCES instance (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE instance_resource DROP FOREIGN KEY FK_BE3BF3D189329D25');
        $this->addSql('ALTER TABLE license DROP FOREIGN KEY FK_5768F4193A51721D');
        $this->addSql('ALTER TABLE license_request DROP FOREIGN KEY FK_D28EC4C43A51721D');
        $this->addSql('ALTER TABLE instance_resource DROP FOREIGN KEY FK_BE3BF3D13A51721D');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_906517443A51721D');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE license');
        $this->addSql('DROP TABLE license_request');
        $this->addSql('DROP TABLE instance_resource');
        $this->addSql('DROP TABLE resource');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('DROP TABLE instance');
    }
}
