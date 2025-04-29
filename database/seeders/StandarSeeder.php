<?php

namespace Database\Seeders;

use App\Models\StandarChargingPump;
use App\Models\StandarMainPump;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StandarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StandarMainPump::create([
            'id_standar_main_pump' => '1',
            'user_id' => 2,
            'rpm' => 5,
            'flow_rate' => 5,
            'suction' => 5,
            'discharge' => 5,
            'produk_pemompaan' => 5,
            'de_motor_v' => 5,
            'de_motor_h' => 5,
            'de_motor_a' => 5,
            'de_motor_temperatur_casing' => 5,
            'nde_motor_v' => 5,
            'nde_motor_h' => 5,
            'nde_motor_a' => 5,
            'nde_motor_temperatur_casing' => 5,
            'in_gearbox_de_v' => 5,
            'in_gearbox_de_h' => 5,
            'in_gearbox_de_a' => 5,
            'in_gearbox_de_temperatur_casing' => 5,
            'in_gearbox_nde_v' => 5,
            'in_gearbox_nde_h' => 5,
            'in_gearbox_nde_a' => 5,
            'in_gearbox_nde_temperatur_casing' => 5,
            'out_gearbox_de_v' => 5,
            'out_gearbox_de_h' => 5,
            'out_gearbox_de_a' => 5,
            'out_gearbox_de_temperatur_casing' => 5,
            'out_gearbox_nde_v' => 5,
            'out_gearbox_nde_h' => 5,
            'out_gearbox_nde_a' => 5,
            'out_gearbox_nde_temperatur_casing' => 5,
            'de_pump_v' => 5,
            'de_pump_h' => 5,
            'de_pump_a' => 5,
            'de_pump_temperatur_casing' => 5,
            'nde_pump_v' => 5,
            'nde_pump_h' => 5,
            'nde_pump_a' => 5,
            'nde_pump_temperatur_casing' => 5,
            'thurstbearing_v' => 5,
            'thurstbearing_h' => 5,
            'thurstbearing_a' => 5,
            'thurstbearing_temperatur_casing' => 5,
            'temperatur_cassing' => 5,
        ]);

        StandarChargingPump::create([
            'id_standar_charging_pump' => '1',
            'user_id' => 2,
            'flow_rate' => 5,
            'suction' => 5,
            'discharge' => 5,
            'de_motor_v' => 5,
            'de_motor_h' => 5,
            'de_motor_a' => 5,
            'nde_motor_v' => 5,
            'nde_motor_h' => 5,
            'nde_motor_a' => 5,
            'de_pump_v' => 5,
            'de_pump_h' => 5,
            'de_pump_a' => 5,
            'nde_pump_v' => 5,
            'nde_pump_h' => 5,
            'nde_pump_a' => 5,
            'temp_casing_pump' => 5,
            'temp_mech_seal' => 5,
            'temp_bearing_pump_de' => 5,
            'temp_bearing_pump_nde' => 5,
            'temp_bearing_motor_de' => 5,
            'temp_bearing_motor_nde' => 5,
            'produk_pemompaan' => 5,
        ]);
    }
}