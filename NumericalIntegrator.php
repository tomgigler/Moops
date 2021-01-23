<?php

class NumericalIntegrator {

   var $N_STARTING_VALUE;
   var $ACCEPTABLE_ERROR;

   function NumericalIntegrator()
   {
      $this->N_STARTING_VALUE = 20;
      $this->ACCEPTABLE_ERROR = 0.000001;
   }

   function integrateSRND($x_val)
   {
      if($x_val < 0)
      {
         return 0.5 - $this->integrateSR_using_ND(0, -$x_val);
      }
      else
      {
         return $this->integrateSR_using_ND(0, $x_val) + 0.5;
      }
   }

   function funcND($x_val)
   {
      return  exp(- ($x_val * $x_val ) / 2) / sqrt(2 * pi());
   }

   function integrateSR_using_ND($x_low, $x_high)
   {
      $n = $this->N_STARTING_VALUE;
      $result = 0;

      do {
         $w = ($x_high - $x_low) / $n;
         $old_result = $result;
         $result = $w / 3 * $this->funcND($x_low);
         for($i = 1 ; $i < $n ; $i++)
         {
            if($i % 2 == 1)
               $result += $w / 3 * 4 * $this->funcND($x_low + $i * $w);
            else
               $result += $w / 3 * 2 * $this->funcND($x_low + $i * $w);
         }
         $result += $w / 3 * $this->funcND($x_low + $i * $w);
         $n = $n * 2;
      } while (abs($result - $old_result) > $this->ACCEPTABLE_ERROR);

      return $result;
   }

   function integrateSRTDist($x_val, $n)
   {
      if($x_val < 0)
        return 0.5 - $this->integrateSR_using_TDist(0, -$x_val, $n);
      else
        return $this->integrateSR_using_TDist(0, $x_val, $n) + 0.5;
   }

   function integrateSR_using_TDist($x_low, $x_high, $nDf)
   {
      $n = $this->N_STARTING_VALUE;
      $result = 0;

      do {
         $w = ($x_high - $x_low) / $n;
         $old_result = $result;
         $result = $w / 3 * $this->funcTDist($x_low, $nDf);
         for($i = 1 ; $i < $n ; $i++)
         {
            if($i % 2 == 1)
               $result += $w / 3 * 4 * $this->funcTDist($x_low + $i * $w, $nDf);
            else
               $result += $w / 3 * 2 * $this->funcTDist($x_low + $i * $w, $nDf);
         }
         $result += $w / 3 * $this->funcTDist($x_low + $i * $w, $nDf);
         $n = $n * 2;
      } while (abs($result - $old_result) > $this->ACCEPTABLE_ERROR);

      return $result;
   }

   function gamma($x)
   {
      if($x == 1) return 1;
      if($x == 0.5) return sqrt(pi());
      return ($x - 1) * $this->gamma($x - 1);
   }

   function funcTDist($x_val, $n)
   {
      return ($this->gamma(($n + 1.0)/2.0)/(sqrt($n*pi()) * $this->gamma($n/2.0))) * pow(1.0 + ($x_val * $x_val) / $n, -($n + 1.0)/2.0);
   }

} // NumericalIntegrator

/* TEST
$n = new NumericalIntegrator();
print $n->integrateSRTDist(1.250, 3)."\n";
*/
?>
