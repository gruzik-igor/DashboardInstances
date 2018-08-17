<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180817125024 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE groups (id INT AUTO_INCREMENT NOT NULL, level INT NOT NULL, title VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE instance ADD contact_person VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE license CHANGE used instance_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE license ADD CONSTRAINT FK_5768F4193A51721D FOREIGN KEY (instance_id) REFERENCES instance (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5768F4193A51721D ON license (instance_id)');
        $this->addSql('ALTER TABLE user ADD `group` INT DEFAULT 1, DROP role, DROP salt, DROP listings, DROP reviews, DROP seo_rank, DROP messages, DROP instagram');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE groups');
        $this->addSql('ALTER TABLE instance DROP contact_person');
        $this->addSql('ALTER TABLE license DROP FOREIGN KEY FK_5768F4193A51721D');
        $this->addSql('DROP INDEX UNIQ_5768F4193A51721D ON license');
        $this->addSql('ALTER TABLE license CHANGE instance_id used INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD role VARCHAR(255) DEFAULT \'ROLE_SUPER_ADMIN\' COLLATE utf8_unicode_ci, ADD salt VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, ADD listings SMALLINT DEFAULT NULL, ADD reviews SMALLINT DEFAULT NULL, ADD seo_rank SMALLINT DEFAULT NULL, ADD messages SMALLINT DEFAULT NULL, ADD instagram SMALLINT DEFAULT NULL, DROP `group`');
    }
}
