<div class="row">

  <?php foreach ($permisos as $class => $methods): ?>
    <div class="col-12 col-sm-6 col-md-4">
      <div class="card">
        <div class="card-body">
          <div class="form-group row">
            <label class="col-md-3"><?=$class; ?></label>
            <div class="col-md-9">
              <?php $x=1; ?>
              <?php foreach ($permisos[$class] as $method => $value): ?>
                <div class="custom-control custom-checkbox mr-sm-2">
                  <input class="custom-control-input" id="customControlAutosizing<?=$class.$x;?>" type="checkbox">
                  <label class="custom-control-label" for="customControlAutosizing<?=$class.$x;?>"><?=$method; ?></label>
                </div>
                <?php $x++; ?>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>

    </div>
  <?php endforeach; ?>

</div>
