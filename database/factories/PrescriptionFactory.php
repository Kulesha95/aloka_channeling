<?php

namespace Database\Factories;

use App\Constants\Appointments;
use App\Constants\Prescriptions;
use App\Models\Appointment;
use App\Models\Prescription;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrescriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Prescription::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $appointment = Appointment::whereIn('status', [
            Appointments::PAID,
            Appointments::PENDING,
            Appointments::COMPLETED
        ])->get()->random();
        return [
            "prescription_type" => ($appointment->status == Appointments::PENDING || $this->faker->boolean())
                ? Prescriptions::TEST_PRESCRIPTION
                : Prescriptions::INTERNAL_MEDICAL_PRESCRIPTION,
            "comment" => $this->faker->paragraph(),
            "date" => $appointment->date,
            "time" => $appointment->time,
            "appointment_id" => $appointment->id,
            "status" => Prescriptions::NEW_PRESCRIPTION,
        ];
    }
}