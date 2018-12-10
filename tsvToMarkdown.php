<?php
if(count($argv) !== 2){
    echoUsage();
}
$tsv_file = $argv[1];
$row = 1;
if (($handle = fopen($tsv_file, "r")) === FALSE) {
    echoUsage($tsv_file." is not a readable file.");
}
while (($data = fgetcsv($handle, 1000, "\t","\"")) !== FALSE) {
    echo str_replace(array("\r","\n"), "", nl2br("| ".implode($data, " | ")." |"))."\n";
    if($row == 1){
        echo "|".implode(array_fill(0, count($data), ":---------") , "|")."|\n";
    }
    $row++;
}
fclose($handle);

function echoUsage($msg = null){
    echo "Usage: ./tsvToMarkdown.php [target_tsv_file]\n";
    echo "TSV ファイルはUTF8で記載してください。\n";
    echo $msg;
    exit(1);
}
