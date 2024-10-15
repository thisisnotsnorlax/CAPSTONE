<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Leave report</title>
  <link rel="stylesheet" href="../css/leave.css">
</head>
<body>
  <div class="container">
    <h2>Leave management form</h2>
    <form action="process.php" method="post">
      <label for="name">Full Name:</label>
      <input type="text" id="name" name="name" required>
      
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="phone">Phone Number:</label>
      <input type="tel" id="phone" name="phone" required>

      <label for="address">Address:</label>
      <textarea id="address" name="address" rows="4" required></textarea>

      <label for="leave_type">leave type:</label>
      <select id="leave_type" name="leave_type" required>
        <option value="Casual">Casual</option>
        <option value="Medical">Medical</option>
        <option value="Sick">Sick</option>
        <option value="other">Other</option>
      </select>



      <button type="submit">Submit form</button>
    </form>
  </div>
</body>
</html>