<?php

function e($value)
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

// This function will generate all the letters of the alphabet as an array
// ['A','B',C', ... 'X','Y',Z']
function gen_alphabet(): array
{
    $A = ord('A');
    $Z = ord('Z');
    $letters = [];

    for ($i = $A; $i <= $Z; $i++) {
        $letters[] = chr($i);
    }

    return $letters;
}
