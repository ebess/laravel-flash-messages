# Flash Message Package

## Install
```bash
composer require ebess/laravel-flash-messages
```
config/app.php
```php
'providers' => [
    // ..
    Ebess\FlashMessages\FlashMessageServiceProvider::class,
]
```
layout.blade.php
```
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @include('flash-messages::flash-messages')
        </div>
    </div>
</div>
```
## Usage
Adding massages:
```php
flash()->add('danger', 'This is a Headline', 'This is text.');
```
