<?php

class Digitalize{

  public function make($number){
    $number = (string) $number;
    $digits = $this->getDigits($number);
    return $this->resolveDigits($digits);
  }

  private function getDigits($number){
    return str_split($number);
  }

  private function resolveDigits($digits){
    $digits = $this->reverseArray($digits);
    $digits = array_chunk($digits, 3);
    return $this->resolveChunks($digits);
  }

  private function resolveChunks($chunks){
    $chunks = $this->reverseArray($chunks);
    $chunks = $this->arrayMap($chunks, "reverseArray");
    $htmlBits = $this->arrayMap($chunks, "transformHtml");
    $htmlBits = $this->arrayMap($htmlBits, 'prepareHtmlBits');
    return $this->separateBitsByCommas($htmlBits);
  }

  private function reverseArray($array){
    return array_reverse($array);
  }

  private function prepareHtmlBits($array){
    return implode("", $array);
  }

  private function separateBitsByCommas($bits){
    return implode("<span class='comma'>,</span>", $bits);
  }
  private function transformHtml($array){
    return $this->arrayMap($array, "wrapSpan");
  }

  private function wrapSpan($digit){
    return "<span class='digit'>{$digit}</span>";
  }
  private function arrayMap(array $array, $method){
    return array_map([$this, $method], $array);
  }

}