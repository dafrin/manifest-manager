<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210305132201 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {

        $this->addSql('TRUNCATE TABLE bundle');
        $this->addSql('ALTER TABLE bundle CHANGE COLUMN `name` `tech_name` VARCHAR(255)');
        $this->addSql('ALTER TABLE bundle ADD `name` VARCHAR(255)');
        $this->addSql('ALTER TABLE bundle DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE bundle ADD `id` int(10) AUTO_INCREMENT PRIMARY KEY');

        $bundles = '{
          "data": [
            {
              "name": "000_localization",
              "critical_data": "1",
              "is_local": "1",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "001_dbdata",
              "critical_data": "1",
              "is_local": "1",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "051_buildings",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "052_buffs",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "053_flights",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "054_other_items",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "055_fuel",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "056_passengers",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "057_barriers",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "058_flight_cards",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "059_boxes",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "060_space_items",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "061_currencies",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "062_clan_flags",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "063_icons",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "064_window_art",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "065_characters",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "066_aircrafts",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "067_start_pack",
              "critical_data": "1",
              "is_local": "1",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "068_quests",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "069_quest_icons",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "070_task_icons",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "071_bank",
              "critical_data": "1",
              "is_local": "1",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "072_condition_flights",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "073_event_science_granite",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "074_mini_game_sounds",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "075_event_wildlife_world",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "076_event_cinemania",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "077_plane3dart",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "078_event_dark_skies",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "079_event_airport_city",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "080_event_thanksgiving_day",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "081_event_holidayrush",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "082_event_holiday_fuss",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "083_events_arts",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            },
            {
              "name": "084_art_hq_lq",
              "critical_data": "10",
              "is_local": "0",
              "is_low_definition": "0",
              "version": "1000"
            }
          ]
        }';
        $bundles = json_decode($bundles, true);
        foreach ($bundles['data'] as $bundle)
        {
            $name = $bundle['name'];
            $techName = $bundle['name'];
            $criticalData = $bundle['critical_data'];
            $isLocal = $bundle['is_local'];
            $isLowDefinition = $bundle['is_low_definition'];
            $version = $bundle['version'];

            $this->addSql("INSERT INTO bundle (`name`, tech_name, critical_data, is_local, is_low_definition, version) VALUES ('$name', '$techName', $criticalData, $isLocal, $isLowDefinition, $version)");

            $name .= '_win';
            $isLocal = 1;
            $this->addSql("INSERT INTO bundle (`name`, tech_name, critical_data, is_local, is_low_definition, version) VALUES ('$name', '$techName', $criticalData, $isLocal, $isLowDefinition, $version)");
        }
    }

    public function down(Schema $schema): void
    {
        $this->addSql('TRUNCATE TABLE bundle');
    }
}
