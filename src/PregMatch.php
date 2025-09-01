<?php

namespace Musickr\Match;

class PregMatch
{
    public static function ValidateChineseIDCard($idCard) {
        $pattern = '/^(1[1-5]|2[1-3])\d{4}(19|20)\d{2}(0[1-9]|1[0-2])(0[1-9]|[12]\d|3[01])\d{3}(\d|X)$/i';
        return preg_match($pattern, $idCard) === 1;
    }
    public static function ValidateHongKongIDCard($idCard) {
        // 香港身份证号码格式为一个字母 + 6-7 位数字 + 一个校验码
        $pattern = '/^[a-zA-Z]\d{6,7}[\dA]$/';
        return preg_match($pattern, $idCard) === 1;
    }
    public static function ValidateMacaoIDCard($idCard) {
        // 澳门身份证号码格式为一个字母 + 1 或 2 位数字 + 5 位数字 + 一个校验码
        $pattern = '/^[a-zA-Z]\d{1,2}\d{5}[\dA]$/';
        return preg_match($pattern, $idCard) === 1;
    }
    public static function ValidateTaiwanIDCard($idCard) {
        // 台湾身份证号码格式为一个英文字母 + 9 位数字
        $pattern = '/^[a-zA-Z]\d{9}$/';
        return preg_match($pattern, $idCard) === 1;
    }
    public static function ValidatePassport($passport) {
        // 护照号码格式可以是任意字符
        // 这里使用简单的规则，只判断护照号码长度是否在一定范围内
        return strlen($passport) >= 6 && strlen($passport) <= 20;
    }
    public static function ValidateMilitaryID($militaryID) {
        // 军官证号码格式可以是任意字符
        // 这里使用简单的规则，只判断军官证号码长度是否在一定范围内
        return strlen($militaryID) >= 6 && strlen($militaryID) <= 20;
    }
    public static function ValidateHouseholdRegister($householdRegister) {
        // 户口本号码格式可以是任意字符
        // 这里使用简单的规则，只判断户口本号码长度是否在一定范围内
        return strlen($householdRegister) >= 6 && strlen($householdRegister) <= 20;
    }

}