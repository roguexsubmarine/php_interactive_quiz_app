<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Question</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen">
  <form action="insert.php" method="post" class="bg-gray-800 p-6 rounded-lg shadow-md w-full max-w-md space-y-4">
    <h2 class="text-xl font-bold text-center">Add New Question</h2>

    <input name="question" type="text" required placeholder="Enter question"
      class="w-full px-4 py-2 rounded bg-gray-700 border border-gray-600" />

    <div class="space-y-2">
      <input name="answer[]" type="text" required placeholder="Option 1"
        class="w-full px-4 py-2 rounded bg-gray-700 border border-gray-600" />
      <input name="answer[]" type="text" required placeholder="Option 2"
        class="w-full px-4 py-2 rounded bg-gray-700 border border-gray-600" />
      <input name="answer[]" type="text" required placeholder="Option 3"
        class="w-full px-4 py-2 rounded bg-gray-700 border border-gray-600" />
      <input name="answer[]" type="text" required placeholder="Option 4"
        class="w-full px-4 py-2 rounded bg-gray-700 border border-gray-600" />
    </div>

    <label class="block text-sm mt-2">Correct Option (1-4):</label>
    <input type="number" name="correct" min="1" max="4" required
      class="w-full px-4 py-2 rounded bg-gray-700 border border-gray-600" />

    <button type="submit"
      class="w-full bg-indigo-600 hover:bg-indigo-500 px-4 py-2 rounded text-white font-semibold">Add</button>
  </form>
</body>
</html>
