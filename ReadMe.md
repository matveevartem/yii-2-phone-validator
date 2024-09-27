Валидатор номера телефона для Yii2
===

Для успешного прохождения проверки телефон должен состоять из 11 цифр.
По умолчанию при проверке нечисловых значений лишние символы вырезаются.
Это можно отключить с помощью параметра "enableCleaning" (true / false).
Если вы хотите удалить все кроме цифр и некоторых других символов, например, круглых скобок,
измените значение параметра "savedSymbols".

Примеры
---

```php
<?php

namespace app\models;

use DanishIgor\Yii2PhoneValidator\PhoneValidator;

class PhoneForm extends \yii\base\Model
{
    public $phone;

    public function rules()
    {
        return [
            // Валидация по умолчанию.
            ['phone', PhoneValidator::class],

            // Только валидация.
            ['phone', PhoneValidator::class, 'enableCleaning' => false],

            // Сохранение всего, кроме чисел (по умолчанию) и круглых скобок в строке.
            // "Телефон: +7 (987) 654 3210" > "+7(987)6543210"
            ['phone', PhoneValidator::class, 'savedSymbols' => '()'],
        ];
    }
}
```
