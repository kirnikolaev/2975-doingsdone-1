          <main class="content__main">
                <h2 class="content__main-heading">Список задач</h2>

                <form class="search-form" action="index.html" method="post">
                    <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

                    <input class="search-form__submit" type="submit" name="" value="Искать">
                </form>

                <div class="tasks-controls">
                    <nav class="tasks-switch">
                        <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
                        <a href="/" class="tasks-switch__item">Повестка дня</a>
                        <a href="/" class="tasks-switch__item">Завтра</a>
                        <a href="/" class="tasks-switch__item">Просроченные</a>
                    </nav>

                    <label class="checkbox">
                        <!--добавить сюда аттрибут "checked", если переменная $show_complete_tasks равна единице-->
                        <input class="checkbox__input visually-hidden show_completed" type="checkbox" <?php if ($show_complete_tasks == 1):?> checked <?php endif; ?>>

                        <span class="checkbox__text">Показывать выполненные</span>
                    </label>
                </div>

                <table class="tasks">
                    <?php foreach ($tasks_list as $key => $val): ?>
                           
                                <tr class="tasks__item task <?php if ($val['done'] == true): ?>task--completed<?php endif; ?><?=is_important_task($val['execution'])?>">
                                <td class="task__select <?php if ($val['done'] == true): ?>task--completed <?php endif; ?>">
                                    <label class="checkbox task__checkbox">
                                        <input class="checkbox__input visually-hidden" type="checkbox" <?php if ($val['done'] == true): ?>checked<?php endif; ?>>
                                        <span class="checkbox__text"><?=htmlspecialchars($val['title'])?></span>
                                    </label>
                                </td>
                            
                                            
                                <td class="task__date"><?=htmlspecialchars($val['execution'])?></td>
                                <td class="task__controls"></td>
                            </tr>
                            
       
                    <?php endforeach; ?>

                </table>
            </main>
        </div>
    </div>
</div>