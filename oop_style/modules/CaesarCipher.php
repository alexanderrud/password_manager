<?php

declare(strict_types=1);

namespace Modules;

class CaesarCipher
{
    public function encryptPassword(string $password): string
    {
        $level = readline("\nEnter shift level:");
        $alphabeticLetters = implode(array_merge(range('a', 'z'), range('A', 'Z')));
        $passwordLetters = str_split($password);
        $hashedPassword = '';

        foreach ($passwordLetters as $letter) {
            $letterPosition = strpos($alphabeticLetters, $letter);

            if (($letterPosition + $level) >= strlen($alphabeticLetters)) {
                $shiftNumber = abs(strlen($alphabeticLetters) - ($letterPosition + $level));
                $hashedPassword .= $alphabeticLetters[$shiftNumber];
            } else {
                $hashedPassword .= $alphabeticLetters[$letterPosition + $level];
            }
        }

        return $hashedPassword;
    }
}
