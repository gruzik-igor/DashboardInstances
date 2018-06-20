<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180620121302 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE instance ADD license_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE instance ADD CONSTRAINT FK_4230B1DE460F904B FOREIGN KEY (license_id) REFERENCES license (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4230B1DE460F904B ON instance (license_id)');
        $this->addSql('ALTER TABLE invoice CHANGE creation_date creation_date DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE license DROP FOREIGN KEY FK_5768F4193A51721D');
        $this->addSql('DROP INDEX IDX_5768F4193A51721D ON license');
        $this->addSql('ALTER TABLE license DROP instance_id');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE instance DROP FOREIGN KEY FK_4230B1DE460F904B');
        $this->addSql('DROP INDEX UNIQ_4230B1DE460F904B ON instance');
        $this->addSql('ALTER TABLE instance DROP license_id');
        $this->addSql('ALTER TABLE invoice CHANGE creation_date creation_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE license ADD instance_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE license ADD CONSTRAINT FK_5768F4193A51721D FOREIGN KEY (instance_id) REFERENCES instance (id)');
        $this->addSql('CREATE INDEX IDX_5768F4193A51721D ON license (instance_id)');
    }
}
