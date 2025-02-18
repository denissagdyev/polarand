<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WhatsappController extends Controller
{
    public function send(Request $request)
    {
        // Валидация данных
        $validator = Validator::make($request->all(), [
            'whatsapp_number' => 'required|regex:/^\+7 \([0-9]{3}\) [0-9]{3}-[0-9]{2}-[0-9]{2}$/',
        ], [
            'whatsapp_number.required' => 'Пожалуйста, введите номер телефона.',
            'whatsapp_number.regex' => 'Неверный формат номера телефона.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $token = '7895279526:AAE-ulYcIKftCB_Q6GeE_2W4wduCNZslpf4'; // Замените на токен своего бота
        $chat_id = '372052688'; // Замените на ID своего чата
        $phone = $request->input('whatsapp_number');

        $text = "Новый запрос:\nТелефон: $phone";

        $client = new Client();
        $response = $client->post("https://api.telegram.org/bot{$token}/sendMessage", [
            'form_params' => [
                'chat_id' => $chat_id,
                'text' => $text,
            ]
        ]);

        return redirect()->back()->with('success', 'Сообщение успешно отправлено!');
    }
}