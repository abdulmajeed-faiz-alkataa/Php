```php
<?php
function sayHello() {
    echo "مرحباً بك في عالم الدوال!<br>";
}

sayHello(); // استدعاء الدالة
sayHello(); // يمكنك استدعاؤها أكثر من مرة!

?>
```

```php

<?php

function welcome() {
    echo "أهلاً بالطلاب!<br>";
}

welcome();
?>
```

```php

<?php
function greet($name) {
    echo "مرحباً يا $name!<br>";
}

greet("عبدالمجيد");
greet("فايز");
greet("القطاع");

?>
```

```php

<?php

	function sum() {
	    return 10 + 20;
	}
	
	$result = sum();
	
	echo "النتيجة = $result";

?>
```

```php

<?php

function add($a, $b) {
    return $a + $b;
}

$result = add(5, 7);

echo "الناتج = $result";

?>
```

```php

<?php

function userInfo($name, $age) {
    return "الاسم: $name — العمر: $age سنة<br>";
}

echo userInfo("عبدالمجيد", 22);
echo userInfo("القطاع", 19);

?>
```

```php

<?php

function test() {
    $x = 10; // متغير محلي
    echo $x;
}

test();   // 10

?>
```

```php

<?php
$x = 5;

function show() {
    global $x;
    echo $x; // يعمل
}

show();

?>
```

```php

<?php

$x = 20;

function demo() {
    echo $GLOBALS['x'];
}

demo(); // 20

?>
```

```php

<?php

function sumAll(...$numbers) {
    $total = 0;

    foreach ($numbers as $n) {
        $total += $n;
    }

    return $total;
}

echo sumAll(1, 2, 3, 4, 5);

?>
```

```php

<?php

$hello = function() {
    echo "Hello!";
};

$hello(); // استدعاء

?>
```

```php

<?php

function process($callback) {
    echo "بدء المعالجة...<br>";
    $callback();
}

process(function() {
    echo "تم التنفيذ داخل الكول باك!";
});

?>
```

```php

<?php

$students = ["Ali", "Omar", "Zed", "Lena", "Areej"];

$result = array_filter($students, function($name) {
    return strlen($name) > 3;
});

print_r($result);

?>
```

```php

<?php

class Student {
    
    public function sayHello() {
        echo "مرحبًا، أنا طالب!";
    }
}

$st = new Student();
$st->sayHello();

?>
```

```php

<?php

class Calculator {

    public function add($a, $b) {
        return $a + $b;
    }

    public function multiply($a, $b) {
        return $a * $b;
    }
}

$calc = new Calculator();

echo $calc->add(10, 5);
echo $calc->multiply(4, 3);

?>
```

```php

<?php

class User {
    public $name;

    public function setName($n) {
        $this->name = $n;
    }

    public function getName() {
        return $this->name;
    }
}

$user = new User();
$user->setName("عبدالمجيد");

echo $user->getName(); // عبدالمجيد

?>
```

```php
<?php

function factorial($n) {
    if ($n == 1) return 1;

    return $n * factorial($n - 1);
}

echo factorial(5); // 120

?>
```

```php
<?php

$message = "مرحبًا";

$greeter = function() use ($message) {
    echo $message;
};

$greeter();

?>
```

```php
<?php

function multiplier($n) {
    return function($x) use ($n) {
        return $x * $n;
    };
}

$double = multiplier(2);
echo $double(10); // 20

$triple = multiplier(3);
echo $triple(10); // 30

?>
```

```php
<?php

$message = "Hello";

$greet = function() use ($message) {
    echo $message;
};

$greet();
?>
```

```php
<?php

function multiply($a) {
    return function($b) use ($a) {
        return function($c) use ($a, $b) {
            return $a * $b * $c;
        };
    };
}

echo multiply(2)(3)(4); // 24

?>


