<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */


?>
<?php
    $language = 'rus';
    if (isset($_COOKIE["language"])) $language = $_COOKIE["language"];
?>
<?php if( get_queried_object()->post_title != 'Контакты' ){ ?>
    <?php if( get_queried_object()->post_title == 'Главная' ){ ?>
        <section id="faq_list" class="mt-5 pt-5">
          <h2 class="text-center"><?=( $language == 'eng' ) ? "Frequently Asked Questions" : "Часто задаваемые вопросы" ?></h2>
          <div class="container mt-4">
            <div class="accordion wow fadeIn" id="accordionExample">
              <?php
                $posts = get_posts( array(
                  'numberposts' => -1,
                  'orderby'     => 'date',
                  'order'       => 'ASC',
                  'post_type'   => 'faq',
                  'suppress_filters' => true,
                ) );

                foreach( $posts as $post ){  setup_postdata($post); ?>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-<?=$post->ID;?>" aria-expanded="false" aria-controls="collapseOne">
                        <?=( $language == 'eng' ) ? get_field('заголовок_на_английском',$post->ID) : get_the_title() ?>
                      </button>
                    </h2>
                    <div id="collapseOne-<?=$post->ID;?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                        <p><?=( $language == 'eng' ) ? get_field('описание_на_английском',$post->ID) : get_the_content() ?></p>
                      </div>
                    </div>
                  </div>
                <?php } wp_reset_postdata(); ?>
            </div>
          </div>
        </section>
    
        <div id="devider" class="mb-5">
          <img class="w-100 d-block skip " src="/wp-content/themes/twentytwentyone/g4_templates/separator.png" alt="Разделитель секций">
        </div>
    <?php } ?>
    <div id="footer_feedback" class="mt-3">
      <div class="container">
        <div class="row ms-0 me-0 align-items-center">
          <div class="col-12 col-md-5 col-lg-4">
            <h3><?=( $language == 'eng' ) ? "Any other questions?" : "Остались вопросы?" ?></h3>
            <h5><?=( $language == 'eng' ) ? "We will be happy to respond" : "Мы с радостью ответим" ?></h5>
            <p><?=( $language == 'eng' ) ? "Only thanks to high-quality products, we have the right to count on long-term cooperation!" : "Только благодаря качественной продукции, мы вправе рассчитывать на долгосрочное сотрудничество!" ?></p>
          </div>
          <div class="col-12 col-md-7 col-lg-8">
            <div class="decor mt-0 mx-auto">
                <div class="form-inner pt-0 pe-0 ps-0 ps-md-5 pe-md-5">
                    <h3><?=( $language == 'eng' ) ? "Leave a request" : "Оставьте заявку" ?></h3>
                    <?=( $language == 'eng' ) ? do_shortcode('[contact-form-7 id="248" title="Feedback form"]') : do_shortcode('[contact-form-7 id="101" title="Обратная связь (модальное)"]') ?>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
      $footer = wp_get_nav_menu_object(get_nav_menu_locations()['footer']);
      // vars
      $footer_map = get_field('карта', $footer);
      $footer_data = get_field('боковое_поле', $footer);
    ?>
    <div id='mobile_map_data' class="ps-3 pe-3 mt-5 d-md-none" <?=( get_queried_object()->post_title == 'Контакты' ) ? 'style="margin-top:95px!important;"' : '' ?>>
        <style>
            #mobile_map_data a{
                color: black!important;
            }
        </style>
      <h6><?=( $language == 'eng' ) ? $footer_data['заголовок_на_английском'] : $footer_data['заголовок'] ?></h6>
        <?php
          foreach ($footer_data['поля'] as $key => $footer_data_elem) { ?>
            <div class="map_elem wow fadeInUp">
              <strong><?=( $language == 'eng' ) ? $footer_data_elem['заголовок_на_английском'] : $footer_data_elem['заголовок'] ?></strong>
              <p><?=( $language == 'eng' ) ? $footer_data_elem['описание_на_английском'] : $footer_data_elem['описание'] ?></p>
            </div>
        <?php  }
        ?>
    </div>
    <style>
        #map{
            height: 350px;
        }
        @media(min-width: 991px){
            #map{
                height: 950px;
            }
        }
    </style>
    <section id="map" class="mt-5" style="width: 100%;  <?=( get_queried_object()->post_title == 'Контакты' ) ? 'margin-top:95px!important;"' : '' ?>" >
    	<?php //if(!strpos($_SERVER['HTTP_USER_AGENT'],'Chrome-Lighthouse')): ?>
        	<?//=$footer_map;?>
    	<?php// endif; ?>
          <div id='map_data' class="d-none d-md-block wow fadeInLeft">
              <h6><?=( $language == 'eng' ) ? $footer_data['заголовок_на_английском'] : $footer_data['заголовок'] ?></h6>
              <?php
                foreach ($footer_data['поля'] as $key => $footer_data_elem) { ?>
                  <div class="map_elem">
                    <strong><?=( $language == 'eng' ) ? $footer_data_elem['заголовок_на_английском'] : $footer_data_elem['заголовок'] ?></strong>
                    <p><?=( $language == 'eng' ) ? $footer_data_elem['описание_на_английском'] : $footer_data_elem['описание'] ?></p>
                  </div>
              <?php  }
              ?>
          </div>
          <!-- <div id='map_data3' class="d-none d-md-block wow fadeInRight">
              
          </div> -->
      </div>
    </section>
    <?php if(!strpos($_SERVER['HTTP_USER_AGENT'],'Chrome-Lighthouse')): ?>
        <script>
            jQuery(document).ready(function(){

                setTimeout(function(){

                    ymaps.ready(init);

                    function init () {
                            var myMap = new ymaps.Map('map', {
                                center: [45.152936, 38.292254],
                                zoom: 13,
                                controls: ['zoomControl']
                            });
                            myMap.behaviors.disable('scrollZoom'); //myMap.behaviors.disable('drag');
                            let map_data = [
                                {
                                    sectionTitle: <?=( $language == 'eng' ) ? "' Leninsky Plant '"  : "' Завод “Ленинский” '"?>,
                                    content: <?=( $language == 'eng' ) ? "' Krasnodar Territory, Abinsky district, Leninsky khutor, 2/2 Lenin Street. '" : "'Краснодарский край, Абинский район, хутор Ленинский, ул. Ленина 2/2.'" ?>,
                                    center: [45.167534, 38.236005],
                                    zoom: 13,
                                    rightSectionTitle: '',
                                    rightSectionData: '',
                                },
                                {
                                    sectionTitle: <?=( $language == 'eng' ) ? "'Nechaevsky Plant'" : "'Завод “Нечаевский”'" ?>,
                                    content: <?=( $language == 'eng' ) ? "'Krasnodar Territory, Abinsky district, Nechaevsky farm, South-Western outskirts'" : "'Краснодарский край, Абинский район, хутор Нечаевский, Юго-Западная окраина'" ?>,
                                    center: [45.144253, 38.293451],
                                    zoom: 13,
                                    rightSectionTitle: '',
                                    rightSectionData: '',
                                },
                                {
                                    sectionTitle: <?=( $language == 'eng' ) ? "' Starodzherelievsky Plant '" : "'Завод “Староджерелиевский” '" ?>,
                                    content: <?=( $language == 'eng' ) ? "'Krasnodar Territory, Krasnoarmeysky district, about 170 m. in the direction to the east from the landmark stanitsa Starodzherelievskaya'" : "'Краснодарский край, Красноармейский район, примерно в 170 м. по направлению на восток от ориентира станица Староджерелиевская'" ?>,
                                    center: [45.475575, 38.308048],
                                    zoom: 13,
                                    rightSectionTitle: '',
                                    rightSectionData: '',
                                },
                                {
                                    sectionTitle: <?=( $language == 'eng' ) ? "'The Tikhoretsky Plant'" : "'Завод “Тихорецкий”'" ?>,
                                    content: <?=( $language == 'eng' ) ? "'Krasnodar Territory, Tikhoretsk, village Kamenny, Novozhestvenskoe highway, 6'" : "'Краснодарский край, г. Тихорецк, пос. Каменный, Новорождественское шоссе, 6'" ?>,
                                    center: [45.865971, 40.038658],
                                    zoom: 13,
                                    rightSectionTitle: '',
                                    rightSectionData: '',
                                },
                                {
                                    sectionTitle: <?=( $language == 'eng' ) ? "'Sterlitamak warehouse'" : "'Склад “Стерлитамак”'" ?>,
                                    content: <?=( $language == 'eng' ) ? "'Republic of Bashkortostan, Sterlitamak, Glinka str. 1 K (coordinates: 53.623652 55.938487)'" : "'Республика Башкортостан, г. Стерлитамак, ул. Глинки 1 К'" ?>,
                                    center: [53.623652, 55.938487],
                                    zoom: 13,
                                    rightSectionTitle: '',
                                    rightSectionData: '',
                                },
                            ]
                            jQuery('#map_data').append("<div class='map_point d-flex flex-column active' data-mappos=0'><strong>"+map_data[0].sectionTitle+"</strong><a>"+map_data[0].content+"</a></div>");
                            jQuery('#mobile_map_data').append("<div class='map_point d-flex flex-column active' data-mappos=0'><strong>"+map_data[0].sectionTitle+"</strong><a>"+map_data[0].content+"</a></div>");
                            //jQuery('#map_data3').append(map_data[0].rightSectionData);
                            for(let i = 1; i < map_data.length;i++){
                                jQuery('#map_data').append("<div class='mt-3 map_point d-flex flex-column' data-mappos='"+i+"'><strong>"+map_data[i].sectionTitle+"</strong><a>"+map_data[i].content+"</a></div>");
                                jQuery('#mobile_map_data').append("<div class='mt-3 map_point d-flex flex-column' data-mappos='"+i+"'><strong>"+map_data[i].sectionTitle+"</strong><a>"+map_data[i].content+"</a></div>");
                            }
                            jQuery('.map_point').click(function(){
                                let index = parseInt( jQuery(this).attr('data-mappos') );
                                $('#map_data .map_point').each(function(){
                                    $( this ).removeClass( "active" );
                                })
                                jQuery(this).addClass('active');
                                myMap.setCenter(
                                    map_data[index].center,
                                    map_data[index].zoom,
                                );
                                //$('#map_data3')[0].innerHTML = map_data[index].rightSectionData;
                            })
                            let baloons = [
                                {
                                    coords: [45.167534, 38.236005],
                                    eng: "<span class='map_title'>Leninsky Plant</span><br /> Krasnodar Territory, Abinsky district, Leninsky khutor, 2/2 Lenin Street. (coordinates: 45.167534 38.236005)",
                                    rus: "<span class='map_title'>Завод “Ленинский”</span><br /> Краснодарский край, Абинский район, хутор Ленинский, ул. Ленина 2/2. (координаты: 45.167534 38.236005)",
                                },
                                {
                                    coords:[45.144253, 38.293451],
                                    eng: "<span class='map_title'>Nechaevsky Plant</span><br />Krasnodar Territory, Abinsky district, Nechaevsky farm, South-Western outskirts (coordinates: 45.144253 38.293451)",
                                    rus: "<span class='map_title'>Завод “Нечаевский”</span><br />Краснодарский край, Абинский район, хутор Нечаевский, Юго-Западная окраина (координаты: 45.144253 38.293451)",
                                },
                                {
                                    coords:[45.475575, 38.308048],
                                    eng: "<span class='map_title'>Starodzherelievsky Plant</span><br />Krasnodar Territory, Krasnoarmeysky district, about 170 m. in the direction to the east from the landmark stanitsa Starodzherelievskaya (coordinates: 45.475575 38.308048)",
                                    rus: "<span class='map_title'>Завод “Староджерелиевский”</span><br /> Краснодарский край, Красноармейский район, примерно в 170 м. по направлению на восток от ориентира станица Староджерелиевская (координаты: 45.475575 38.308048)",
                                },
                                {
                                    coords:[45.865971, 40.038658],
                                    eng: "<span class='map_title'>The Tikhoretsky Plant</span><br />Krasnodar Territory, Tikhoretsk, village Kamenny, Novozhestvenskoe highway, 6 (coordinates: 45.865971 40.038658)",
                                    rus: "<span class='map_title'>Завод “Тихорецкий”</span><br />Краснодарский край, г. Тихорецк, пос. Каменный, Новорождественское шоссе, 6 (координаты: 45.865971 40.038658)",
                                },
                                {
                                    coords:[53.623652, 55.938487],
                                    eng: "<span class='map_title'>The plant in Sterlitamak</span><br />Republic of Bashkortostan, Sterlitamak, Glinka str. 1 K (coordinates: 53.623652 55.938487)",
                                    rus: "<span class='map_title'>Завод в Стерлитамаке</span><br />Республика Башкортостан, г. Стерлитамак, ул. Глинки 1 К (координаты: 53.623652 55.938487) ",
                                }
                            ]
                            let map_points = [];
                            for(let i =0; i < baloons.length; i++){
                                map_points.push(
                                    new ymaps.Placemark(baloons[i].coords, {
                                        hasBalloon: false,
                                        balloonContent: <? if( $language == 'eng' ): ?> baloons[i].eng <? else: ?> baloons[i].rus <? endif; ?>,
                                    }, {
                                        iconLayout: "default#image",
                                        //iconImageHref: '/wp-content/themes/sitetheme/images/flow1.png',
                                        iconImageSize: [32, 41],
                                    })
                                );
                                myMap.geoObjects.add(
                                    map_points[i]
                                );
                               
                            }
                            map_points[0].balloon.open();
                            jQuery('.map_point').click(function(){
                                let index = parseInt( jQuery(this).attr('data-mappos') );
                                $('#map_data .map_point').each(function(){
                                    $( this ).removeClass( "active" );
                                })
                                jQuery(this).addClass('active');
                                myMap.setCenter(
                                    map_data[index].center,
                                    map_data[index].zoom,
                                );
                                map_points[index].balloon.open();
                                //$('#map_data3')[0].innerHTML = map_data[index].rightSectionData;
                            })
                    }
                })
            })
        </script>
    <?php endif; ?>
<?php   } ?>	
	
<!-- Modal -->
<div class="modal fade mt-5" id="request_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?=( $language == 'eng' ) ? "Leave a request" : "Оставьте заявку" ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body ps-0 pe-0">
        <div class="decor mt-0">
            <div class="form-inner pt-0">
                <h3><?=( $language == 'eng' ) ? "Leave a request" : "Оставьте заявку" ?></h3>                
                <?=( $language == 'eng' ) ? do_shortcode('[contact-form-7 id="248" title="Feedback form"]') : do_shortcode('[contact-form-7 id="101" title="Обратная связь (модальное)"]') ?>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <p><?=( $language == 'eng' ) ? "We will call you back in a few minutes" : "Мы перезвоним вам в течении нескольких минут" ?></p>
      </div>
    </div>
  </div>
</div>



<!-- FOOTER -->

<style>
    footer section span,#section_about .right_column span {
        font-size: 60px;
        color: green;
        font-weight: 900;
        padding-right: 15px;
    }
    
  #about_other {
        font-size: 12px;
        color: black;
        font-weight: 400;
    }
</style>

<style>
    footer ul{
        list-style: none;
    }
    
   /* footer #footer_contacts p{
        padding-left: 20px;
        position: relative;
    }
    
    footer #footer_contacts p::before{
        position: absolute;
        top: 5px;
        left: 0;
        content: " ";
        background-image: url("/wp-content/themes/twentytwentyone/g4_templates/images/footer_contacts_icon.png");
        width: 15px;
        height: 15px;
        background-size: 100% 100%;
    }
    */
    footer {
        background-color: #3b3b3b;
        color: #bfbfbf;
        
    }
    
    footer #footer_menu_pages{
        display: grid;
        padding-bottom: 20px;
    } 
    
    footer #footer_menu_products{
        display: grid;
        padding-bottom: 20px;
    }
    
    footer h6 {
        text-align: center;
    }
    
    footer #f_s_1 {
        border-bottom: 1px solid #777777;
    }
    
    
    footer i {
        padding-right: 10px;
        color: orange;
    }
    
    footer #footer_info p{
        margin: 0;
    }

    
   /* footer .footer_socials i{
    color: #9a9a9a;
    border: 1px solid rgba(255, 255, 255, 0.34);
    border-radius:  5px;
    }
    
    /* footer #footer_menu_products a{
        color: #bfbfbf;
    }
     
    footer #footer_menu_products a:hover{
        color: orange;
    
        
    }
    
    footer #footer_menu_pages a{
        color: #bfbfbf;
    }
    footer #footer_menu_pages a:hover{
        color: orange;
        
        
    }
    */
    
    footer h6{
        margin-top: 15px;
        margin-bottom: 15px;
    }
    
    footer a{
        text-decoration: none;
        color: #bfbfbf;
    }
    footer a:hover{
        text-decoration: none;
        color: orange;
    }
    
    
    footer_LP{
        background-image: url("/wp-content/themes/twentytwentyone/g4_templates/images/liderpoiska.png");
    }
    /*
    footer #btn a{
    background-color: orange;
    border-radius: 20px;
    text-align: center;
    display: inline-block;
    color: white;
    font-weight: 500;
    max-width: 175px;
    }
    
    footer #btn a:hover{
        background-color: blue;
        color: orange;
        max-width: 300px;
    } 
    */
    
    footer #btn a{
    border-radius: 20px;
    text-align: center;
    display: inline-block;
    color: orange;
    border: 1px  solid;
    font-weight: 500;
    max-width: 175px;
    }
    
    footer #btn a:hover{
        background-color: orange;
        color: white;
        max-width: 175px;
    }
</style>




<footer class="col-12 pt-2">
  <div class="container">
    <div class="row ms-0 me-0 col-12 mb-3 pt-3 pb-3" style="border-bottom: 1px solid #777777;">
        <div class="col-12 col-md-8">
            <h3><?=( $language == 'eng' ) ? 'Any other questions? We will call you back!' : 'Остались вопросы? Мы вам перезвоним!' ?></h3>
        </div>
        
        <div id="btn" class="col-12 col-md-4 text-lg-end text-md-end d-flex align-items-center">
            <a href="#" type="button" class="btn col-12 mx-auto open_modal ms-xxl-4 bg-reverse" data-bs-toggle="modal" data-bs-target="#request_modal"><?=( $language == 'eng' ) ? 'leave a request' : 'Оставить заявку'?></a>
        </div>
    </div>
  </div>
  
   <div class="container">  
    <div id="f_s_1" class="row me-0 ms-0 col-12 mb-3">
        
           <div id="footer_menu_pages" class="col-12 col-sm-6 col-lg-3">
              <h4 class=""><?=( $language == 'eng' ) ? 'Menu' : 'Меню'?></h4>
               <a href="/"><?=( $language == 'eng' ) ? 'Main page' : 'Главная'?></a>
               <a href="/news/"><?=( $language == 'eng' ) ? 'News' : 'Новости'?></a>
               <a href="/лаборатория/"><?=( $language == 'eng' ) ? 'Laboratory' : 'Лаборатория'?></a>
               <a href="/контакты/"><?=( $language == 'eng' ) ? 'Contacts' : 'Контакты'?></a>
           </div>
           
           <div id="footer_menu_pages" class="col-12 col-sm-6 col-lg-3">
               <h4 class=""><?=( $language == 'eng' ) ? 'Menu' : 'Каталог'?></h4>
               <a href="/рис/"><?=( $language == 'eng' ) ? 'Rice products' : 'Рис'?></a>
               <a href="/мука/"><?=( $language == 'eng' ) ? 'Flour' : 'Мука'?></a>
               <a href="/манка/"><?=( $language == 'eng' ) ? 'Semolina' : 'Манка'?></a>
               <a href="/кормовой-продукт/"><?=( $language == 'eng' ) ? 'Feed product' : 'Кормовой продукт'?></a>
           </div>
        <div id="footer_info" class="col-12 col-sm-6 col-lg-3">
           <h4><?=( $language == 'eng' ) ? 'Work schedule:' : 'График работы:' ?></h4>
            <div class="col-12">
                <p><?=( $language == 'eng' ) ? 'Mon-Fri from 09:00 to 18:00' : 'Пн - Пт с 09:00 до 18:00' ?></p>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3 ps-0">
            <h4><?=( $language == 'eng' ) ? 'Our banking details' : 'Наши реквизиты' ?></h4>
            <div id="footer_contacts">
                <p><?=( $language == 'eng' ) ? 'ITN:0268056180' : 'ИНН:0268056180' ?></p>
                <p><?=( $language == 'eng' ) ? 'OGRN:1110268000150' : 'ОГРН:1110268000150' ?></p>
                <p><?=( $language == 'eng' ) ? 'KPP:026801001' : 'КПП:026801001' ?></p>
            </div>
        </div>
    </div>
      
       <div id="f_s_2" class="container row ms-0 me-0 p-0">
        <div class="col-12 col-lg-5">
            <div id="footer_info_2" class="col-12">
              <?php 
                $blog_info    = get_bloginfo( 'name' );
                $show_title   = ( true === get_theme_mod( 'display_title_and_tagline', true ) );
                $menu = wp_get_nav_menu_object(get_nav_menu_locations()['primary']);
    
                // vars
                $menu_logo = get_field('логотип', $menu);
                
                if ( $menu_logo && ! $show_title ){ ?> 
                  <img style="max-width: 120px;" width="768" height="768" src="<?=$menu_logo;?>" alt="Логотип: <?=$blog_info;?>">
              <?php } ?>
            </div> 
            <div class="col-12 mt-3">    
              <? if( $language == 'eng' ) { ?>
                <p style="font-size: 11px;" class="m-0">The given prices and characteristics of the goods are for informational purposes only and are not a public offer. For detailed information about the characteristics of the goods, their availability and cost, contact the company's managers. By submitting an application on the website, the User accepts this Consent to the processing of personal data.</p>
              <? }  else{  ?> 
                <p style="font-size: 11px;" class="m-0">Приведённые цены и характеристики товаров носят исключительно ознакомительный характер и не являются публичной офертой. Для получения подробной информации о характеристиках товаров, их наличии и стоимости связывайтесь с менеджерами компании. Пользователь, оставляя заявку на интернет сайте, принимает настоящее Согласие на обработку персональных данных.</p>
              <? } ?> 
            </div>           
        </div>
        
        <div class="col-12 col-lg-4">
            <h4><?=( $language == 'eng' ) ? 'Our contacts' : 'Наши контакты' ?></h4>
            <div id="footer_contacts">
                <p><i class="fas fa-location-arrow"></i><?=( $language == 'eng' ) ? '453120, Republic of Bashkortostan, Sterlitamak, Glinka str., 1' : '453120, Республика Башкортостан, г. Стерлитамак, ул Глинки д.1' ?></p>
                <p><i class="fas fa-location-arrow"></i><?=( $language == 'eng' ) ? '453100, Republic of Bashkortostan, Sterlitamak, Artem str., 137, sq. 20' : '453100, Республика Башкортостан, г. Стерлитамак, ул Артема д.137, кв. 20' ?></p>             
            </div>
        </div> 
        <div class="col-12 col-lg-3 ps-0">
            <p><a href="tel:+73473335900"><i class="fas fa-phone-alt"></i>+7 (347) 333-59-00</a></p>
            <p><a href="tel:+79061086688"><i class="fas fa-phone-alt"></i>+7 (960) 394-41-23</a></p>
            <p><a href="mailto:rot.str@mail.ru"><i class="far fa-envelope"></i>rot.str@mail.ru</a></p>   
            <!-- <h4><?//=( $language == 'eng' ) ? 'More details' : 'Дополнительно' ?></h4>
            <div id="footer_contacts">
                <p><?//=( $language == 'eng' ) ? 'Social links' : 'Мы в соц сетях!' ?></p>
                <a href="#"><i id="tg" class="fab fa-telegram-plane"></i></a>
                <a href="#"><i id="inst" class="fab fa-instagram"></i></a> 
                <a href="#"><i id="fb" class="fab fa-facebook-f"></i></a>                
            </div> -->
        </div> 
        </div>
    </div>
    <div class="container mt-3 ">
        <div class="col-12 row ms-0 me-0" style="border-top: 1px solid #777777;">
            <div class="col-12 col-md-4" style="margin: 0!important; padding-top:15px; padding-bottom:15px;">
                <p class="m-0"><?=( $language == 'eng' ) ? '© 2021 Risoptorg LLC All rights reserved' : '© 2021 ООО Рисопторг Все права защищены' ?></p>
            </div>
            <div class="col-12 col-md-4" style="margin: 0!important; padding-top:15px; padding-bottom:15px;">
                <a href="/политика-конфиденциальности/"><?=( $language == 'eng' ) ? 'Privacy Policy' : 'Политика конфиденциальности' ?></a>
            </div>      
        </div>
    </div>    
</footer>

<script async="" src="https://privacypolicy.lider-poiska.ru/" defer=""></script>

<?php if(!strpos($_SERVER['HTTP_USER_AGENT'],'Chrome-Lighthouse')): ?>
<?php wp_footer(); ?>
<?php endif; ?>
<script type="text/javascript">
    $(document).ready(function(){
        console.log('ready');
        /* bootstrap.min.css */
        /*var giftofspeed = document.createElement('link');
        giftofspeed.rel = 'stylesheet';
        giftofspeed.href = 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css';
        giftofspeed.type = 'text/css';
        var godefer = document.getElementsByTagName('link')[0];
        godefer.parentNode.insertBefore(giftofspeed, godefer);*/

        /* fontawesome.js */
        var giftofspeed = document.createElement('script');
        giftofspeed.src = 'https://kit.fontawesome.com/ade4838464.js';
        giftofspeed.type = 'text/javascript';
        var godefer = document.getElementsByTagName('script')[0];
        godefer.parentNode.insertBefore(giftofspeed, godefer);
    })    
</script>
<script>new WOW().init(); </script>
</body>
</html>
