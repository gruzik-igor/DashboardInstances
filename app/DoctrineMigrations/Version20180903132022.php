<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180903132022 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE instance ADD user_ma INT NOT NULL, DROP contact_person');
        $this->addSql('ALTER TABLE user ADD company_logo VARCHAR(255) DEFAULT NULL, ADD domain_name VARCHAR(255) DEFAULT NULL, ADD contact_phone VARCHAR(255) DEFAULT NULL, ADD primary_language VARCHAR(255) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE instance ADD contact_person VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, DROP user_ma');
        $this->addSql('ALTER TABLE user DROP company_logo, DROP domain_name, DROP contact_phone, DROP primary_language');
    }
}
