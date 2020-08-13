<?php
echo "Integer type<br>";
$int_var_1 = 1234;
$int_var_2 = 5678;
$sum_int = $int_var_1 + $int_var_2;
echo "$int_var_1 + $int_var_2 = $sum_int<br><br>";

echo "Double type<br>";
$double_var_1 = 12.1234;
$double_var_2 = 34.3456;
$sum_double = $double_var_1 + $double_var_2;
echo "$double_var_1 + $double_var_2 = $sum_double<br><br>";

echo "String type<br>";
$my_string = "Tôi là Nguyễn Trí Sơn";
echo "Chuỗi ban đầu: $my_string<br>";
echo "Chuỗi trên có " . strlen($my_string) . " ký tự. <br>";
echo "Chuỗi sau khi được chuyển thành số nguyên: " . crc32($my_string) . ".<br>";

$words = explode(" ", $my_string);
$count = count($words);
echo "Chuỗi trên gồm $count từ: ";
foreach($words as $index => $word) {
  echo $word;
  if ($index != $count-1) {
    echo ", ";
  }
  else {
    echo ".<br>";
  }
}

echo "Chuỗi trên sau khi thay họ Nguyễn bằng họ Vương: " . str_replace("Nguyễn", "Vương", $my_string) . ".<br>";

echo "10 ký tự đầu tiên của chuỗi trên là: " . substr($my_string, 0, 10) . ".<br>";
echo "Chuỗi sau khi loại bỏ khoảng trắng thừa: " .trim($my_string) . ".<br>";
echo "This is line " . __LINE__ . "of php file.<br>";
?>
