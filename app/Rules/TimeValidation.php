<?php

namespace App\Rules;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Rule;

class TimeValidation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function validateTime(Request $request)
    {
        $existingAppointments = [
            $request->appointment, // Example existing appointment time
            // Add more existing appointment times as needed
        ];

        $request->validate([
            'newAppointmentDateTime' => [
                'required',
                'date_format:Y-m-d H:i:s',
                function ($attribute, $value, $fail) use ($existingAppointments) {
                    // Custom validation logic to check if the time is already taken
                    $newDateTime = \Carbon\Carbon::parse($value);

                    // Check if the new appointment time conflicts with existing appointments
                    foreach ($existingAppointments as $existingAppointment) {
                        $existingDateTime = \Carbon\Carbon::parse($existingAppointment);

                        // Check if there is an overlap in time
                        if ($newDateTime->between($existingDateTime->subMinutes(30), $existingDateTime->addMinutes(30))) {
                            $fail($attribute . ' is already taken for this date and time.');
                        }
                    }
                },
            ],
        ]);

        // Your logic if validation passes
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
