<?php

namespace App\Services\Validation;

use Hash;
use Auth;
use Illuminate\Validation\Validator;

class ExtendedValidator extends Validator
{
    private $_custom_messages = [
        "emails" => "The :attribute must be a comma separated list of emails",
        "password" => "Your old password does not match our records",
        "duplicate" => "The :attribute must not contain duplicate values",
        "not_shared_with_self" => "The group cannot be shared with self",
        "email_exists_in_database" => "Some of the email doesnot have an account"
    ];

    public function __construct( $translator, $data, $rules, $messages = array(), $customAttributes = array() ) {
        parent::__construct( $translator, $data, $rules, $messages, $customAttributes );

        $this->_set_custom_stuff();
    }

    /**
     * Setup any customizations etc
     *
     * @return void
     */
    protected function _set_custom_stuff() {
        //setup our custom error messages
        $this->setCustomMessages( $this->_custom_messages );
    }

    /**
     * Allow only valid list of emails separated by comma
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    protected function validateEmails( $attribute, $value ) {
        $isValid = true;

        $emails = array_filter(preg_split("/,\s*/", $value));
        foreach($emails as $email) {
            $isValid &= filter_var($email, FILTER_VALIDATE_EMAIL)?true:false;
        }

        return (bool) $isValid;
    }

    /**
     * Checks old password with the current password
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool 
     */
    protected function validatePassword( $attribute, $value ) {
        return (bool) Hash::check($value, Auth::user()->password);
    }

    /**
     * Checks whether sharing list contains duplicate email address
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool 
     */
    protected function validateDuplicate( $attribute, $value ) {
        $array = array_filter(preg_split("/,\s*/", $value));
        return count($array) == count(array_flip($array));
    }

    /**
     * Checks whether sharing list contains duplicate email address
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool 
     */
    protected function validateNotSharedWithSelf( $attribute, $value ) {
        $array = array_flip(array_filter(preg_split("/,\s*/", $value)));
        return !isset($array[Auth::user()->email]);
    }    
} 