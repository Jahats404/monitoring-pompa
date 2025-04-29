<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StandarPemeriksaanMainPumpRequest extends FormRequest
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
            'rpm' => 'required|string',
            'flow_rate' => 'required|string',
            'suction' => 'required|string',
            'discharge' => 'required|string',
            'produk_pemompaan' => 'required|string',

            'de_motor_v' => 'required|string',
            'de_motor_h' => 'required|string',
            'de_motor_a' => 'required|string',
            'de_motor_temperatur_casing' => 'required|string',

            'nde_motor_v' => 'required|string',
            'nde_motor_h' => 'required|string',
            'nde_motor_a' => 'required|string',
            'nde_motor_temperatur_casing' => 'required|string',

            'in_gearbox_de_v' => 'required|string',
            'in_gearbox_de_h' => 'required|string',
            'in_gearbox_de_a' => 'required|string',
            'in_gearbox_de_temperatur_casing' => 'required|string',

            'in_gearbox_nde_v' => 'required|string',
            'in_gearbox_nde_h' => 'required|string',
            'in_gearbox_nde_a' => 'required|string',
            'in_gearbox_nde_temperatur_casing' => 'required|string',

            'out_gearbox_de_v' => 'required|string',
            'out_gearbox_de_h' => 'required|string',
            'out_gearbox_de_a' => 'required|string',
            'out_gearbox_de_temperatur_casing' => 'required|string',

            'out_gearbox_nde_v' => 'required|string',
            'out_gearbox_nde_h' => 'required|string',
            'out_gearbox_nde_a' => 'required|string',
            'out_gearbox_nde_temperatur_casing' => 'required|string',

            'de_pump_v' => 'required|string',
            'de_pump_h' => 'required|string',
            'de_pump_a' => 'required|string',
            'de_pump_temperatur_casing' => 'required|string',

            'nde_pump_v' => 'required|string',
            'nde_pump_h' => 'required|string',
            'nde_pump_a' => 'required|string',
            'nde_pump_temperatur_casing' => 'required|string',

            'thurstbearing_v' => 'required|string',
            'thurstbearing_h' => 'required|string',
            'thurstbearing_a' => 'required|string',
            'thurstbearing_temperatur_casing' => 'required|string',
            'temperatur_cassing' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'rpm.required' => 'RPM harus diisi.',
            'flow_rate.required' => 'Flow Rate harus diisi.',
            'suction.required' => 'Suction harus diisi.',
            'discharge.required' => 'Discharge harus diisi.',
            'produk_pemompaan.required' => 'Produk Pemompaan harus diisi.',
        
            'de_motor_v.required' => 'DE Motor (V) harus diisi.',
            'de_motor_h.required' => 'DE Motor (H) harus diisi.',
            'de_motor_a.required' => 'DE Motor (A) harus diisi.',
            'de_motor_temperatur_casing.required' => 'Temperatur Casing DE Motor harus diisi.',
        
            'nde_motor_v.required' => 'NDE Motor (V) harus diisi.',
            'nde_motor_h.required' => 'NDE Motor (H) harus diisi.',
            'nde_motor_a.required' => 'NDE Motor (A) harus diisi.',
            'nde_motor_temperatur_casing.required' => 'Temperatur Casing NDE Motor harus diisi.',
        
            'in_gearbox_de_v.required' => 'In Gearbox DE (V) harus diisi.',
            'in_gearbox_de_h.required' => 'In Gearbox DE (H) harus diisi.',
            'in_gearbox_de_a.required' => 'In Gearbox DE (A) harus diisi.',
            'in_gearbox_de_temperatur_casing.required' => 'Temperatur Casing In Gearbox DE harus diisi.',
        
            'in_gearbox_nde_v.required' => 'In Gearbox NDE (V) harus diisi.',
            'in_gearbox_nde_h.required' => 'In Gearbox NDE (H) harus diisi.',
            'in_gearbox_nde_a.required' => 'In Gearbox NDE (A) harus diisi.',
            'in_gearbox_nde_temperatur_casing.required' => 'Temperatur Casing In Gearbox NDE harus diisi.',
        
            'out_gearbox_de_v.required' => 'Out Gearbox DE (V) harus diisi.',
            'out_gearbox_de_h.required' => 'Out Gearbox DE (H) harus diisi.',
            'out_gearbox_de_a.required' => 'Out Gearbox DE (A) harus diisi.',
            'out_gearbox_de_temperatur_casing.required' => 'Temperatur Casing Out Gearbox DE harus diisi.',
        
            'out_gearbox_nde_v.required' => 'Out Gearbox NDE (V) harus diisi.',
            'out_gearbox_nde_h.required' => 'Out Gearbox NDE (H) harus diisi.',
            'out_gearbox_nde_a.required' => 'Out Gearbox NDE (A) harus diisi.',
            'out_gearbox_nde_temperatur_casing.required' => 'Temperatur Casing Out Gearbox NDE harus diisi.',
        
            'de_pump_v.required' => 'DE Pump (V) harus diisi.',
            'de_pump_h.required' => 'DE Pump (H) harus diisi.',
            'de_pump_a.required' => 'DE Pump (A) harus diisi.',
            'de_pump_temperatur_casing.required' => 'Temperatur Casing DE Pump harus diisi.',
        
            'nde_pump_v.required' => 'NDE Pump (V) harus diisi.',
            'nde_pump_h.required' => 'NDE Pump (H) harus diisi.',
            'nde_pump_a.required' => 'NDE Pump (A) harus diisi.',
            'nde_pump_temperatur_casing.required' => 'Temperatur Casing NDE Pump harus diisi.',
        
            'thurstbearing_v.required' => 'Thurst Bearing (V) harus diisi.',
            'thurstbearing_h.required' => 'Thurst Bearing (H) harus diisi.',
            'thurstbearing_a.required' => 'Thurst Bearing (A) harus diisi.',
            'thurstbearing_temperatur_casing.required' => 'Temperatur Casing Thurst Bearing harus diisi.',
            
            'temperatur_cassing.required' => 'Temperatur Cassing harus diisi.',
        ];
    }
}