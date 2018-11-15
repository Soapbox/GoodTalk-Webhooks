<?php

namespace SoapBox\Webhooks;

use Illuminate\Http\Request as IlluminateRequest;

abstract class Request extends IlluminateRequest
{
    private $input;

    public function __construct()
    {
        parent::__construct();

        $this->input = $this->json()->all();
    }

    protected function getInput(string $key, $default = null)
    {
        if (array_key_exists($key, $this->input)) {
            return $this->input[$key];
        }

        return $default;
    }

    abstract public function rules(): array;
}
