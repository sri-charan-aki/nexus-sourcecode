<link rel="stylesheet" href="styles/header.css">
<table class="header">
  <tr>
    <td>
      <a href="index.php" class="logo">
        <img src="logo.png" alt="logo">
      </a>
    </td>
    <td>
      <div class='hamburger'>
        <img src='Hamburger_icon.png' height=50px width=50px style='cursor:pointer' onclick='show()'>
      </div>
      <div class="nav-bar" id='nav-bar'>
        <a href="index.php">login</a>
        <a href="signup.php">signup</a>
        <a href="#">aboutus</a>
      </div>
    </td>
  </tr>
  <tr>
    <td></td>
    <td>
      <div class="hamburger" id="ham-items">
      <a href="index.php" onmouseover="this.style.color='#ec0101'" onmouseout="this.style.color='black'">login</a>
      <a href="signup.php" onmouseover="this.style.color='#ec0101'" onmouseout="this.style.color='black'">signup</a>
      <a href="#" onmouseover="this.style.color='#ec0101'" onmouseout="this.style.color='black'">aboutus</a>
      </div>
    </td>
  </tr>
</table>
<script type="text/javascript">
function show() {
  var x = document.getElementById('ham-items').style.display
  if (x == 'none') {
    document.getElementById('ham-items').style.display = 'block'
  }
  else {
    document.getElementById('ham-items').style.display = 'none'
  }
}
</script>
