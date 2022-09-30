<?php

declare(strict_types=1);

function savePassword(string $password): bool
{
    $promptText = "\nChoose option:\n1. Create file";

    $passwordsDirectory = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'passwords';

    if (!mkdir($passwordsDirectory, 0700) && !is_dir($passwordsDirectory)) {
        throw new \RuntimeException(sprintf('Directory "%s" was not created', $passwordsDirectory));
    }

    $directoryContent = array_diff(scandir($passwordsDirectory, 1), ['..', '.']);

    if (!empty($directoryContent)) {
        $promptText .= "\n2. Choose existing file";
    }

    $optionNumber = (int)readline($promptText);

    $file = match ($optionNumber) {
        1 => createNewFile($passwordsDirectory),
        2 => getExistingFiles($passwordsDirectory, $directoryContent),
        default => exit('There is no required option')
    };

    $file = fopen($file, 'ab');

    fwrite($file, date("Y/m/d ") . "{$password}\n");

    return fclose($file);
}

function getExistingFiles(string $passwordsDirectory, array $directoryContent): string
{
    if (empty($directoryContent)) {
        exit('There is no required option');
    }

    $filesList = getFilesList($directoryContent);
    $fileNumber = (int)readline($filesList);

    if (!isset($directoryContent[$fileNumber - 1])) {
        exit('There is no required option');
    }

    return $passwordsDirectory . DIRECTORY_SEPARATOR . $directoryContent[$fileNumber - 1];
}

function createNewFile(string $passwordsDirectory): string
{
    $filename = trim(readline("\nChoose filename:"));
    $file = $passwordsDirectory . DIRECTORY_SEPARATOR . "{$filename}.txt";

    if (file_exists($file)) {
        print_r("File with provided name already exist!\n");

        return createNewFile($passwordsDirectory);
    }

    return $file;
}

function getFilesList(array $directoryContent): string
{
    $filesList = "Choose file:";

    foreach ($directoryContent as $key => $file) {
        ++$key;

        $filesList .= "\n{$key}. {$file}";
    }

    return $filesList;
}
