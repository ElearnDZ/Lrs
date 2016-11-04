<a class="navbar-brand" href="{!! URL() !!}">
  <?php
    $site = App\Models\Site::first();
    if( isset($site->name) ){
      $site = $site->name;
    }else{
      $site = 'Learning Locker';
    }
  ?>
  {!! isset($title) ? $title : $site !!}
</a>