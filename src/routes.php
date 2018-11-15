<?php

Route::post('webhook', '\SoapBox\Webhooks\WebhookController@handle');
