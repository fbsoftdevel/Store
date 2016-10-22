
<?php
    include_once 'view_header.php';
?>
<body>
    <script>
        $(document).ready(function(){
            $('ul.tabs').tabs();
  });
    </script>
    <div class="row">
    <div class="col s12">
      <ul class="tabs">
          <li class="tab col s3"><a href="#store_container">STORE</a></li>
          <li class="tab col s3"><a class="active" href="#pgroup_container">GROUPS</a></li>
      </ul>
    </div>
  </div>
  <?php
    include_once 'view_html_store.php';
    include_once 'view_html_pgroup.php';
  ?>
</body>

<?php
include_once 'view_footer.php';
