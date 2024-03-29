<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181221110629 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE zaznam (id INT AUTO_INCREMENT NOT NULL, cislo_danu VARCHAR(255) DEFAULT NULL, n_altis VARCHAR(255) DEFAULT NULL, oddelenie_ziadatela VARCHAR(255) NOT NULL, skuska_v_inom_zavode_text VARCHAR(255) DEFAULT NULL, skuska_v_inom_zavode_select LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', cislo_predchadzajucej_skusky INT DEFAULT NULL, nazov_dotknuteho_dielu VARCHAR(255) DEFAULT NULL, ziadatel_skusky VARCHAR(255) NOT NULL, telefon INT NOT NULL, datum_vyplnenia DATETIME DEFAULT NULL, realizacia_skusky DATETIME DEFAULT NULL, referencia_dielu INT DEFAULT NULL, miesto_spotreby_post VARCHAR(255) DEFAULT NULL, c_danu INT DEFAULT NULL, dodavatel LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', cislo_pracovneho_postupu INT DEFAULT NULL, mnozstvo INT NOT NULL, ucastnici_skusky LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', ingq LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', dovod_skusky VARCHAR(255) DEFAULT NULL, zmena_oproti_seriovemu_stavu VARCHAR(255) DEFAULT NULL, zmena_dielu VARCHAR(255) DEFAULT NULL, zmena_skrutkovania VARCHAR(255) DEFAULT NULL, zmena_procesu VARCHAR(255) DEFAULT NULL, zmena_bezpecnostneho_skrutkovania VARCHAR(255) DEFAULT NULL, zmena_pracovneho_postupu VARCHAR(255) DEFAULT NULL, pozadovany_pocet_aut INT NOT NULL, blokovat_auta_na_kontrolu VARCHAR(255) NOT NULL, pocet_aut_kontrola INT DEFAULT NULL, dotknute_posty_na_montazi VARCHAR(255) DEFAULT NULL, pozadovane_kontroly VARCHAR(255) DEFAULT NULL, skuska_jazda VARCHAR(255) DEFAULT NULL, skuska_iqf VARCHAR(255) DEFAULT NULL, skuska_hluk VARCHAR(255) DEFAULT NULL, skuska_sprcha VARCHAR(255) DEFAULT NULL, skuska_iqa VARCHAR(255) DEFAULT NULL, skuska_ine VARCHAR(255) DEFAULT NULL, modernizacia_po_skuske VARCHAR(255) NOT NULL, retus VARCHAR(255) DEFAULT NULL, motorizacia LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', vozidla LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', pocet_aut_realizovanych INT DEFAULT NULL, fotka VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE zaznam');
    }
}
