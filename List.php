<?php
header('Content-Type: application/json');
$study_tips = [
    "Always comment your code.",
    "Take breaks when debugging.",
    "Practice typing code manually to build muscle memory."
];
echo json_encode($study_tips);
?>

