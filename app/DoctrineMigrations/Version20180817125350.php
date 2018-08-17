<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180817125350 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE instance DROP FOREIGN KEY FK_4230B1DE460F904B');
        $this->addSql('DROP INDEX UNIQ_4230B1DE460F904B ON instance');
        $this->addSql('ALTER TABLE instance DROP license_id');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE instance ADD license_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE instance ADD CONSTRAINT FK_4230B1DE460F904B FOREIGN KEY (license_id) REFERENCES license (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4230B1DE460F904B ON instance (license_id)');
    }
}
