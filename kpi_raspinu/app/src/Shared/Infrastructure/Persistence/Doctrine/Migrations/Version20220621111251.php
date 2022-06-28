<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220621111251 extends AbstractMigration
{


    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE record (
                                id VARCHAR(255) NOT NULL, 
                                name VARCHAR(255) NOT NULL, 
                                PRIMARY KEY(id)) 
                                DEFAULT CHARACTER 
                                SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
    }

}
