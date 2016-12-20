<?php

/*
 * Someone told me my error handling isn't ideal...
 * Just because I treat every error the same...
 */
function gtfo() {
    die("Error.");
}

/*
 * My dream of treating all kinds of data the same comes
 * closer with this function.
 */
function add_elem(&$a, $b, $key=false) {
    if(is_array($b)) {
        $a = $b + $a;
    } else if ($key) {
        $a[$key] = $b;
    } else {
        $a[] = $b;
    }
}

/*
 * Some people (men) want to hurt web applications.
 * They won't succeed. #InputSanitizationMatters
 */
function sqli_check($txt) {
    if (!preg_match("/^([a-zA-Z0-9_]+)$/is", $txt)) {
        gtfo();
    }
}

/*
 * Encrypting means, giving data a new form, a new dress, although its 
 * still the same <3.
 */
function encrypt_sha($pw, $salt) {
    return hash('sha256', hash('sha256', $pw) . $salt);
}