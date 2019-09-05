---
title: Adding and Removing Projectors and Reactors
weight: 10
---

You can add and remove projectors and reactors via the `Projectionist` facade.

Whilst this package can auto-discover your event handlers, it is still useful to be able to add and remove projectors or reactors for your test suite. For example, a slow reactor might be worth removing to speed up your tests if the behaviour of that reactor is not relevant for the feature you are testing.

## Adding Projectors

Adding one projector:

```php
Projectionist::addProjector(TransactionCountProjector::class);
```

Adding many projectors:

```php
Projectionist::addProjector([
    AccountBalanceProjector::class,
    TransactionCountProjector::class,
]);
```

## Adding Reactors

Adding one reactor:

```php
Projectionist::addReactor(SendMailReactor::class);
```

Adding many reactors:

```php
Projectionist::addReactor([
    SendMailReactor::class,
    SendPushNotificationReactor::class,
]);
```

## Removing Projectors and Reactors

A projector and a reactor are both event handlers. You can remove either of them with the same function.

Removing one event handler:

```php
Projectionist::withoutEventHandler(SendPushNotificationReactor::class);
```

Removing many event handlers:

```php
Projectionist::withoutEventHandlers([
    TransactionCountProjector::class,
    SendPushNotificationReactor::class,
]);
```
