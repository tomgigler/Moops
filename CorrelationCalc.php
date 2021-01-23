<?php

require_once "NumericalIntegrator.php";

class CorrelationCalc {

   function getCorrelation($xData, $yData)
   {
      $n = sizeof($xData);
      $num_1 = 0;
      $num_2 = 0;
      $num_3 = 0;
      $den_1 = 0;
      $den_2 = 0;

      for($index = 0 ; $index < $n ; $index++)
      {
         $num_1 += $xData[$index] * $yData[$index];
         $num_2 += $xData[$index];
         $num_3 += $yData[$index];
         $den_1 += $xData[$index] * $xData[$index];
         $den_2 += $yData[$index] * $yData[$index];
      }
      return ($n * $num_1 - $num_2 * $num_3)/sqrt(($n * $den_1 - $num_2 * $num_2) * ($n * $den_2 - $num_3 * $num_3));
   }

   function getT($xData, $yData)
   {
      $n = sizeof($xData);
      $correlation = $this->getCorrelation($xData, $yData);
      return (abs($correlation) * sqrt($n - 2.0)) / sqrt(1.0 - $correlation * $correlation);
   }

   function getSignificance($xData, $yData)
   {
      $n = sizeof($xData);
      $correlation = $this->getCorrelation($xData, $yData);
      $t = (abs($correlation) * sqrt($n - 2.0)) / sqrt(1.0 - $correlation * $correlation);
      $ni = new NumericalIntegrator();
      return $ni->integrateSRTDist($t, $n - 2);
   }

} // CorrelationCalc

/***************************************
   TESTING                             *
****************************************
$xData = array( 186, 699, 132, 272, 291, 331, 199, 1890, 788, 1601);
$yData = array( 15.0, 69.9, 6.5, 22.4, 28.4, 65.9, 19.4, 198.7, 38.8, 138.2);

$c = new CorrelationCalc();

print "correlation: ".$c->getCorrelation($xData, $yData)."\n";
print "t: ".$c->getT($xData, $yData)."\n";
print "significance: ".$c->getSignificance($xData, $yData)."\n";
print "2*(1-p): ".(2*(1-$c->getSignificance($xData, $yData)))."\n";
print "\n";

$xData = array( 61, 54, 149, 97 );
$yData = array( 152, 181, 235, 198 );

print "correlation: ".$c->getCorrelation($xData, $yData)."\n";
print "t: ".$c->getT($xData, $yData)."\n";
print "significance: ".$c->getSignificance($xData, $yData)."\n";
print "2*(1-p): ".(2*(1-$c->getSignificance($xData, $yData)))."\n";
print "\n";

$xData = array( 30, 60, 152, 56 );
$yData = array( 152, 181, 235, 198 );

print "correlation: ".$c->getCorrelation($xData, $yData)."\n";
print "t: ".$c->getT($xData, $yData)."\n";
print "significance: ".$c->getSignificance($xData, $yData)."\n";
print "2*(1-p): ".(2*(1-$c->getSignificance($xData, $yData)))."\n";
print "\n";

$xData = array( 20.6, 47, 89, 33 );
$yData = array( 61, 54, 149, 97 );

print "correlation: ".$c->getCorrelation($xData, $yData)."\n";
print "t: ".$c->getT($xData, $yData)."\n";
print "significance: ".$c->getSignificance($xData, $yData)."\n";
print "2*(1-p): ".(2*(1-$c->getSignificance($xData, $yData)))."\n";
print "\n";

****************************************
   TESTING                             *
***************************************/

?>
