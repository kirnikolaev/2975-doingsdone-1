
<div class="modal" <?php if ( !isset($_POST['add_pro']) ):?> hidden <?php endif;?>  id="project_add">
  <button class="modal__close" type="button" name="button">Закрыть</button>

  <h2 class="modal__heading">Добавление проекта</h2>

  <form class="form"  action="index.php" method="post">
    <div class="form__row">
      <label class="form__label" for="project_name">Название <sup>*</sup></label>
      <input class="form__input <?php if ( ( isset($errors['project_add']) ) ):?> form__input--error <?php endif;?> " type="text" name="project_add" id="project_name" value="" placeholder="Введите название проекта">
      <?php if ( ( isset($_POST['add_pro']) && $errors['project_add'] ) ):?> <p class="form__message"><?=$errors['project_add']?></p> <?php endif;?>
    </div>

    <div class="form__row form__row--controls">
      <input class="button" type="submit" name="add_pro" value="Добавить">
    </div>
  </form>
</div>