<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210303105057 extends AbstractMigration
{

    public function up(Schema $schema) : void
    {
        $bundlesName = [
            '000_localization',
            '001_dbdata',
            '051_buildings',
            '052_buffs',
            '053_flights',
            '054_other_items',
            '055_fuel',
            '056_passengers',
            '057_barriers',
            '058_flight_cards',
            '059_boxes',
            '060_space_items',
            '061_currencies',
            '062_clan_flags',
            '063_icons',
            '064_window_art',
            '065_characters',
            '066_aircrafts',
            '067_start_pack',
            '068_quests',
            '069_quest_icons',
            '070_task_icons',
            '071_bank',
            '072_condition_flights',
            '073_event_science_granite',
            '074_mini_game_sounds',
            '075_event_wildlife_world',
            '076_event_cinemania',
            '077_plane3dart',
            '078_event_dark_skies',
            '079_event_airport_city',
            '080_event_thanksgiving_day',
            '081_event_holidayrush',
            '082_event_holiday_fuss',
            '083_events_arts',
            '084_art_hq_lq'
        ];

        foreach ($bundlesName as $name)
        {
            $this->addSql("INSERT INTO bundle (`name`, critical_data, is_local, is_low_definition, version) VALUES ('$name', 0, 0, 0, 0)");
        }
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('TRUNCATE TABLE bundle');
    }
}
