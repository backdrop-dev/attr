# Changelog

## 1.0.0 - November 17, 2026
The first official release of Backdrop Attr for Backdrop 2.0. It builds filterable HTML attributes for any element, with the functions `Backdrop\Attr\display()`, `render()` and `attr()`.

Changed:
* Requires `backdrop-dev/framework` ^2.0 and PHP 7.4, which the package uses but didn't declare.
* Uses the `Backdrop\Proxies\App` proxy, which is available as soon as an application is created, instead of the `Backdrop\App` alias, which only exists after the application has booted.
* The filters were renamed from the old `hybrid/attr` prefix to `backdrop/attr`: `backdrop/attr`, `backdrop/attr/{name}`, `backdrop/attr/{name}/defaults` and `backdrop/attr/{name}/class`.
* Removed `composer.lock` from the repository; libraries don't ship one.
* Fixed the `all()` return type in the docblocks.
