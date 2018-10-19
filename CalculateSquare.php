<?php
/**
 * Created by PhpStorm.
 * User: glenn
 * Date: 2018/10/19
 * Time: 下午 3:03
 */


if (php_sapi_name() == 'cli') {
    $obj = new CalculateSquare();
    $obj->execute();
}

class CalculateSquare
{


    /**
     * list for vectors for 4 lines
     * @var array
     */
    private $vectors = [];

    /**
     * definition for Cartesian coordinate of line
     * @var array
     */
    private $keys = ['x0', 'y0', 'x1', 'y1'];


    /**
     * CalculateSquare constructor.
     */
    public function __construct()
    {
        echo 'Please enter the Cartesian coordinate of 4 Lines'.PHP_EOL.PHP_EOL;
    }

    /**
     * @return int
     */
    public function execute()
    {
        $lines = $this->setLines();

        $this->setVector($lines);

        $result = $this->calculate();

        if ($result==1) {
            echo 'this 4 line can be a square'.PHP_EOL;
        } else {
            echo 'this 4 line can NOT be a square'.PHP_EOL;
        }

        return $result;
    }


    /**
     * Set Lines from Input
     * @return array
     */
    private function setLines()
    {
        for ($i=1; $i<=4; $i++) {
            foreach ($this->keys as $key) {
                fwrite(STDOUT, "Enter Line".$i." ".$key.": ");

                $line{$i}[$key] = (int) trim(fgets(STDIN));

            }

            print_r($line{$i}).PHP_EOL.PHP_EOL;
            $lines[] = $line{$i};
        }

        return $lines;
    }

    /**
     * Set vector for Lines
     * @param $lines
     */
    private function setVector($lines)
    {
        foreach ($lines as $line) {
            $vector['vX'] = $line['x1'] - $line['x0'];
            $vector['vY'] = $line['y1'] - $line['y0'];
            $this->vectors[] = $vector;
        }
    }


    /**
     * calculate can be a square or not
     * @return int
     */
    private function calculate()
    {
        $vector1 = array_shift($this->vectors);
        foreach ($this->vectors as $key => $vector) {
            (int) $vA['vX'] =(int) $vector1['vX'] + (int) $this->vectors[$key]['vX'];
            (int) $vA['vY'] =(int) $vector1['vY'] + (int) $this->vectors[$key]['vY'];

            $subVectors = $this->vectors;
            unset($subVectors[$key]);
            $subVectors = array_values($subVectors);

            $vB['vX'] = $subVectors[0]['vX'] + $subVectors[1]['vX'];
            $vB['vY'] = $subVectors[0]['vY'] + $subVectors[1]['vY'];

            if (($vA['vX'] == $vB['vX'] && $vA['vY'] == $vB['vY']) || ($vA['vX'] == -$vB['vX'] && $vA['vY'] == -$vB['vY'])) {
                echo PHP_EOL.PHP_EOL.'result:'.PHP_EOL.'1'.PHP_EOL.PHP_EOL;
                return 1;
            }

        }
        echo PHP_EOL.PHP_EOL.'result:'.PHP_EOL.'0'.PHP_EOL.PHP_EOL;
        return 0;
    }



}

