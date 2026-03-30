<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'genre' => ['required', 'string', 'max:100'],
            'mood'  => ['required', 'in:happy,sad,excited,bored'],
            'rating' => ['nullable', 'integer', 'min:1', 'max:10'],
            'notes'  => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'title.required'  => 'Judul film wajib diisi.',
            'title.max'       => 'Judul film maksimal 255 karakter.',
            'genre.required'  => 'Genre film wajib diisi.',
            'genre.max'       => 'Genre maksimal 100 karakter.',
            'mood.required'   => 'Mood wajib diisi.',
            'mood.in'         => 'Mood harus salah satu dari: happy, sad, excited, bored.',
            'rating.integer'  => 'Rating harus berupa angka.',
            'rating.min'      => 'Rating minimal 1.',
            'rating.max'      => 'Rating maksimal 10.',
            'notes.max'       => 'Catatan maksimal 1000 karakter.',
        ];
    }
}
