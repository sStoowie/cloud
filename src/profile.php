<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white font-sans">

  <?php include 'navbar.php'; ?>

  <!-- Navbar -->
  <nav class="bg-white text-black px-4 py-4 flex items-center justify-between shadow">
    <div class="flex items-center">
      <h1 class="text-2xl font-bold text-blue-600">ReadNet</h1>
      <div class="ml-8 space-x-4">
        <a href="home.html" class="text-gray-800 hover:text-blue-600">Home</a>
        <a href="my-list.html" class="text-gray-800 hover:text-blue-600">My List</a>
        <a href="create-comics.html" class="text-gray-800 hover:text-blue-600">Create comics</a>
      </div>
    </div>
    <div class="flex items-center space-x-4">
      <div class="relative">
        <input type="text" placeholder="Search here" class="px-4 py-2 border border-gray-300 rounded-full bg-gray-200 focus:outline-none focus:border-blue-500">
      </div>
      <div class="flex items-center space-x-2">
        <img src="https://via.placeholder.com/40" alt="Profile" class="rounded-full w-8 h-8">
        <span class="font-semibold">Krowl Bell</span>
        <button class="bg-yellow-500 text-black font-semibold px-3 py-1 rounded hover:bg-yellow-600">Profile</button>
      </div>
    </div>
  </nav>  

  <!-- Profile Content -->
  <div class="container mx-auto py-10 px-4 flex justify-center">
    <div class="bg-white text-black p-8 rounded-lg shadow-lg w-full max-w-md">
      <div class="flex items-center justify-center mb-4">
        <img src="https://via.placeholder.com/80" alt="Profile Image" class="rounded-full w-20 h-20">
      </div>
      <h2 class="text-center font-bold text-xl mb-4">
        Krowl Bell 
        <button onclick="toggleEditMode()" class="text-gray-500 hover:text-gray-700 ml-2">
          <img src="https://cdn-icons-png.flaticon.com/128/10573/10573603.png" alt="Edit Icon" class="inline w-5 h-5">
        </button>
      </h2>

      <form id="profileForm">
        <label class="block text-sm font-medium mb-1">Name:</label>
        <input id="name" type="text" value="Krowl Bell" class="w-full px-3 py-2 border border-gray-300 rounded mb-4 bg-gray-100" disabled>

        <label class="block text-sm font-medium mb-1">Username:</label>
        <input id="username" type="text" value="Bell1902" class="w-full px-3 py-2 border border-gray-300 rounded mb-4 bg-gray-100" disabled>

        <label class="block text-sm font-medium mb-1">Password:</label>
        <input id="password" type="password" value="********" class="w-full px-3 py-2 border border-gray-300 rounded mb-4 bg-gray-100" disabled>

        <button id="saveButton" type="button" onclick="saveChanges()" class="hidden w-full bg-pink-500 text-white py-2 rounded hover:bg-pink-600">Save Changes</button>
      </form>

      <button id="logoutButton" class="w-full bg-pink-500 text-white py-2 rounded hover:bg-pink-600 mt-4">Log out</button>
    </div>
  </div>

  <!-- JavaScript -->
  <script>
    function toggleEditMode() {
      // Toggle the edit mode
      const isDisabled = document.getElementById("name").disabled;
      document.getElementById("name").disabled = !isDisabled;
      document.getElementById("username").disabled = !isDisabled;
      document.getElementById("password").disabled = !isDisabled;

      // Change input background
      document.getElementById("name").classList.toggle("bg-gray-100");
      document.getElementById("username").classList.toggle("bg-gray-100");
      document.getElementById("password").classList.toggle("bg-gray-100");

      // Toggle Save button visibility
      document.getElementById("saveButton").classList.toggle("hidden");

      // Hide the Logout button when in edit mode
      document.getElementById("logoutButton").classList.toggle("hidden");
    }

    function saveChanges() {
      alert("Changes saved!");
      // Optionally, add code here to save the changes to a server or database
      toggleEditMode();
    }
  </script>

</body>
</html>
