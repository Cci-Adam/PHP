<?php
$random = rand(0, 8);
$array_img = [
    "https://cdn.pixabay.com/photo/2017/10/13/14/15/fantasy-2847724_960_720.jpg",
    "https://cdn.pixabay.com/photo/2019/06/03/02/54/skull-4248008_960_720.jpg",
    "https://cdn.pixabay.com/photo/2018/01/12/10/19/fantasy-3077928_960_720.jpg",
    "https://cdn.pixabay.com/photo/2017/11/07/00/07/fantasy-2925250_960_720.jpg",
    "https://cdn.pixabay.com/photo/2018/04/01/18/37/fantasy-3281710_960_720.jpg",
    "https://cdn.pixabay.com/photo/2023/09/21/11/51/ai-generated-8266517_960_720.jpg",
    "https://cdn.pixabay.com/photo/2024/01/16/23/21/ai-generated-8513245_960_720.png",
    "https://cdn.pixabay.com/photo/2024/01/24/11/33/ai-generated-8529417_960_720.png",
    "https://cdn.pixabay.com/photo/2024/01/06/13/16/ai-generated-8491364_960_720.jpg",
    "https://cdn.pixabay.com/photo/2019/11/08/20/54/ring-4612457_640.jpg"
];

$date = date("s")%10;

for($i = 1; $i <= 10; $i++) {
    $x = $date + $i;
    $source = $array_img[$x%10];
    echo "<img src= \"$source\" width=\"10%\">";
}
echo "<pre>";
var_dump($GLOBALS);