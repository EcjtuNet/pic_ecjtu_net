<?php include 'header.php';?>
    <div id="message">
      <h1><?php echo $msgtitle; ?></h1>
      <p><?php echo $msgcontent; ?></p>
    </div>
    <script type="text/javascript">
      setTimeout("<?php echo $gotourl; ?>",2000)
    </script>
<?php include 'footer.php';?>