<?php

namespace SoapBox\Webhooks;

class Store extends Request
{
    /**
     * Get the event type from the request
     *
     * @return string
     */
    public function getEventType(): string
    {
        return $this->input('event-type');
    }

    /**
     * Get the data from the request
     *
     * @return array
     */
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
