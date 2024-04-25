<?php
$echo = "Entrez un mot : ";
readline($echo);

if ($echo == strrev($echo)) {
    echo "C'est un palindrome";
} else {
    echo "Ce n'est pas un palindrome";
}
