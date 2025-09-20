@extends('BackEnd.admin.layout')

@section('content1')
{{-- Updated to match common layout --}}

<br>
<br>
<div>
  <h2>Send Message and Photo</h2>

  <form id="sendForm">
    <label for="message">Message:</label><br>
    <input type="text" id="message" name="message" required><br><br>

    <label for="photo">Upload Photo:</label><br>
    <input type="file" id="photo" name="photo" accept="image/*"><br><br>

    <button type="submit">Send</button>
  </form>

  <p id="status"></p>

  <script>
    document.getElementById("sendForm").addEventListener("submit", async function (e) {
      e.preventDefault();

      const status = document.getElementById("status");
      const formData = new FormData();
      formData.append("message", document.getElementById("message").value);

      const photo = document.getElementById("photo").files[0];
      if (photo) {
        formData.append("photo", photo);
      }

      try {
        const response = await fetch("http://127.0.0.1:8000/api/websocket", {
          method: "POST",
          body: formData
        });

        const result = await response.json();
        status.textContent = result.success ? "✅ Sent successfully!" : "❌ Failed to send.";
        console.log(result);
      } catch (err) {
        status.textContent = "❌ Error: " + err.message;
        console.error(err);
      }
    });
  </script>
</div>
@endsection
