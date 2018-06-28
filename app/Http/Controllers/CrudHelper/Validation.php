<?php
/**
 * Created by PhpStorm.
 * User: Willywes
 * Date: 16/02/2018
 * Time: 12:39
 */

namespace App\Http\Controllers\CrudHelper;


class Validation
{
    private $request;
    private $rules;
    private $messages = [];


    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param mixed $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * @param mixed $rules
     */
    public function setRules($rules)
    {
        $this->rules = $rules;
    }

    /**
     * @return mixed
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param mixed $messages
     */
    public function setMessages($messages)
    {
        $this->messages = $messages;
    }




}