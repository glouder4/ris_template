<?php
/*
 Template name: Шаблон внутренней страницы
 Template post type: page
*/

    get_header();

    $page_id = get_the_ID();
?>	
<?php
    $language = 'rus';
    if (isset($_COOKIE["language"])) $language = $_COOKIE["language"];
?>
    <style>
        #catalog_page_template img{
            width: inherit;
        }
    </style>
    <div id="catalog_page_template">
        <?php
            $catalog_banner = get_field('баннер');
            $catalog_banner_height = get_field('высота_баннера');
            $catalog_eng_title = get_field('первая_секция')['название_на_английском'];
        ?>
        <?php if(($catalog_banner_height != '')){ ?>
            <style>
                #catalog_header, #catalog_header::before{
                    height: <?=$catalog_banner_height;?>!important;
                }
            </style>
        <?php } ?>        
        <div id="catalog_header" class="d-flex align-items-center" style="background-image: url(<?=$catalog_banner['url'];?> ); ">
            <div class="container">
                <h1 class="wow fadeInLeft"><?=( $language == 'eng' ) ? $catalog_eng_title : get_the_title() ?> </h1>
                <div class="wow fadeInLeft" id="breadcrumbs"> <?php true_breadcrumbs(); ?> </div>
                <?php 
                    if( ($page_id != 356)&&($page_id != 39)&&($page_id != 346)&&($page_id != 350) ){ echo $page_id;?>
                        <p class="mt-3" style="color: white;"><?=( $language == 'eng' ) ? 'All the presented goods do not contain gluten and are hypoallergenic' : 'Весь представленный товар не содержит глютен и гипоаллергенен' ?></p>
                <?php   } ?>
            </div>
        </div>
        <section id="catalog_second_section" class="bh mt-5">
            <div class="container">
                <div class="col-12">
                    <?=( $language == 'eng' ) ? get_field('описание_на_английском') : the_content(); ?> 
                </div>
            </div>
        </section>
    </div>
<?php
    get_footer();
?>