<?php
function getFinalPrice($width, $height, $basePrice) {
  return $width * $height * $basePrice;
}

function getLinealMeter($width, $height) {
  return ($width * 2) + ($height * 2);
}

function getMirrorFinalPrice ($width, $height, $basePrice, $framePrice) {
  return (getLinealMeter($width, $height) * $framePrice) + getFinalPrice($width, $height, $basePrice);
}
