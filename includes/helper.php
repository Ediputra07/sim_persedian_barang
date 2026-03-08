<?php
function format_tanggal($tanggal) {
    if (empty($tanggal) || $tanggal === '0000-00-00') {
        return '-';
    }
    return date('d M Y', strtotime($tanggal));
}
?>