<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class IdNumber implements Rule
{

    private $idType, $birthDate, $gender;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($idType, $birthDate, $gender)
    {
        $this->idType = $idType;
        $this->birthDate = $birthDate;
        $this->gender = $gender;
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
        $relationValidation = false;
        $idValidation = false;
        $data = explode("-", $value);
        if (isset($data[1])) {
            if (preg_match('/^R\d{2}$/', $data[1])) {
                $relationValidation = true;
            } else {
                $relationValidation = false;
            }
        } else {
            $relationValidation = true;
        }
        if ($this->idType == "NIC" && !isset($data[1])) {
            $dateOfBirth = Carbon::create($this->birthDate);
            $yearOfBirthShort = $dateOfBirth->format("y");
            $yearOfBirthLong = $dateOfBirth->format("Y");
            $birthDayOfYear = $dateOfBirth->setYear(2020)->dayOfYear;
            $birthDayOfYear = $this->gender == "Female" ? $birthDayOfYear + 500 : $birthDayOfYear;
            $idValidation = preg_match('/^' . $yearOfBirthShort . $birthDayOfYear . '\d{4}[v|V|x|X]$/', $data[0]) ||
                preg_match('/^' . $yearOfBirthLong . $birthDayOfYear . '\d{5}$/', $data[0]);
        } else {
            $idValidation = true;
        }
        return $relationValidation && $idValidation;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.id_number');
    }
}