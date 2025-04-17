<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestSoldier extends FormRequest
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
        $soldierId = $this->route('soldier'); // ID من الباث
    
        return [
            'name' => 'required|string|max:255',
            'police_number' => 'required|string|max:50|unique:soldiers,police_number,' . $soldierId,
            'national_id' => 'required|string|unique:soldiers,national_id,' . $soldierId,
            'date_of_conscription' => 'required|date',
            'discharge_from_conscription' => 'required|date|after_or_equal:date_of_conscription',
            'governorate' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'medical_condition' => 'nullable|string|max:255',
             'notes' => 'nullable|string',
            'start_date' => 'nullable|date',
            'job_id'=>'required',
            'regiment_id' => 'required|exists:regiments,id',
            'batch_id' => 'required|exists:batches,id',
            'authority_id' => 'required|exists:authorities,id',
            'image' => 'nullable|image', // خليه nullable بدل required في حالة التحديث
        ];
    }
    
    /**
     * تحديد رسائل التحقق المخصصة.
     *
     * @return array
     */
    public function messages()
    {
        return [
    
            
            'police_number.required' => 'رقم الشرطة مطلوب.',
            'name.required' => 'اسم الضابط مطلوب.',
            'national_id.required' => 'الرقم القومي مطلوب.',
            'date_of_conscription.required' => 'تاريخ التجنيد مطلوب.',
            'governorate.required' => 'المحافظة مطلوبة.',
            'discharge_from_conscription.required' => 'مطلوب الاعفاء من التجنيد  ' ,
             'phone_number.required' => ' مطلوب ؤقم الهاتف', 
            'medical_condition.required' => ' مطلوب الحاله الطبيه',
            'job_id.required' => ' مطلوب الوظيفه',
            'start_date.required' => 'تاريخ بدايه العمل مطلوب ',  // إذا كان الجندي في حالة خاصة
            'regiment_id.required' => 'اسم السره  مطلوب',  // إذا كان الجندي في حالة خاصة
            'batch_id.required' => ' مطلوب الدفعه',
            'authority_id.required' => ' مطلوب اسم الجهة',
        ];
    }
}
