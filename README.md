# php callable_equals()

```php
var_dump(callable_equals(
    ['Foo', 'bar'],
    'foo::BAR'
));

var_dump(callable_equals(
    ['A\\b\\C\\d\\Foo', 'bAr'],
    'a\\B\\c\\D\\FoO::bar',
    ['A\\b\\c\\d\\foo', 'BAR']
));

var_dump(callable_equals(
    [new ArrayObject, 'append'],
    [new ArrayObject, 'append']
));

var_dump(callable_equals(
    [new ArrayObject, 'append'],
    [new ArrayObject, 'append'],
    false
));
```
