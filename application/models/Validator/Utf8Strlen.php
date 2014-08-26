<?php
namespace Model\Validator;
/**
 * [文件描述]
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */
class Utf8Strlen extends \Phalcon\Mvc\Model\Validator
{
    public function validate($model)
    {
        $field = $this->getOption('field');
        $min = $this->getOption('min');
        $max = $this->getOption('max');
        ($messageMaximum = $this->getOption('messageMaximum')) || $messageMaximum = "Value of field '{$field}' exceeds the maximum {$max} characters";
        ($messageMinimum = $this->getOption('messageMinimum')) || $messageMinimum = "Value of field '{$field}' is less than the minimum {$min} characters";;
        
        $value = $model->$field;
        $len = mb_strlen($value,'utf-8');
        
        if ($len > $max || $len < $min) {
            $this->appendMessage(
                $len>$max?$messageMaximum:$messageMinimum,
                $field,
                "Utf8StrlenValidator"
            );
            return false;
        }
        return true;
    }
}