<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMovieRequest extends FormRequest
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
     * Semua field opsional (sometimes) agar bisa partial update.
     */
    public function rules(): array
    {
        return [
            'title'  => ['sometimes', 'required', 'string', 'max:255'],
            'genre'  => ['sometimes', 'required', 'string', 'max:100'],
            'mood'   => ['sometimes', 'required', 'in:happy,sad,excited,bored'],
            'rating' => ['sometimes', 'nullable', 'integer', 'min:1', 'max:10'],
            'notes'  => ['sometimes', 'nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'title.max'      => 'Judul film maksimal 255 karakter.',
            'genre.max'      => 'Genre maksimal 100 karakter.',
            'mood.in'        => 'Mood harus salah satu dari: happy, sad, excited, bored.',
            'rating.integer' => 'Rating harus berupa angka.',
            'rating.min'     => 'Rating minimal 1.',
            'rating.max'     => 'Rating maksimal 10.',
            'notes.max'      => 'Catatan maksimal 1000 karakter.',
        ];
    }
}
