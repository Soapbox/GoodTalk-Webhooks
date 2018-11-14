<?php

namespace SoapBox\Webhooks;

use Illuminate\Http\Request;

class Store extends Request
{
    public function getEventType(): string
    {
        return $this->input('event-type');
    }

    public function getData(): array
    {
        return $this->input('data');
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
