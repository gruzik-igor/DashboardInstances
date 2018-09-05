<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180905155831 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE invoice CHANGE status status ENUM(\'pending\', \'paied\', \'active\') DEFAULT NULL COMMENT \'(DC2Type:enum_invoice_status_type)\'');
        $this->addSql('ALTER TABLE instance ADD user_id INT DEFAULT NULL, DROP user_ma, CHANGE status status ENUM(\'active\', \'suspended\') DEFAULT NULL COMMENT \'(DC2Type:enum_instance_status_type)\', CHANGE deploying_status deploying_status ENUM(\'deployed\', \'pending\', \'deploying\') DEFAULT NULL COMMENT \'(DC2Type:enum_instance_deploying_status_type)\', CHANGE domain domain_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE instance ADD CONSTRAINT FK_4230B1DEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_4230B1DEA76ED395 ON instance (user_id)');
        $this->addSql('ALTER TABLE user DROP domain_name');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE instance DROP FOREIGN KEY FK_4230B1DEA76ED395');
        $this->addSql('DROP INDEX IDX_4230B1DEA76ED395 ON instance');
        $this->addSql('ALTER TABLE instance ADD user_ma INT NOT NULL, DROP user_id, CHANGE status status VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE deploying_status deploying_status VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE domain_name domain VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE invoice CHANGE status status VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE user ADD domain_name VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci');
    }
}
