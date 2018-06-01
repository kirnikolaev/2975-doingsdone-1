<?php 
$id = isset($_POST['project_id']) ? $_POST['project_id']: '';
$exec = isset($_POST['execution']) ? $_POST['execution']: '';
?>

<div class="modal" <?php if ( !isset($_POST['add_task']) ):?> hidden <?php endif;?> id="task_add">
  <button class="modal__close" type="button" name="button" href="/">Закрыть</button>

  <h2 class="modal__heading">Добавление задачи</h2>

  <form class="form"  action="index.php" method="post" enctype="multipart/form-data">
    <div class="form__row">
      <label class="form__label" for="title">Название <sup>*</sup></label>

      <input class="form__input <?php if ( (isset($errors['title_add'])) ):?> form__input--error <?php endif;?>" type="text" name="title" id="title" value="" placeholder="Введите название">
      <?php if ( ( isset($_POST['add_task']) && $errors['title_add'] ) ):?> <p class="form__message"><?=$errors['title_add']?></p> <?php endif;?>
    </div>

    <div class="form__row">
      <label class="form__label" for="project">Проект <sup>*</sup></label>

      <select class="form__input form__input--select" name="project_id" id="project" value="<?=$id?>">
        <?php foreach ($projects as $key => $val): ?>
          <option value="<?=$val['id']?>"><?=$val['project_name']?></option>
         <?php endforeach; ?>
      </select>
    </div>

    <div class="form__row">
      <label class="form__label" for="date">Срок выполнения</label>

      <input class="form__input form__input--date" value="<?=$exec?>" type="text" name="execution" id="date"
             placeholder="Введите дату">
    </div>

    <div class="form__row">
      <label class="form__label" for="preview">Файл</label>

      <div class="form__input-file">
        <input class="visually-hidden" type="file" name="file" id="preview" value="">

        <label class="button button--transparent" for="preview">
            <span>Выберите файл</span>
        </label>
      </div>
    </div>

    <div class="form__row form__row--controls">
      <input class="button" type="submit" name="add_task" value="Добавить">
    </div>
  </form>
</div>
