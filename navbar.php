<?php ?>


<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">


    <a class="navbar-brand" href="javascript:void(0)">Logo</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb" aria-expanded="true">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse show" id="navb" style="">

        <?php 
        $menu = new MenuBuilder();
        echo htmlspecialchars_decode($menu->get_menu_html());
        ?>

        <form class="form-inline my-2 my-lg-0" method="get" action="search.php">
            <input name="s" class="form-control mr-sm-2" type="text" placeholder="جستجو" autocomplete="off">
            <button class="btn btn-success my-2 my-sm-0" type="submit">برو</button>
        </form>

    </div>





</nav>
