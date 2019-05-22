<?php
/*
 * The _minMovements method accepts an array of integers in the range [1-3].
 * Imagine the input array are a road you are traveling. Each integer in the array represents an obstacle
 * on the road as you are moving forward. The road always has 3 lanes and you begin in the middle lane.
 * At any time you may switch to any of the other 2 lanes.
 *
 * Write an algorithm that would analyze the array and determine the minimum number of lane changes you would need
 * to make to get to the end of the road.
 *
 * Example input:
 * [1,2,2,2,3,1,2,3,3,2,2,2,3,3,1]
 *
 *
 * | 1 | 2 | 3
 * | x |   |
 * |   | x |
 * |   | x |
 * |   | x |
 * |   |   | x
 * | x |   |
 * |   | x |
 * |   |   | x
 * |   |   | x
 * |   | x |
 * |   | x |
 * |   | x |
 * |   |   | x
 * |   |   | x
 * | x |   |
 *
 * Answer:
 * 4 lane changes
 */


class PathsTest {

    /**
     * @param $obstacles
     * @return int
     */
    private function _minMovements($obstacles)
    {
        // If the passed value is not an array
        // Or is empty, then just return 0
        if(!is_array($obstacles) ||  empty($obstacles)) return 0;
        // Set the counter
        $counter = 0;
        $size = count($obstacles);
        // Sanitize all the values of the array
        for ($i=0; $i < $size; $i++) {
            $obstacles[$i] = (int) $obstacles[$i];
        }
        // Determine the starting point (defualt to 2)
        $currentPath = 2;
        // If the first value is 2 then increment
        // Iterate through the array
        for ($i=0; $i < $size; $i++) {
            // If the number at index == currentPath
            // then increment and change lanes
            if($currentPath == $obstacles[$i]) {
                ++$counter;
                $currentPath = $this->changePath($obstacles, $i);
            }
            // echo 'Current path  ' . $currentPath;
            // echo '  |   Index value  ' . $i;
            // echo '  |   Counter value  ' . $counter;
            // echo PHP_EOL;
        }
        // Then forward lookup for next indexes for 2nd occurence of next number
        // Return the counter
        return $counter;
    }

    /**
     * If the starting point is not 2 then increment
     * and start from next best possible path
     *
     * @param array $obstacles
     * @return int
     **/
    private function determineStartingPoint(&$arr, &$counter)
    {
        if(!$arr[0] == 2) return 2;
        ++$counter;
        // Determine the next best possible
        return $this->changePath($arr);
    }

    /**
     * Determine the best path
     *
     * @param array $arr (call by reference, use the same array)
     * @param int value
     **/
    private function changePath(&$arr, $index)
    {
        $currentPath = $arr[$index];
        $size = count($arr);
        $first = 0;
        // Start from the second element
        for ($i=$index+1; $i < $size; $i++) {
            // If the first is set and not equal to value
            // Then it is the second number
            if($arr[$i] != $currentPath && $first != 0 && $arr[$i] != $first) {
                $index = $i;
                return $arr[$i];
            }
            // If the number = index and first is not set
            // Then it is the first number
            if($arr[$i] != $currentPath && $first == 0) {
                $first = $arr[$i];
            }
        }
    }


    public function run() {
        // get the test file
        $tests = file('tests.txt');
        $answers = file('answers.txt');

        foreach($tests as $i => $test) {
            $data = explode(',', $test);
            $result = $this->_minMovements($data);

            echo $i . ": " . $result . " ==> ";
            echo ( $result == $answers[$i] ) ? "correct" : "incorrect";
            echo "</br>";
        }
    }

}

$test = new PathsTest();
$test->run();
