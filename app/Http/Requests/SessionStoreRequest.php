<?php

namespace App\Http\Requests;

use App\Models\Session;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class SessionStoreRequest extends FormRequest
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
            'price' => ['required','integer'],
            'movie_id' => ['required','integer'],
            'date_time' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $prevSession = Session::where('date_time', '<=', $value)
                        ->orderByDesc('date_time')
                        ->first();
                    $nextSession = Session::where('date_time', '>=', $value)
                        ->orderBy('date_time')
                        ->first();

                    if ($prevSession) {
                        $minTime = Carbon::parse($prevSession->date_time)->addMinutes(30);

                        if (Carbon::parse($value) < $minTime) {
                            $fail('Время между сеансами должно быть не менее 30 минут');
                        }
                    }
                    if ($nextSession) {
                        $minTime = Carbon::parse($nextSession->date_time)->subMinutes(30);

                        if (Carbon::parse($value) > $minTime) {
                            $fail('Время между сеансами должно быть не менее 30 минут');
                        }
                    }
                },
            ],
        ];
    }
}
