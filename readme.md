# Backdrop Attr

Backdrop Attr builds filterable HTML attributes for any element. It is like `body_class()`, `post_class()` and `comment_class()`, but for any element you want, and every attribute can be changed with filters.

## Requirements
* PHP 7.4 or later
* [backdrop-dev/framework](https://github.com/backdrop-dev/framework) ^2.0

## Installation
```
composer require backdrop-dev/attr
```

Register the provider when you boot your application:

```php
$app->provider( \Backdrop\Attr\Provider::class );
```

## Usage
```php
<body <?php Backdrop\Attr\display( 'body' ); ?>>
<article <?php Backdrop\Attr\display( 'post' ); ?>>
<aside <?php Backdrop\Attr\display( 'sidebar', 'primary', [ 'role' => 'complementary' ] ); ?>>
```

* `display( $name, $context = '', $attr = [] )` outputs the escaped attributes.
* `render( $name, $context = '', $attr = [] )` returns them as a string.
* `attr( $name, $context = '', $attr = [] )` returns the object, which supports `get( 'id' )` and `with( 'post', $post_id )`.

Without a custom class, the class is `{name} {name}--{context}`, for example `sidebar sidebar--primary`. The names `html`, `body`, `post`, `entry` and `comment` use the matching WordPress attributes and classes.

## Filters
* `backdrop/attr/{name}/defaults` filters the defaults before your input is merged in.
* `backdrop/attr` and `backdrop/attr/{name}` filter the final array of attributes.
* `backdrop/attr/{name}/class` filters the classes as an array.

## License
GPL-2.0-or-later
