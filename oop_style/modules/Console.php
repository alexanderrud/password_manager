<?php

declare(strict_types=1);

namespace Modules;

class Console
{
    private CaesarCipher $caesarCipher;
    private FileManager $fileManager;

    public function __construct(CaesarCipher $caesarCipher, FileManager $fileManager)
    {
        $this->caesarCipher = $caesarCipher;
        $this->fileManager = $fileManager;
    }

    public function generatePassword(): void
    {
        $inputValue = readline("Enter your password: ");
        $password = trim($inputValue);

        if ($password === '') {
            print("You did not pass string for password! \n1. Generate again\n2. Exit");

            $inputValue = readline("\nYour option:");

            match ($inputValue) {
                '1' => $this->generatePassword(),
                '2' => exit
            };
        }

        $encryptedPassword = $this->caesarCipher->encryptPassword($password);

        $this->fileManager->savePassword($encryptedPassword);
    }
}
