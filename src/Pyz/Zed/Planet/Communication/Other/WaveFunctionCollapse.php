<?php
declare(strict_types=1);


namespace Pyz\Zed\Planet\Communication\Other;

//use function drawTable;
//use function validateCords;

class WaveFunctionCollapse {

    public function render() {

        $pattern = [
            ['A', 'A', 'A', 'A', 'A'],
            ['B', 'B', 'B', 'B', 'B'],
            ['A', 'A', 'A', 'A', 'A'],
        ];

        $diffTiles = [];

        foreach ($pattern as $line) {
            foreach ($line as $field) {
                $diffTiles[$field] = ($diffTiles[$field] ?? 0) + 1;
            }
        }

        $dirs = [
            ['UP', 0, -1,],
            ['DOWN', 0, 1],
            ['LEFT', -1, 0],
            ['RIGHT', 1, 0],
        ];

        print_r($diffTiles);
        echo '<br><br>';

        $ySize = count($pattern);
        $xSize = count($pattern[0]);

        $validateCords = function(int $x, int $y, $ySize, $xSize): bool {
            //global $ySize, $xSize;

            return $x >= 0 && $y >= 0 && $x < $xSize && $y < $ySize;
        };

        $foundTiles = [];

        for ($i = 0; $i < $ySize; $i++) {

            $line = $pattern[$i];

            for ($j = 0; $j < count($line); $j++) {

                $curr = $line[$j];
                $foundTiles[$curr] ??= [
                    'UP' => [],
                    'DOWN' => [],
                    'LEFT' => [],
                    'RIGHT' => [],
                ];

                foreach ($dirs as $dir) {
                    $x = $j + $dir[1];
                    $y = $i + $dir[2];

                    if ($validateCords($x, $y, $ySize, $xSize)) {

                        $entry = $pattern[$y][$x];
                        $foundTiles[$curr][$dir[0]][$entry] = true;
                    }
                }
            }
        }

        $colors = [
            'A' => '#FF0000',
            'B' => '#00FF00',
            'C' => '#0000FF',
            'None' => '#000000',
        ];

        $N = 1000;
        $M = 1000;

        $state = [];

        for($y = 0; $y < $M; $y++) {

            $state[] = [];

            for($x = 0; $x < $N; $x++) {

                $state[$y][] = [
                    'collapsed' => false,
                    'possible' => [
                        'A', 'B',
                    ]
                ];
            }
        }

        //$state[5][5] = ['collapsed' => true, 'possible' => ['B']];

        //print_r($state);

        $pickMin = function ($N, $M, $state) {

            $min = INF;
            $count = 0;

            for ($y = 0; $y < $M; $y++) {
                for ($x = 0; $x < $N; $x++) {

                    $curr = count($state[$y][$x]['possible']);
                    $collapsed = $state[$y][$x]['collapsed'];

                    if(!$collapsed) {
                        if ($curr == $min) {
                            $count++;
                            continue;
                        }

                        if ($curr < $min) {
                            $count = 1;
                            $min = $curr;
                        }
                    }
                }
            }

            if ($min == 0) {
                return null;
            }

            $randomPick = rand(0, $count - 1);
            $fx = $fy = 0;
            $count = 0;
            for ($y = 0; $y < $M; $y++) {
                $break = false;

                for ($x = 0; $x < $N; $x++) {
                    $curr = count($state[$y][$x]['possible']);
                    $collapsed = $state[$y][$x]['collapsed'];

                    if(!$collapsed) {
                        if ($curr == $min) {
                            if ($randomPick == 0) {
                                return [$x, $y];
                                $break = true;
                                $fx = $x;
                                $fy = $y;
                                break;
                            }
                            $randomPick--;
                        }
                    }
                }

                if ($break) {
                    break;
                }
            }

            return [$fx, $fy];
        };
        $drawTable = function($pattern, $colors) {

            foreach ($pattern as $line) {
                foreach ($line as $field) {

                    if($field['collapsed']) {
                        try {
                            $color = $colors[$field['possible'][0]];
                            $letter = $field['possible'][0];
                        }
                        catch(\Exception $e) { $color = 'pink'; }
                        //$field['possible'];
                        //$color = 'red';
                    }
                    else {
                        $color = $colors['None'];
                        $letter = 'E';
                    }
                    //var_dump($color);

                    echo "<div style='float:left; width:10px; background-color: $color'>$letter</div>";

                }

                echo '<div style="clear: both"></div>';
            }

        };

        for($i = 0; $i < min($N * $M, 10000); $i++) {

            $res = $pickMin($N, $M, $state);

            if($res == null) {
                echo 'error';
                die();
            }

            [$x, $y] = $res;

            /*if($state[$y][$x]['collapsed']) {
                die();
            }*/

            $state[$y][$x]['collapsed'] = true;
            $field = $state[$y][$x];
            $count = count($field['possible']);
            $choice = rand(1, $count) - 1;
            $choice = $field['possible'][$choice];

            $state[$y][$x]['possible'] = [$choice];

            foreach ($dirs as [$name, $dx, $dy]) {

                //var_dump([$name, $dx, $dy]);
                //echo '<br>';

                $possibles = $foundTiles[$choice][$name];
                $fx = $x + $dx;
                $fy = $y + $dy;

                if($validateCords($fx, $fy, $N, $M)) {
                    $newTiles = [];

                    //var_dump($state[$fy][$fx]['possible']);
                    //echo '<br>';

                    foreach($state[$fy][$fx]['possible'] as $pos) {

                        if(isset($possibles[$pos])) {
                            $newTiles[] = $pos;
                        }
                    }

                    $state[$fy][$fx]['possible'] = $newTiles;
                }
            }

            //die();
            //$drawTable($state, $colors);
        }
        $drawTable($state, $colors);

        //$drawTable($pattern, $colors);
        var_dump($foundTiles);
        die();

    }
}
