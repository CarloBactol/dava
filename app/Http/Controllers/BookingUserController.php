<?php

namespace App\Http\Controllers;

use DateTime;
use Pusher\Pusher;
use App\Models\Booking;
use App\Models\Location;
use App\Events\UserBooking;
use Illuminate\Http\Request;
use App\Events\NewNotification;
use Illuminate\Support\Facades\Validator;

class BookingUserController extends Controller
{
    public function index()
    {
        $booking = Booking::all();
        return response()->json(['bookings' => $booking]);
    }

    public function postBooking(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) use ($request) {
                    $location = Location::where('address', $request->branch)->first();
                    // Check if the input is in the expected format
                    $regex = '/(\d{1,2}(?:am|pm))\s*-\s*(\d{1,2}(?:am|pm))/i';
                    preg_match($regex, $location->openHours, $matches);
                    $businessStart = $matches[1];
                    $businessEnd = $matches[2];

                    // Create a DateTime object from the string
                    $dateTimeStart = DateTime::createFromFormat('ga', $businessStart);
                    $dateTimeEnd = DateTime::createFromFormat('ga', $businessEnd);

                    // Format the DateTime object to the desired format
                    $start = $dateTimeStart->format('H:i');
                    $end = $dateTimeEnd->format('H:i');

                    if ($start > $request->start || $end < $request->end) {
                        $fail('Invalid business hours the ' . $location->branch . ' ' . 'Open time is: ' . $location->openHours . ' ' . 'Lunch Time: 12noon - 1:PM');
                    } else {
                        $lunchBreakStart = '12:00';
                        $lunchBreakEnd = '13:00';

                        // Check if the requested time range falls within the lunch break
                        if ($request->start < $lunchBreakEnd && $request->end > $lunchBreakStart) {
                            $fail("The selected time range overlaps with the lunch break.");
                        } else {
                            // $existingDateTime = Booking::where('branch', $request->branch)
                            //     ->where('services', $request->services)
                            //     ->where('type', $request->type)
                            //     ->where('date', $request->date)
                            //     ->where('email', $request->email)
                            //     // ->where(function ($query) use ($request) {
                            //     //     $query->where('start', '<=', $request->start)
                            //     //         ->where('end', '>=', $request->start)
                            //     //         ->orWhere('start', '<=', $request->end)
                            //     //         ->where('end', '>=', $request->end);
                            //     // })
                            //     ->count();

                            // if ($existingDateTime > 0) {
                            //     $fail("The selected date is already booked. Please choose a different date.");
                            // }
                        }
                    }
                },
            ],
            // 'end' => 'required|date_format:H:i|after:start',
            // 'date' => [
            //     'required',
            //     'date', // Ensure it's a valid date format
            //     function ($attribute, $value, $fail) {
            //         // Convert the date string to a DateTime object
            //         $selectedDate = new DateTime($value);

            //         // Check if the selected date is a weekday (Monday to Friday)
            //         if ($selectedDate->format('N') >= 6) {
            //             $fail("Selected date must be a weekday (Monday to Friday).");
            //         }
            //     },
            // ],
            'date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    // Convert the date string to a DateTime object
                    $selectedDate = new DateTime($value);

                    // Check if the selected date is a weekday (Monday to Friday)
                    if ($selectedDate->format('N') >= 6) {
                        $fail("Selected date must be a weekday (Monday to Friday).");
                    }

                    // Check if the user has already made a booking for the given date
                    $existingBookings = Booking::where('email', $request->email)
                        ->where('date', $request->date)
                        ->count();

                    if ($existingBookings > 0) {
                        $fail("You can only make one booking per day.");
                    }
                },
            ],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        Booking::create([
            'branch' => $request->branch,
            'services' => $request->services,
            'date' => $request->date,
            'start' => $request->start,
            'end' => $request->end,
            'type' => $request->type,
            'email' => $request->email,
            'address' => $request->address,
        ]);


        return response()->json(['message' => 'Successfully save']);
        // event(new NewNotification('New notification message'));
        // return response()->json(['message' => 'Notification sent']);
    }

    public function myBooking($email)
    {
        $booking = Booking::where('email', $email)->get();
        return response()->json(['mybook' => $booking]);
    }
}
