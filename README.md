# GoodTalk-Webhooks

## Set up
* Install the library 
* Set up your `.env`

```
WEBHOOKS_HANDLER_NAMESPACE=
```
* Set this to the namespace of where classes for your handlers will be


```
WEBHOOKS_SIGNED_REQUEST_ALGORITHM=sha256
WEBHOOKS_SIGNED_REQUEST_CACHE_PREFIX=signed-requests
WEBHOOKS_SIGNED_REQUEST_SIGNATURE_HEADER=GoodTalk-Signature
WEBHOOKS_SIGNED_REQUEST_ALGORITHM_HEADER=GoodTalk-Signature-Algorithm
WEBHOOKS_SIGNED_REQUEST_KEY=testing
WEBHOOKS_SIGNED_REQUEST_ALLOW_REPLAYS=true
WEBHOOKS_SIGNED_REQUEST_TOLERANCE_SECONDS=600
```
* Set this to be able to receive webhooks requests from the API
* `WEBHOOKS_SIGNED_REQUEST_KEY` is generated from the artisan command on the API: `webhook:create`

* The handler class name should be the camel case notation of the name of the event
    * e.g. if the event type from the API is `user.updated` the class to hanle it should be `UserUpdated`
