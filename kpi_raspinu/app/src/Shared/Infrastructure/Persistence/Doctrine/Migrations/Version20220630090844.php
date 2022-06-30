<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220630090844 extends AbstractMigration
{


    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `record` 
                            ADD  artist_id VARCHAR(255) NOT NULL');
       $this->addSql('ALTER TABLE `record` 
                            ADD CONSTRAINT fk_artist_id
                                FOREIGN KEY (`artist_id`) 
                                    REFERENCES `artist` (`id`);
                    ');

    }


}
