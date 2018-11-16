<?php

namespace SoapBox\Webhooks;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request as IlluminateRequest;
use Illuminate\Validation\ValidatesWhenResolvedTrait;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Validation\Validator as IlluminateValidator;

abstract class Request extends IlluminateRequest implements ValidatesWhenResolved
{
    use ValidatesWhenResolvedTrait;

    /**
     * @var array
     */
    private $input;

    /**
     * Default Request constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->input = $this->json()->all();
    }

    /**
     * Create a Validator for the Request
     *
     * @return \Illuminate\Validation\Validator
     */
    protected function validator(): IlluminateValidator
    {
        return Validator::make($this->input, $this->rules());
    }

    /**
     * Return the value from the request input if it exists
     *
     * @param string $key
     * @param mixed|null $default
     *
     * @return mixed|null
     */
    protected function getInput(string $key, $default = null)
    {
        if (array_key_exists($key, $this->input)) {
            return $this->input[$key];
        }

        return $default;
    }

    /**
     * Define the validation rules for the request
     *
     * @return array
     */
    abstract public function rules(): array;
}
