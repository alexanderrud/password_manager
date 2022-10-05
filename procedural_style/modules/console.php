<?php

declare(strict_types=1);

function generatePassword(): void
{
    $inputValue = readline("Enter your password: ");
    $password = trim($inputValue);

    if ($password === '') {
        print("You did not pass string for password! \n1. Generate again\n2. Exit");

        $inputValue = readline("\nYour option:");

        match ($inputValue) {
            '1' => generatePassword(),
            '2' => exit
        };
    }

    $encryptedPassword = encryptPassword($password);

    savePassword($encryptedPassword);
}
