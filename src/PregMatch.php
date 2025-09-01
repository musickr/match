<?php

namespace Musickr\Match;

class PregMatch
{
    public static function ValidateChineseIDCard($id)
    {
        $id = strtoupper(trim($id)); // 统一大写 X
        // 正则
        $re18 = '/^[1-9]\d{5}(18|19|20|21)\d{2}(0[1-9]|1[0-2])(0[1-9]|[12]\d|3[01])\d{3}[\dX]$/';
        $re15 = '/^[1-9]\d{5}\d{2}(0[1-9]|1[0-2])(0[1-9]|[12]\d|3[01])\d{3}$/';
        if (preg_match($re18, $id)) {
            $year  = substr($id, 6, 4);
            $month = substr($id, 10, 2);
            $day   = substr($id, 12, 2);
            if (!checkdate((int)$month, (int)$day, (int)$year)) {
                return false;
            }
            if (!self::CheckId18Checksum($id)) {
                return false;
            }
            return true;
        }
        if (preg_match($re15, $id)) {
            $year  = substr($id, 6, 2);
            $month = substr($id, 8, 2);
            $day   = substr($id, 10, 2);
            // 15位身份证年份推断（默认 19xx，可按需要扩展到 20xx）
            $year = (int)$year + 1900;
            if (!checkdate((int)$month, (int)$day, (int)$year)) {
                return ['ok' => false, 'reason' => '非法日期'];
            }
            return true;
        }
        return false;
    }

    private function CheckId18Checksum($id18)
    {
        $weights = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];
        $mapping = ['1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'];
        $sum = 0;
        for ($i = 0; $i < 17; $i++) {
            $sum += (int)$id18[$i] * $weights[$i];
        }
        $r = $sum % 11;
        $checkCode = $mapping[$r];
        return $checkCode === $id18[17];
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