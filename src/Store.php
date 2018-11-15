<?php

namespace SoapBox\Webhooks;

class Store extends Request
{
    public function getEventType()
    {
        return $this->getInput('event-type');
    }

    public function getData(): array
    {
        return $this->getInput('data');
    }

    public function rules(): array
    {
        return [
            'event-type' => 'required|string',
            'data' => 'required|array',
            'data.id' => 'required'
        ];
    }
}
