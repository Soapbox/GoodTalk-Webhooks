<?php

Route::group(['middleware' => 'verify-signature:webhooks'], function() {
    Route::post('webhook', '\SoapBox\Webhooks\WebhookController@handle');
});
