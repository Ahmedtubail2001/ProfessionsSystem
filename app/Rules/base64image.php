<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class base64image implements Rule
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
        if (!is_string($value) || !preg_match('/^data:image\/(png|jpeg|jpg|svg|gif);base64,/', $value)) {
            return false;
        }
        // Decode the base64-encoded image data
        $data = base64_decode(substr($value, strpos($value, ',') + 1));
        // Get the image size and type from the decoded data
        $info = getimagesizefromstring($data);
        if (!$info) {
            return false;
        }
        $allowedTypes  = ['svg', 'jpg', 'png', 'jpeg', 'gif'];
        $mimeType = $info['mime'];
        // if (!in_array($info[2], array_values($allowedTypes))) {
        // }
        if (!in_array(explode("/", $info['mime'])[1], $allowedTypes)) {
            return false;
        }

        // Check that the image size is within the allowed range
        $maxWidth = 5000;
        $maxHeight = 4000;
        $minWidth = 400;
        $minHeight = 600;
        if ($info[0] > $maxWidth || $info[1] > $maxHeight) {
            return false;
        }

        if ($info[0] < $minWidth || $info[1] < $minHeight) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid base64-encoded image within the size limit.';
    }
}
