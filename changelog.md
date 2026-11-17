# Changelog

## 1.0.0 - November 17, 2026
The first official release of Backdrop Attr for Backdrop 2.0. It builds filterable HTML attributes for any element, with the functions `Backdrop\Attr\display()`, `render()` and `attr()`.

Changed:
* Requires `backdrop-dev/framework` ^2.0 and PHP 7.4, which the package uses but didn't declare.
* Uses the `Backdrop\Proxies\App` proxy, which is available as soon as an application is created, instead of the `Backdrop\App` alias, which only exists after the application has booted.
* The filters were renamed from the old `hybrid/attr` prefix to `backdrop/attr`: `backdrop/attr`, `backdrop/attr/{name}`, `backdrop/attr/{name}/defaults` and `backdrop/attr/{name}/class`.
* Removed `composer.lock` from the repository; libraries don't ship one.
* Fixed: an element name that matched a class method (`render`, `display`, `all`, `get`, `with`) called that method instead of building attributes. Only `html`, `body`, `post`, `entry` and `comment` get built-in defaults now.
* Fixed: `with()` had no effect once the attributes had been built; it now rebuilds them.
* Changed: `false` and `null` values now leave the attribute out, and `true` outputs a bare attribute such as `hidden`. Before, `false` printed a bare attribute and `true` printed `="1"`.
* Added parameter and return types (PHP 7.4) to the class, contract and functions, and fixed the docblocks.
* Added dependency free tests (`php tests/run.php`) and a GitHub Action that lints and runs them on PHP 7.4 to 8.3.
