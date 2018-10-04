<div class="row">
  <div class="col-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><?=$page_title?></h5>
        <?php
        echo "<pre>";
        print_r($this->session->userdata());
        echo "</pre>";
        ?>
      </div>

    </div>
  </div>

</div>
