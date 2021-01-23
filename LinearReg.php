<?php

class LinearReg {
   var $betaOne;
   var $betaZero;

   function LinearReg()
   {
      $this->seventy_percent_interval[1] = 1.963;
      $this->seventy_percent_interval[2] = 1.386;
      $this->seventy_percent_interval[3] = 1.250;
      $this->seventy_percent_interval[4] = 1.190;
      $this->seventy_percent_interval[5] = 1.156;
      $this->seventy_percent_interval[6] = 1.134;
      $this->seventy_percent_interval[7] = 1.119;
      $this->seventy_percent_interval[8] = 1.108;
      $this->seventy_percent_interval[9] = 1.100;
      $this->seventy_percent_interval[10] = 1.093;
      $this->seventy_percent_interval[15] = 1.074;
      $this->seventy_percent_interval[20] = 1.064;
      $this->seventy_percent_interval[30] = 1.055;
      $this->seventy_percent_interval[40] = 1.036;

      $this->ninety_percent_interval[1] = 6.314;
      $this->ninety_percent_interval[2] = 2.920;
      $this->ninety_percent_interval[3] = 2.353;
      $this->ninety_percent_interval[4] = 2.132;
      $this->ninety_percent_interval[5] = 2.015;
      $this->ninety_percent_interval[6] = 1.943;
      $this->ninety_percent_interval[7] = 1.895;
      $this->ninety_percent_interval[8] = 1.860;
      $this->ninety_percent_interval[9] = 1.833;
      $this->ninety_percent_interval[10] = 1.812;
      $this->ninety_percent_interval[15] = 1.753;
      $this->ninety_percent_interval[20] = 1.725;
      $this->ninety_percent_interval[30] = 1.697;
      $this->ninety_percent_interval[40] = 1.645;
   }

   function get_interval_70($n)
   {
      while(!isset($this->seventy_percent_interval[$n])) $n--;
      return $this->seventy_percent_interval[$n];
   }

   function get_interval_90($n)
   {
      while(!isset($this->ninety_percent_interval[$n])) $n--;
      return $this->ninety_percent_interval[$n];
   }

   function init($xData, $yData)
   {
      $beta_1_numerator = 0;
      $beta_1_denomenator = 0;
      $size = sizeof($xData);

      // calculate betaOne
      for($index = 0 ; $index < $size ; ++$index)
      {
         $beta_1_numerator += $xData[$index] * $yData[$index]; 
         $beta_1_denomenator += $xData[$index] * $xData[$index];
      }
      $beta_1_numerator -= $size * (array_sum($xData)/sizeof($xData)) * (array_sum($yData)/sizeof($xData));
      $beta_1_denomenator -= $size * (array_sum($xData)/sizeof($yData)) * (array_sum($xData)/sizeof($yData)); 

      $this->betaOne = $beta_1_numerator / $beta_1_denomenator;

      // calculate betaZero
      $this->betaZero = array_sum($yData)/sizeof($yData) - $this->betaOne * array_sum($xData)/sizeof($xData);
   }

   function getStdDev($xData, $yData)
   {
      $stdDev = 0;
      for($index = 0 ; $index < sizeof($xData) ; $index++)
      {
         $stdDev += ($yData[$index] - $this->betaZero - $this->betaOne * $xData[$index])
                 * ($yData[$index] - $this->betaZero - $this->betaOne * $xData[$index]);
      }
      return sqrt( $stdDev / ( sizeof($xData) - 2 ) );
   }

   function getProjection($xK)
   {
      return $this->betaZero + $this->betaOne * $xK;
   }

   function getPartialRange($xData, $yData, $xK)
   {
      $partialRange = 0;
      for($index = 0 ; $index < sizeof($xData) ; $index++)
         $partialRange += ( $xData[$index] - array_sum($xData)/sizeof($yData) ) * ( $xData[$index] - array_sum($xData)/sizeof($yData) );

      return $this->getStdDev($xData, $yData) * sqrt( 1.0 + ( 1.0 / sizeof($xData) ) + ( ( $xK - array_sum($xData)/sizeof($yData) ) * ( $xK - array_sum($xData)/sizeof($yData) ) ) / $partialRange );
   }

   function getRange70($xData, $yData, $xK)
   {
      return $this->getPartialRange($xData, $yData, $xK) * $this->get_interval_70(sizeof($xData) - 2);
   }

   function getRange90($xData, $yData, $xK)
   {
      return $this->getPartialRange($xData, $yData, $xK) * $this->get_interval_90(sizeof($xData) - 2);
   }

} // LinearReg

/**************** TEST
$xData = array( 130, 650, 99, 150, 128, 302, 95, 945, 368, 961 );
$yData = array( 186, 699, 132, 272, 291, 331, 199, 1890, 788, 1601 );

$l = new LinearReg();
$l->init($xData, $yData);
print "b0: ".$l->betaZero."\n";
print "b1: ".$l->betaOne."\n";
print "proj: ".$l->getProjection(386)."\n";
print "range70: ".$l->getRange70($xData, $yData, 386)."\n";
print "range90: ".$l->getRange90($xData, $yData, 386)."\n";
print "\n";

$xData = array( 250, 75, 30, 60, 260 );
$yData = array( 179, 130, 61, 54, 148 );

$l = new LinearReg();
$l->init($xData, $yData);
print "b0: ".$l->betaZero."\n";
print "b1: ".$l->betaOne."\n";
print "proj: ".$l->getProjection(152)."\n";
print "range70: ".$l->getRange70($xData, $yData, 152)."\n";
print "range90: ".$l->getRange90($xData, $yData, 152)."\n";
print "\n";
******************************/

?>

