<?php


for($i = 1; $i <= 3; $i++) {
    echo "<state name='arg$i' />".PHP_EOL;
}

for($i = 1; $i <= 3; $i++) {
    for($j = 1; $j <= 3; $j++) {
        echo PHP_EOL;
        echo '<transition>'.PHP_EOL.
            '<source>arg'.$i.'</source>'.PHP_EOL.
            '<target>res'.($i+$j).'</target>'.PHP_EOL.
            '<event>sel'.$j.'</event>'.PHP_EOL.
            '</transition>'.PHP_EOL;
    }
}

for($i = 2; $i <= 6; $i++) {
    echo "<state name='res$i' />".PHP_EOL;
}

for($i = 1; $i <= 3; $i++) {
    echo PHP_EOL;
    echo '<transition>'.PHP_EOL.
                '<source>calc</source>'.PHP_EOL.
                '<target>arg'.$i.'</target>'.PHP_EOL.
                '<event>sel'.$i.'</event>'.PHP_EOL.
        '</transition>'.PHP_EOL;
    //echo "<state name='arg$i' />".PHP_EOL;
}


for($i = 1; $i <= 3; $i++) {
    echo PHP_EOL;
    echo '<event name="sel'.$i.'" manual="true" />';
}
