<?php
function parse(string &$text, string $first, string $last, bool $addFirstAndLast = false, bool $findAll = false)
{
    $pos = strpos($text, $first);
    if ($pos !== false) { // существует ли позиция первого?

        $firstPos = 0;
        $lastLen = strlen($last);

        if ($addFirstAndLast == false) { // обрезать начало и конец?
            $firstPos = strlen($first);
            $lastLen = 0;
        }
        $subText = substr($text, $pos + $firstPos);
        $resultOne = substr($subText, 0, strpos($subText, $last) + $lastLen);

        if ($findAll == true) { // найти все элементы?
            $subText = substr($subText, strlen($resultOne));// обрезаем найденное
            $result = parse($subText, $first, $last, $addFirstAndLast, $findAll);

            if ($result === false) { // не найден результат возвращаемый с функции
                return $resultOne;
            } elseif (is_array($result)) {
                array_unshift($result, $resultOne); // добавляем элемент в начало массива
                return $result;
            } elseif (is_string($result)) { // если строка то это значит что это последний найденый елемент
                $arr[] = $result; // создаём массив и возвращаем
                array_unshift($arr, $resultOne);
                return $arr;
            } else throw new Exception("Error Parse, not return", 1);

        } else {
            return $resultOne;
        }
    } else return false;
}
