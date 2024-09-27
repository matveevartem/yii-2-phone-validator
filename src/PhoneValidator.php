<?php

namespace DanishIgor\Yii2PhoneValidator;

use yii\validators\Validator;

/**
 * Validator of mobile numbers.
 *
 * For validation, the phone must consist of 11 digits. By default, clearing of all has been added to validation
 * non-numeric values, but it can be removed using the "enableCleaning" (true / false) parameter. If you want to
 * remove everything except numbers and several other characters, for example, parentheses, you can save them through
 * the parameter "savedSymbols".
 *
 * Example:
 * > public function rules()
 * > {
 * >     return [
 * >         // Validation and cleaning by default.
 * >         ['YOUR_FIELD', PhoneValidator::class],
 * >
 * >         // Only validation.
 * >         ['YOUR_FIELD', PhoneValidator::class, 'enableCleaning' => false],
 * >
 * >         // Saving everything except numbers (default) and parentheses in a string.
 * >         // "Phone: +7 (987) 654 3210" > "+7(987)6543210"
 * >         ['YOUR_FIELD', PhoneValidator::class, 'savedSymbols' => '()'],
 * >     ];
 * > }
 *
 * @package DanishIgor\Yii2Validators
 */
class PhoneValidator extends Validator
{
    /**
     * @var bool $enableCleaning Flag cleanup string.
     */
    public $enableCleaning = true;
    /**
     * @var string $savedSymbols Saved characters.
     */
    public $savedSymbols = '';

    /**
     * @inheritdoc
     */
    public function validateAttribute($model, $attribute)
    {
        if (strlen(preg_replace('/[^0-9]/', '', $model->$attribute)) != 11) {
            $this->addError($model, $attribute, 'Field "{attribute}" mast have 11 digits.');
        }

        if ($this->enableCleaning) {
            $model->$attribute = preg_replace(
                '/[^0-9' . preg_quote($this->savedSymbols) . ']/',
                '',
                $model->$attribute
            );

            if (substr($model->$attribute, 0, 1) != 7) {
                substr_replace($model->$attribute, '7', 0, 1);
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function validateValue($value)
    {
        if (strlen(preg_replace('/[^0-9]/', '', $value)) != 11) {
            return ['Value mast have 11 digits.', []];
        }

        return null;
    }
}
