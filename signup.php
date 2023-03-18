<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $captcha = $_POST["g-recaptcha-response"];

  if (!$captcha) {
    // If reCAPTCHA is not filled out, show an error message
    echo "<p>Please check the reCAPTCHA box</p>";
    exit;
  }

  $url = "https://www.google.com/recaptcha/api/siteverify";
  $data = array(
    "secret" => "6LdW8xAlAAAAAADWaBj_L-sOFY5g_n6e_CkLPkJd",
    "response" => $captcha
  );

  // Send a POST request to the reCAPTCHA server
  $options = array(
    "http" => array (
      "method" => "POST",
      "header" => "Content-Type: application/x-www-form-urlencoded\r\n",
      "content" => http_build_query($data)
    )
  );

  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);
  $response = json_decode($result, true);

  if ($response["success"] == true) {
    // If reCAPTCHA is successful, continue with the sign-up process
    // ...
  } else {
    // If reCAPTCHA fails, show an error message
    echo "<p>Please verify that you are not a robot</p>";
    exit;
  }
}
?>


<?php
session_start();
?>