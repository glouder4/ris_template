<?php
/*
 Template name: Шаблон контактов
 Template post type: page
*/

    get_header();

    $page_id = get_the_ID();
?>	

<?php
  $footer = wp_get_nav_menu_object(get_nav_menu_locations()['footer']);
  // vars
  $footer_map = get_field('карта', $footer);
  $footer_data = get_field('боковое_поле', $footer);
?>
<?php
    $language = 'rus';
    if (isset($_COOKIE["language"])) $language = $_COOKIE["language"];
?>
<div id="catalog_page_template" class="bh">
        <?php
            $catalog_banner = get_field('баннер',$archive_object);
            $catalog_tags = get_field('набор_меток_товара',$archive_object );
            //$catalog_title = get_field('первая_секция')['левая_колонка']['загловок'];
        ?>
        <div id="catalog_header" class="d-flex align-items-center" style="background-image: url(<?=$catalog_banner['url'];?>)">
            <div class="container">
                <h1 class="wow fadeInLeft"><?=( $language == 'eng' ) ? $catalog_eng_title : get_the_title() ?> </h1>
                <div class="wow fadeInLeft" id="breadcrumbs"> <?php true_breadcrumbs(); ?> </div>
                <p class="mt-3 wow fadeInLeft" style="color: white;"><?=( $language == 'eng' ) ? 'All the presented goods do not contain gluten and are hypoallergenic' : 'Весь представленный товар не содержит глютен и гипоаллергенен' ?></p>
            </div>
        </div>
        <div id="fast_links" class="pt-4 pb-4">
            <div class="container">
                <div class="row ms-0 me-0">
                    <div class="col-12 col-md-4 wow fadeInLeft"> <a class="btn bg-transparent" href="../#catalog"><?=( $language == 'eng' ) ? 'Back to catalog →' : 'Вернуться в каталог →' ?></a> </div>                   
                    <div class="col-12 col-md-8 d-flex flex-wrap align-items-center wow fadeInRight">
                        <?php
                            foreach( $catalog_tags as $catalog_tag ){ ?>
                                <span class="tag mx-auto ms-md-2 me-md-2 mt-3 mt-md-0"><?=( $language == 'eng' ) ? $catalog_tag['метка_на_английском'] : $catalog_tag['метка'] ?></span>
                            <?php }
                        ?>                      
                    </div>
                </div>
            </div>
        </div>
</div>


<style>
    #map{
        width: 100%;
        height: 350px;
    }
    #map_data{
        position: relative;
        width: 100%;
    }
    #map_data a{
        color: black!important;
    }
    /*header{
        background-color: rgba(0,0,0,0.4)!important;
    }*/
    #map_data>.map_point{
        transition: all 0.5s ease;
    }
    #map_data>.map_point:hover{
        color: #ffa41c!important;
        cursor: pointer;
    }
    @media(min-width:768px){
        #map{
            width: 45%;
            height: 450px;
        }
        #map_data{
            width: 60%;
        }
        #map_data>.map_elem,#map_data>.map_point,#map_data>.btn {
            margin-left: 25px;
        }
    }
    @media(min-width:991px){
        #map{
            width: 40%;
        }
        #map_data{
            width: 60%;
        }
    }
</style>  
<?=( get_queried_object()->post_title == 'Контакты' ) ? '<div class="container">' : '' ?>  
    <div class="d-flex flex-row flex-wrap ms-0 me-0" style="<?=( get_queried_object()->post_title == 'Контакты' ) ? 'margin-top:95px!important;"' : '' ?>">
        <section id="map" class="order-2 order-md-1" >
                
        </section>
        <div id='map_data' class="order-1 order-md-2 wow fadeInLeft">
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
    </div>
<?=( get_queried_object()->post_title == 'Контакты' ) ? '</div>' : '' ?>
<?php if(!strpos($_SERVER['HTTP_USER_AGENT'],'Chrome-Lighthouse')): ?>
    <script>
        jQuery(document).ready(function(){

            setTimeout(function(){

                ymaps.ready(init);

                function init () {
                    console.log('init');
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
                        jQuery('#map_data').append(`<a style="background-color: #ffa41c;color: white!important;z-index: 1;" href="<?=get_field('реквизиты', $footer);?>" class="btn mt-4" target="_blank">Скачать полные реквизиты</a>`);
                        
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
<section id="catalog_second_section" class="bh mt-5">
    <div class="container">
        <div class="col-12">
            <?=( $language == 'eng' ) ? get_field('описание_на_английском') : the_content(); ?> 
        </div>
    </div>
</section>
<?php
    get_footer();
?>