<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Input;

class UpdateUserForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ( !Auth::check() )
        {
            return false;
        }

        $theUser = User::find($this->segment(2));
        // 如果是编辑操作, 或者当前用户不是对象创建者
        if ( !$theUser || $theUser->id != Auth::id()) {
            return false;
        }

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
            'password' => 'min:6|confirmed'
        ];
    }


}
