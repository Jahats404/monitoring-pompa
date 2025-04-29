<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePemeriksaanChargingPumpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'id_pemeriksaan_main_pump' => 'required|string|unique:pemeriksaan_main_pump,id_pemeriksaan_main_pump',
            // 'tanggal_pemeriksaan' => 'nullable|date',
            // 'user_id' => 'required|exists:users,id',
            'unit_pompa_id' => 'required|exists:unit_pompa,id_unit_pompa',

            // Semua field lainnya nullable (bisa dikosongkan)
            'flow_rate' => 'nullable|string',
            'suction' => 'nullable|string',
            'discharge' => 'nullable|string',

            'de_motor_v' => 'nullable|string',
            'de_motor_h' => 'nullable|string',
            'de_motor_a' => 'nullable|string',

            'nde_motor_v' => 'nullable|string',
            'nde_motor_h' => 'nullable|string',
            'nde_motor_a' => 'nullable|string',

            'de_pump_v' => 'nullable|string',
            'de_pump_h' => 'nullable|string',
            'de_pump_a' => 'nullable|string',

            'nde_pump_v' => 'nullable|string',
            'nde_pump_h' => 'nullable|string',
            'nde_pump_a' => 'nullable|string',

            'temp_casing_pump' => 'nullable|string',
            'temp_mech_seal' => 'nullable|string',
            
            'temp_bearing_pump_de' => 'nullable|string',
            'temp_bearing_pump_nde' => 'nullable|string',
            
            'temp_bearing_motor_de' => 'nullable|string',
            'temp_bearing_motor_nde' => 'nullable|string',

            'produk_pemompaan' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'id_pemeriksaan_main_pump.required' => 'ID pemeriksaan wajib diisi.',
            'id_pemeriksaan_main_pump.unique' => 'ID pemeriksaan sudah digunakan.',
            'user_id.required' => 'User wajib dipilih.',
            'user_id.exists' => 'User tidak ditemukan.',
            'unit_pompa_id.required' => 'Unit pompa wajib dipilih.',
            'unit_pompa_id.exists' => 'Unit pompa tidak valid.',
            'tanggal_pemeriksaan.date' => 'Format tanggal pemeriksaan tidak valid.',
        ];
    }
}