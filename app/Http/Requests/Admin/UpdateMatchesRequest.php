<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMatchesRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            
            'team1_id' => 'required',
            'team2_id' => 'required',
            'start_time' => 'required|date_format:'.config('app.date_format').' H:i:s',
            'result1' => 'max:2147483647|nullable|numeric',
            'result2' => 'max:2147483647|nullable|numeric',
        ];
    }
}
