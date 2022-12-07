<body>
<div class="main">
  <nav>
    <div class="title">
      <h2>Welcome to Pet Simulator!</h2>
    </div>
    <div class="navButtons">
      <button class="cyan" onclick='window.location.href="petList.php";'>Your Pets</button>
      <button class="cyan" onclick='window.location.href="createPet.php";'>Create A New Pet</button>
      <button class="cyan" onclick='window.location.href="admin.php";'
      <?php
        if (!isAdmin(getUserID())) {
          echo 'disabled=""';
        }
      ?>
      >ADMIN</button>'
    </div>
  </nav>
  <div class="content">
  