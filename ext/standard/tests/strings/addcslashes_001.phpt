--TEST--
Test addcslashes() function (variation 1)
--INI--
precision=14
--FILE--
<?php

echo "*** Testing addcslashes() for basic operations ***\n";
/* checking normal operation of addcslashes */
$string = "goodyear12345NULL\0truefalse\a\v\f\b\n\r\t";
$charlist = array (
  NULL,
  2,
  array(5,6,7),
  "a",
  "\0",
  "\n",
  "\r",
  "\t",
  "\a",
  "\v",
  "\b",
  "\f"
);
/* loop prints string with backslashes before characters
   mentioned in $char using addcslashes() */
$counter = 1;
foreach($charlist as $char) {
  echo "-- Iteration $counter --\n";
  try {
    var_dump( addcslashes($string, $char) );
  } catch (TypeError $e) {
    echo $e->getMessage(), "\n";
  }
  $counter++;
}

echo "Done\n";

?>
--EXPECT--
*** Testing addcslashes() for basic operations ***
-- Iteration 1 --
string(36) "goodyear12345NULL truefalse\a\b
	"
-- Iteration 2 --
string(37) "goodyear1\2345NULL truefalse\a\b
	"
-- Iteration 3 --
addcslashes(): Argument #2 ($characters) must be of type string, array given
-- Iteration 4 --
string(39) "goodye\ar12345NULL truef\alse\\a\b
	"
-- Iteration 5 --
string(39) "goodyear12345NULL\000truefalse\a\b
	"
-- Iteration 6 --
string(37) "goodyear12345NULL truefalse\a\b\n	"
-- Iteration 7 --
string(37) "goodyear12345NULL truefalse\a\b
\r	"
-- Iteration 8 --
string(37) "goodyear12345NULL truefalse\a\b
\t"
-- Iteration 9 --
string(41) "goodye\ar12345NULL truef\alse\\\a\\b
	"
-- Iteration 10 --
string(37) "goodyear12345NULL truefalse\a\v\b
	"
-- Iteration 11 --
string(39) "goodyear12345NULL truefalse\\a\\\b
	"
-- Iteration 12 --
string(37) "goodyear12345NULL truefalse\a\f\b
	"
Done
