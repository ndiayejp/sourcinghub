<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TenderRequest extends FormRequest
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
     * 
     */
    public function rules(){
        
       return [
            'tender_date' => 'required|date',
            'name' => 'required|max:255',
            'body' => 'required',
            'product_name.*' => 'required|max:255',
            'product_unit.*' => 'required|min:1',
            'product_qte.*' => 'required|integer',
            'product_body.*' => 'required'
       ]
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'tender_date' => 'choississez une date valide',
            'name' => 'un titre est nécessaire',
            'body' => 'le contenu est obligatoire',
            'product_name.*' => 'un nom pour le produit',
        ];
    }
}
