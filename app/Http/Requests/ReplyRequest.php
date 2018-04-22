<?php

namespace App\Http\Requests;

class ReplyRequest extends Request
{
    public function rules()
    {
        return [
            'reply_content' => 'required|min:2',
        ];
    }

    public function messages()
    {
        return [
            'reply_content.required' => '回复内容必填',
            'reply_content.min' => '回复内容至少为2字符',
        ];
    }
}
