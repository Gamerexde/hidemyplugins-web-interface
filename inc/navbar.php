<?php
function print_navbar() {
  include './config/settings.php';
?>
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
    <a class="navbar-brand" href="<?php echo $web_url?>"><?php echo $web_name?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-item nav-link active" href="index.php">Home<span class="sr-only">(current)</span></a>
      </div>
    </div>
    <form class="form-inline">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" name="user" aria-label="Search">
      <button class="btn btn-outline-light my-2 my-sm-0" type="submit" name="sub">Search</button>
    </form>
</nav>
<?php
}
?>
