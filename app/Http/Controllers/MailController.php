<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MailController extends Controller
{
    public function sendMail(Request $request)
    {
        // $key = 'form_submitted_' . $request->session()->token();
        // Session::forget($key);
        // dd('dss');
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'regex:/^[А-ЯЁа-яё\s]+$/u'],
            'phone' => ['required', 'regex:/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/'],
            'email' => ['required', 'email'],
            'text' => ['required'],
        ], [
            'name.required' => '*Заполните это поле',
            'name.regex' => '*Используйте русские буквы при указании имени',
            'phone.required' => '*Заполните это поле',
            'phone.regex' => '*Укажите корректный номер телефона',
            'email.required' => '*Заполните это поле',
            'email.email' => '*Укажите корректный email адрес',
            'text.required' => '*Заполните это поле',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 422);
        }

        // Проверка CSRF-токена
        if ($request->session()->token() !== $request->_token) {
            abort(419, 'Page Expired');
        }

        // Проверка защиты от повторной отправки формы
        $formKey = 'form_submitted_' . $request->session()->token();
        if (Cache::has($formKey)) {
            return response()->json('Подождите некоторое время, чтобы направить новое обращение', 429);
        }


        try {
            // Обработка формы и отправка письма
            Mail::send('emails.contactForm', ['name' => $request->name, 'phone' => $request->phone, 'email' => $request->email, 'text' => $request->text], function ($message) {
                $message->to('chipix@ustnn.net');
                $message->subject('Обращение от клиента');
            });

            // Установка метки, что форма была отправлена
            Cache::put($formKey, true, 600); // Хранить метку в течение 10 минут

            return response()->json('Ваше сообщение успешно отправлено');
        } catch (Exception $e) {
            return response()->json(['[Could not send mail]' => $e->getMessage()], 500);
        }
    }
}
