<?php
require_once 'utils.php';
if (point_calc(0, 19, 0) == 0) {
    // trigger_error('OK');
} else {
    trigger_error('NG');
}
if (point_calc(18, 19, 18) == 360) {
    // trigger_error('OK');
} else {
    trigger_error('NG');
}
if (point_calc(14, 19, 8) == 274) {
    // trigger_error('OK');
} else {
    trigger_error('NG');
}
