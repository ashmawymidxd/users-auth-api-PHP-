function registerUser() {
  const formData = new FormData(document.getElementById("registerForm"));
  var message = document.getElementById("message");
  const loader = document.getElementById("loader");
  const blur = document.getElementById("blur");
  loader.style.display = "block";
  blur.style.filter = "blur(2px)";
  const local = 'http://localhost/last/register.php';
  const server = 'https://registerapi.000webhostapp.com/user/register.php';
  fetch(server, {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      loader.style.display = "none";
      blur.style.filter = "blur(0px)";
      console.log(data);
      // Handle the response data here
      if (data.status == "success") {
        message.innerHTML = data.message;
        message.classList.toggle("error");
      } else if (data.status == "failed") {
        message.innerHTML = data.message;
        message.classList.toggle("error");
      }
    })
    .catch((error) => {
      console.error("Fetch error:", error);
    });
}
