<?php

function celsius_to_fahrenheit($celsius) {
  // Apply the formula: F = C * 9/5 + 32
  $fahrenheit = $celsius * 9/5 + 32;
  // Return the result
  return $fahrenheit;
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
  // Get the input from the user
  $celsius = $_POST['celsius'];
  // Validate the input
  if (is_numeric($celsius)) {
    // Call the function and store the result
    $result = celsius_to_fahrenheit($celsius);
    // Display the output
   
    echo "<p>$celsius celsius is equal to </p>"."<span>$result</span> fahrenheit.";
  } else {
    // Display an error message
    echo "<p>Please enter a valid number.</p>";
  }
}
?>