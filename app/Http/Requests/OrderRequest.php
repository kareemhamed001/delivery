<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {


        $now=Carbon::today()->addDays(3);
        return [
            'orderName'=>['required','string','max:100'],
            'orderDescription'=>['required','string','max:255'],
            'fromAddress'=>['required','string','max:255'],
            'toAddress'=>['required','string','max:255'],
            'date'=>['required','date','after:yesterday'],
            'time'=>['required','date_format:H:i'],
            'notes'=>['nullable','max:1000'],
        ];
    }
}
