##### Ссылка на рабочий проект http://shop.fixable.org.ua
## Как использовать Onlinestore
1. Поменять параметры db_params.php (*config/db_params.php*)
2. Импортировать файл базы данных **localshop.sql**
3. Для доступа в админку нужно перейти по ссылке `*/admin/` (где * - текущий URL) в качестве админа. Логин: `admin@admin.ru`. Пароль: `123123`.
## Пересборка проекта
1. Загрузить все зависимости с помощью **npm i**
2. Поменять проксирование в файле **gulpfile.js** (*gulp/gulpfile.js*)
```
gulp.task('browser-sync', function() {
browserSync({
logSnippet: true,
proxy: "localshop", // Заменить на имя своего виртуального хоста
notify: true,

// tunnel: true,
// tunnel: "projectmane", //Demonstration page: http://projectmane.localtunnel.me
});
});
```
3. Опционально поменять пути при добавлении новых библиотек
```
'../web/libs/jquery/jquery-3.3.1.min.js',
'../web/libs/owl.carousel/owl.carousel.min.js',
'../web/libs/mmenu/jquery.mmenu.all.js',
'../web/libs/svg4everybody/svg4everybody.min.js',
'../web/js/admin.min.js',
```
4. Запускать с помощью команды **gulp** в директории с gulpfile.js
