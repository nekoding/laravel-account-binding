<?php

function sensoredEmail($email) {
    $exploded = explode('@', $email);
    return str_pad(substr($exploded[0], 0, 3), strlen($exploded[0]), "*"). '@'. $exploded[1];
}
