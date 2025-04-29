<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePemeriksaanMainPumpRequest extends FormRequest
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
            'rpm' => 'nullable|string',
            'flow_rate' => 'nullable|string',
            'suction' => 'nullable|string',
            'discharge' => 'nullable|string',
            'produk_pemompaan' => 'nullable|string',

            'de_motor_v' => 'nullable|string',
            'de_motor_h' => 'nullable|string',
            'de_motor_a' => 'nullable|string',
            'de_motor_temperatur_casing' => 'nullable|string',

            'nde_motor_v' => 'nullable|string',
            'nde_motor_h' => 'nullable|string',
            'nde_motor_a' => 'nullable|string',
            'nde_motor_temperatur_casing' => 'nullable|string',

            'in_gearbox_de_v' => 'nullable|string',
            'in_gearbox_de_h' => 'nullable|string',
            'in_gearbox_de_a' => 'nullable|string',
            'in_gearbox_de_temperatur_casing' => 'nullable|string',

            'in_gearbox_nde_v' => 'nullable|string',
            'in_gearbox_nde_h' => 'nullable|string',
            'in_gearbox_nde_a' => 'nullable|string',
            'in_gearbox_nde_temperatur_casing' => 'nullable|string',

            'out_gearbox_de_v' => 'nullable|string',
            'out_gearbox_de_h' => 'nullable|string',
            'out_gearbox_de_a' => 'nullable|string',
            'out_gearbox_de_temperatur_casing' => 'nullable|string',

            'out_gearbox_nde_v' => 'nullable|string',
            'out_gearbox_nde_h' => 'nullable|string',
            'out_gearbox_nde_a' => 'nullable|string',
            'out_gearbox_nde_temperatur_casing' => 'nullable|string',

            'de_pump_v' => 'nullable|string',
            'de_pump_h' => 'nullable|string',
            'de_pump_a' => 'nullable|string',
            'de_pump_temperatur_casing' => 'nullable|string',

            'nde_pump_v' => 'nullable|string',
            'nde_pump_h' => 'nullable|string',
            'nde_pump_a' => 'nullable|string',
            'nde_pump_temperatur_casing' => 'nullable|string',

            'thurstbearing_v' => 'nullable|string',
            'thurstbearing_h' => 'nullable|string',
            'thurstbearing_a' => 'nullable|string',
            'thurstbearing_temperatur_casing' => 'nullable|string',
            'temperatur_cassing' => 'nullable|string',
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