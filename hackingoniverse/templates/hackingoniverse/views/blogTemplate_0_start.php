<?php ob_start(); ?>
<section class="u-clearfix u-section-1" id="sec-6e2f">
  <div class="u-clearfix u-sheet u-valign-middle u-sheet-1"><?php
$blogJson = '{"type":"Recent","source":"","tags":"","count":"","gridProps":[{"mode":"XL","columns":3,"gap":22,"styles":".u-section-1 .u-repeater-1 {grid-auto-rows: [[XL_VALUE]] !important}"},{"mode":"LG","columns":3,"gap":22,"styles":"@media (max-width: 1199px) {.u-section-1 .u-repeater-1 {grid-auto-rows: [[LG_VALUE]] !important}}"},{"mode":"MD","columns":2,"gap":22,"styles":"@media (max-width: 991px) {.u-section-1 .u-repeater-1 {grid-auto-rows: [[MD_VALUE]] !important}}"},{"mode":"SM","columns":1,"gap":22,"styles":"@media (max-width: 767px) {.u-section-1 .u-repeater-1 {grid-auto-rows: [[SM_VALUE]] !important}}"},{"mode":"XS","columns":1,"gap":22,"styles":"@media (max-width: 575px) {.u-section-1 .u-repeater-1 {grid-auto-rows: [[XS_VALUE]] !important}}"}]}';
if ($all) { echo getGridAutoRowsStyles($blogJson, $all); }
?>

    <div class="u-blog u-expanded-width u-repeater u-repeater-1">