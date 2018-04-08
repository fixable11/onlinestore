<?php

/*
 * Класс для генерации постраничной навигации
 */
class Pagination
{

    /**
     * 
     * @var Ссылок навигации на страницу
     * 
     */
    private $max = 7;

    /**
     * 
     * @var Ключ для GET, в который пишется номер страницы
     * 
     */
    private $index = 'page';

    /**
     * 
     * @var Текущая страница
     * 
     */
    private $current_page;

    /**
     * 
     * @var Общее количество записей
     * 
     */
    public $total;

    /**
     * 
     * @var Записей на страницу
     * 
     */
    private $limit;

    /**
     * Запуск необходимых данных для навигации
     * @param integer $total - общее количество записей
     * @param integer $limit - количество записей на страницу
     * 
     * @return
     */
    
    private $getPagination;

    public function __construct($total, $currentPage, $limit, $index, $getPagination = false)
    {
        # Устанавливаем общее количество записей
        $this->total = $total;

        # Устанавливаем количество записей на страницу
        $this->limit = $limit;

        # Устанавливаем ключ в url
        $this->index = $index;

        # Устанавливаем количество страниц
        $this->amount = $this->amount();

        # Устанавливаем номер текущей страницы
        $this->setCurrentPage($currentPage);

        $this->getPagination = $getPagination ? true : false;
    }

    /**
     *  Для вывода ссылок
     * 
     * @return HTML-код со ссылками навигации
     */
    public function get()
    {
        $links = null;

        $limits = $this->limits();

        $html = '<ul class="paginationBox__items">';

        for ($page = $limits[0]; $page <= $limits[1]; $page++) {

            

            if($limits[1] != $this->amount){
                if($page == $limits[1]){
                    $links .= $this->generateHtml($this->amount);
                    continue;
                }

                if($page == $limits[1] - 1){
                    $links .= $this->generateHtml('...');

                    continue;
                }

            }
            if($this->amount > $this->max){

                if(($this->current_page >= ceil($this->max/2) + 1) && $page == $limits[0]){
                 $links .= $this->generateHtml(1);
                 continue;
                }

                if(($this->current_page >= ceil($this->max/2) + 1) && $page == $limits[0] + 1){
                 $links .= $this->generateHtml('...');
                 continue;
                }
            }
            # Если текущая это текущая страница, ссылки нет и добавляется класс active
            if ($page == $this->current_page) {
                $links .= $this->generateHtml($page, null, 'paginationBox__link paginationBox__link-active');
            } else {
                # Иначе генерируем ссылку
                $links .= $this->generateHtml($page);
            }
            
        }

        # Если ссылки создались
        if (!is_null($links)) {
            # Если текущая страница не первая
            if ($this->current_page == 1){

                $links = $this->generateHtml($this->current_page, '<svg
                class="paginationBox__leftArrowIcon">
                    <use xlink:href="/web/img/vectorsprites/fa.svg#angle-left" />
                </svg>', 'paginationBox__leftArrow') . $links;

            } else {
                $links = $this->generateHtml($this->current_page - 1, '<svg
                class="paginationBox__leftArrowIcon">
                    <use xlink:href="/web/img/vectorsprites/fa.svg#angle-left" />
                </svg>', 'paginationBox__leftArrow') . $links;

            }           
            
            if ($this->current_page == $this->amount){

                 $links .= $this->generateHtml($this->current_page, '<svg
                class="paginationBox__rightArrowIcon">
                    <use xlink:href="/web/img/vectorsprites/fa.svg#angle-right" />
                </svg>', 'paginationBox__rightArrow');

            } else {

                $links .= $this->generateHtml($this->current_page + 1, '<svg
                class="paginationBox__rightArrowIcon">
                    <use xlink:href="/web/img/vectorsprites/fa.svg#angle-right" />
                </svg>', 'paginationBox__rightArrow');

            }
        }

        $html .= $links . '</ul>';

        # Возвращаем html
        return $html;
    }

    /**
     * Для генерации HTML-кода ссылки
     * @param integer $page - номер страницы
     * 
     * @return
     */
    private function generateHtml($page, $text = null, $linkClass = 'paginationBox__link')
    {   
        # Если текст ссылки не указан
        if (!$text)
        # Указываем, что текст - цифра страницы
            $text = $page;

        if($page == '...'){
            $linkClass .= '-dots';
        }

        if($this->getPagination){
            $currentURI = rtrim($_SERVER['REQUEST_URI'], '/');
            if(!preg_match('~(&p=[1-9]+$)~', $currentURI)){
                $currentURI .= '&p=1';
            }
            
            $currentURI = preg_replace('~(&p=[1-9]+$)~', "&p={$page}", $currentURI);
    
        } else {

            $currentURI = rtrim($_SERVER['REQUEST_URI'], '/') . '/';

            if($this->index) {

                $currentURI = preg_replace('~/p-[0-9]+~', '', $currentURI);

            } else {
                $currentURI = preg_replace('~/[0-9]+~', '', $currentURI);
            }
        }

        
        # Формируем HTML код ссылки и возвращаем
        if($page == '...'){
           return 
                '<li class="paginationBox__item" ><a class="' . $linkClass . '" >' . $text . '</a></li>';
        }
        if($page == 1){
            if($this->getPagination){
                return 
                '<li class="paginationBox__item" ><a class="' . $linkClass . '" href="' . $currentURI .'/">' . $text . '</a></li>';
            } 
            return 
                '<li class="paginationBox__item" ><a class="' . $linkClass . '" href="' . $currentURI .'">' . $text . '</a></li>';
        }

        

        if($this->getPagination){
             return 
                '<li class="paginationBox__item" ><a class="' . $linkClass . '" href="' . $currentURI . '/' .'">' . $text . '</a></li>';
        }

        return
                '<li class="paginationBox__item" ><a class="' . $linkClass . '" href="' . $currentURI . $this->index . $page . '/' .'">' . $text . '</a></li>';
        
    }

    /**
     *  Для получения, откуда стартовать
     * 
     * @return массив с началом и концом отсчёта
     */
    private function limits()
    {
        # Вычисляем ссылки слева (чтобы активная ссылка была посередине)
        $left = $this->current_page - ceil($this->max / 2) - 1;
        
        # Вычисляем начало отсчёта
        $start = $left >= 0 ? $this->amount - $this->max - 1: 1;
            //$start + $this->max + 1 < $this->amount
            if ($this->current_page <= ceil($this->max/2) - 1){ // *-1*
            # Назначаем конец цикла вперёд на $this->max страниц или просто на минимум
               
                //$end = $start > 1 ? $start + $this->max: $this->max;
                $end = $this->max;
                //d($end);
            } else {

            # Конец - общее количество страниц
            //$start = $this->amount - $this->max-1 > 0 ? $this->amount - $this->max - 1 : 1;
            if($this->amount - $this->current_page <= ceil($this->max/2) - 1){
                $start = $this->amount - $this->max + 1; 
                $end = $this->amount;
            } else {
                $start = $this->current_page - ceil($this->max/2) + 1; 
                $end = $this->max + $start - 1;
            }
                   
        }

        # Возвращаем
        if($this->amount <= $this->max){
            $start = 1;
            $end = $this->amount;
        } 

        return
                array($start, $end);
    }

    /**
     * Для установки текущей страницы
     * 
     * @return
     */
    private function setCurrentPage($currentPage)
    {
        # Получаем номер страницы
        $this->current_page = $currentPage;

        # Если текущая страница боле нуля
        if ($this->current_page > 0) {
            # Если текунщая страница меньше общего количества страниц
            if ($this->current_page > $this->amount)
            # Устанавливаем страницу на последнюю
                $this->current_page = $this->amount;
        } else
        # Устанавливаем страницу на первую
            $this->current_page = 1;
    }

    /**
     * Для получеия общего числа страниц
     * 
     * @return число страниц
     */
    private function amount()
    {
        # Делим и возвращаем
        return ceil($this->total / $this->limit);
    }

}
