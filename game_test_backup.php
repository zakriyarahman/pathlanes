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
    private function _minMovements($obstacles) {

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