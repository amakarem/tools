<?php
//remove line breaks from the file and add it with keyword
if (isset($argv[1])) {
    $filename = $argv[1];
    if (strtoupper($filename) == '-HELP' || $filename == '?') {
        unset($filename);
        echo PHP_EOL;
        echo "This program read CSV file and replace all line breaks and reorgnize the file " . PHP_EOL . "depend on keywork on the begning of the row" . PHP_EOL;
        echo "Accepted file format CSV and TXT" . PHP_EOL;
        echo PHP_EOL;
        echo "Example:" . PHP_EOL;
        echo "php -q csv.php filename.csv first_word_of_row > newfile.csv" . PHP_EOL;
        echo PHP_EOL;
    } elseif (!strpos(strtoupper($filename), '.CSV') && !strpos(strtoupper($filename), '.TXT')) {
        unset($filename);
        echo "Accepted file format CSV and TXT" . PHP_EOL;
    } elseif (!isset($argv[2])) {
        echo "Missing Keyword use -help for more information" . PHP_EOL;
    } else {
        $keyword = $argv[2];
        if (file_exists($filename)) {
            $file = fopen($filename, 'r');
            $newrow = PHP_EOL . $keyword;
            while (!feof($file)) {
                $line = fgets($file);
                $line = str_replace('","', '|', $line);
                $line = preg_replace("/\r|\n/", "", $line);
                $line = str_replace($keyword, $newrow, $line);
                echo $line;
            }
            fclose($file);
        } else {
            echo "File $filename not found." . PHP_EOL;
        }
    }
}
/*
if (isset($argv[2])) {
$keyword = $argv[2];
}
if (isset($filename) && isset($keyword)) {
if (file_exists($filename)) {
$file = fopen($filename, 'r');
$newrow = PHP_EOL . $keyword;
while (!feof($file)) {
$line = fgets($file);
$line = preg_replace("/\r|\n/", "", $line);
$line = str_replace($keyword, $newrow, $line);
echo $line;
}
fclose($file);
} else {
echo "File $filename not found." . PHP_EOL;
}
} else {
echo "Missing filename and Keyword, use -help for more information" . PHP_EOL;
}
 */
