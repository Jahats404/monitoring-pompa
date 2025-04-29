<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StandarPemeriksaanChargingPumpRequest extends FormRequest
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
            'flow_rate' => 'required|string',
            'suction' => 'required|string',
            'discharge' => 'required|string',

            'de_motor_v' => 'required|string',
            'de_motor_h' => 'required|string',
            'de_motor_a' => 'required|string',

            'nde_motor_v' => 'required|string',
            'nde_motor_h' => 'required|string',
            'nde_motor_a' => 'required|string',

            'de_pump_v' => 'required|string',
            'de_pump_h' => 'required|string',
            'de_pump_a' => 'required|string',

            'nde_pump_v' => 'required|string',
            'nde_pump_h' => 'required|string',
            'nde_pump_a' => 'required|string',

            'temp_casing_pump' => 'required|string',
            'temp_mech_seal' => 'required|string',
            
            'temp_bearing_pump_de' => 'required|string',
            'temp_bearing_pump_nde' => 'required|string',
            
            'temp_bearing_motor_de' => 'required|string',
            'temp_bearing_motor_nde' => 'required|string',

            'produk_pemompaan' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'flow_rate.required' => 'Flow rate wajib diisi.',
            'suction.required' => 'Suction wajib diisi.',
            'discharge.required' => 'Discharge wajib diisi.',
        
            'de_motor_v.required' => 'Vibrasi DE Motor (vertikal) wajib diisi.',
            'de_motor_h.required' => 'Vibrasi DE Motor (horizontal) wajib diisi.',
            'de_motor_a.required' => 'Vibrasi DE Motor (aksial) wajib diisi.',
        
            'nde_motor_v.required' => 'Vibrasi NDE Motor (vertikal) wajib diisi.',
            'nde_motor_h.required' => 'Vibrasi NDE Motor (horizontal) wajib diisi.',
            'nde_motor_a.required' => 'Vibrasi NDE Motor (aksial) wajib diisi.',
        
            'de_pump_v.required' => 'Vibrasi DE Pump (vertikal) wajib diisi.',
            'de_pump_h.required' => 'Vibrasi DE Pump (horizontal) wajib diisi.',
            'de_pump_a.required' => 'Vibrasi DE Pump (aksial) wajib diisi.',
        
            'nde_pump_v.required' => 'Vibrasi NDE Pump (vertikal) wajib diisi.',
            'nde_pump_h.required' => 'Vibrasi NDE Pump (horizontal) wajib diisi.',
            'nde_pump_a.required' => 'Vibrasi NDE Pump (aksial) wajib diisi.',
        
            'temp_casing_pump.required' => 'Temperatur casing pump wajib diisi.',
            'temp_mech_seal.required' => 'Temperatur mechanical seal wajib diisi.',
        
            'temp_bearing_pump_de.required' => 'Temperatur bearing pump DE wajib diisi.',
            'temp_bearing_pump_nde.required' => 'Temperatur bearing pump NDE wajib diisi.',
        
            'temp_bearing_motor_de.required' => 'Temperatur bearing motor DE wajib diisi.',
            'temp_bearing_motor_nde.required' => 'Temperatur bearing motor NDE wajib diisi.',
        
            'produk_pemompaan.required' => 'Produk pemompaan wajib diisi.',
        ];
    }
}