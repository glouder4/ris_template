<?php
/*
 Template name: Шаблон главной страницы
 Template post type: page
*/

    get_header();


?>	
	<?php
		$fs_banner = get_field('первая_секция')['баннер'];
		$fs_title = get_field('первая_секция')['левая_колонка']['загловок'];
		$layout_under_title = get_field('первая_секция')['левая_колонка']['блок_под_заголовком'];

		$rightside_column = get_field('первая_секция')['правая_колонка'];

		$under_section = get_field('первая_секция')['нижняя_секция'];
	?>
    <?php
        $language = 'rus';
        if (isset($_COOKIE["language"])) $language = $_COOKIE["language"];
    ?>
    <section id="first_section" class="d-flex flex-column align-items-center justify-content-center pt-5" style="background-image: url(<?=$fs_banner['баннер_фото'];?>);">
			<div class="overlay"></div>
			<div style="position: absolute;width: 100%;height: 100%;z-index: 1;top: 0;left: 0;" class="video-background">
			    <div class="video-foreground" style="width: 100%; height: 100%;">
			    	<div id="bg_video"></div>			    	
			    </div>
			</div>
			<script>
				$(document).ready(function() {
					$('#first_section')[0].paddingTop = $('header').outerHeight()+'px';
					if( window.innerWidth >= 991 ){
						$('#first_section')[0].style.height = Math.round(window.innerWidth/1.7)+'px';
							$('#first_section>.overlay')[0].style.height = Math.round(window.innerWidth/1.7)+'px';
							setTimeout(function(){
								// 1. This code loads the IFrame Player API code asynchronously.
					      var tag = document.createElement('script');

					      tag.src = "https://www.youtube.com/iframe_api";
					      var firstScriptTag = document.getElementsByTagName('script')[0];
					      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

					      // 2. This function creates an <iframe> (and YouTube player)
					      //    after the API code downloads.
					      var player;
					      function onYouTubeIframeAPIReady() { console.log(Math.round(window.innerWidth/1.7));
					        player = new YT.Player('bg_video', {
					          height: Math.round(window.innerWidth/1.7),
					          width: window.innerWidth,
					          frameborder: '0',
					          playerVars: {
		                  autoplay: 1,
		                  loop: 1,
		                  controls: 0,
		                  showinfo: 0,
		                  autohide: 1,
		                  modestbranding: 1,
		                  vq: 'hd1080',
		                  playlist: 'LRk4f3mRwvI'//K0uzm7otiQQ видео с текстом
					           },
					          videoId: 'LRk4f3mRwvI',
					          events: {
					            'onReady': onPlayerReady,
					            'onStateChange': onPlayerStateChange
					          }
					        });
					      }

					      // 3. The API will call this function when the video player is ready.
					      function onPlayerReady(event) {
					      	player.mute();
					      	setTimeout(function(){
						        event.target.playVideo();
						      },500)			        
					      }

					      var done = false;
					      function onPlayerStateChange(event) {
					        
					      }
					      function stopVideo() {
					        player.stopVideo();
					      }

					      onYouTubeIframeAPIReady();
							},500)	
					}										
					});
			</script>	
    	<div class="container mt-5" style="position: relative;z-index: 3;">
    		<div class="row ms-0 me-0">
    			<div id="left_side_column" class="col-12 col-md-7 d-flex flex-column wow fadeInLeft">
    				<h1><?=( $language == 'eng' ) ? get_field('первая_секция')['левая_колонка']['заголовок_на_английском'] : $fs_title?></h1>
    				<div id="layout_under_title" style="border-color: <?=$layout_under_title['цвет_первого_текста'];?>">
    					<p style="color:<?=$layout_under_title['цвет_первого_текста'];?>"><?=( $language == 'eng' ) ? $layout_under_title['текст1_на_английском'] : $layout_under_title['текст1']?></p>
    					<p style="color:<?=$layout_under_title['цвет_второго_текста'];?>"><?=( $language == 'eng' ) ? $layout_under_title['второй_текст_на_английском'] : $layout_under_title['второй_текст']?></p>
    				</div>
    			</div>
    			<div id="right_side_column" class="col-12 col-md-5 d-flex flex-column mt-4 mt-md-0 justify-content-center wow fadeInRight">
    				<p><?=( $language == 'eng' ) ? $rightside_column['текст_над_кнопкой_на_английском'] : $rightside_column['текст_над_кнопкой']?></p>
    				<a <?=($rightside_column['кнопка_вызывает_форму'] == '1') ? 'data-bs-toggle="modal" data-bs-target="#request_modal"': '' ?> href="<?=$rightside_column['ссылка_на_кнопке'];?>" class="btn"><?=( $language == 'eng' ) ? $rightside_column['текст_на_кнопке_на_английском'] : $rightside_column['текст_на_кнопке']?></a>
    			</div>
    			<div id="under_section" class="mt-5 wow fadeIn">
    				<div class="row ms-0 me-0">
    					<div class="col-7 col-md-4 col-lg-3" id="under_section_title"><?=( $language == 'eng' ) ? $under_section['заголовок_секции_на_английском'] : $under_section['заголовок_секции']?> </div>
    					<div class="col"><hr /></div>
    				</div>
    				<div class="row ms-0 me-0 mt-5">
    					<?php foreach ($under_section['пункты_нижней_секции'] as $key => $under_section_elem) { ?>
    							<div class="under_section_elem col-12">
    								<span><?=( $language == 'eng' ) ? $under_section_elem['заголовок_на_английском'] : $under_section_elem['заголовок']?></span>
    								<p><?=( $language == 'eng' ) ? $under_section_elem['описание_на_английском'] : $under_section_elem['описание']?></p>
    							</div>
    					<?php } ?>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>
    <div class="d-md-none pt-3 pb-3">
    	<div class="container">
    		<iframe width="100%" height="315" src="<?=$fs_banner['баннер_видео'];?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    	</div>
    </div>
    <section id="second_section" class="bh mt-5 pt-5">
    	<div class="container" id="catalog">
    		<h2 class="text-center mb-3"><?=( $language == 'eng' ) ? "Our products" : "Наша продукция"?></h2>
    		<div class="row ms-0 me-0">
    			<?php    			
				$categories = get_terms('katalog');
				

				foreach( $categories as $post ){   
				 ?>
				    <div class="wow fadeInUp catalog_item col-12 mt-3 col-md-6 col-lg-4 p-0 text-center <?=(get_field('затемнять_картинку',$post) == 'Да') ? 'grayscale_me' : '' ?>">
				    	<div class="col-11 mx-auto p-0 d-flex flex-column align-items-center">
				    		<div class="image_block w-100">
				    			<?=wp_get_attachment_image(get_field('картинка_в_списке_каталога',$post)['ID'],'full');?>
				    			<?php 
				    				if( get_field('наличие',$post) == 'В наличии' ){ ?>
				    					<div class="image_badge green"><?=( $language == 'eng' ) ? "In stock" : "В наличии"?></div>
				    			<?php }?>
				    			<?php 
				    				if( get_field('наличие',$post) == 'Нет в наличии' ){ ?>
				    					<div class="image_badge red"><?=( $language == 'eng' ) ? "Out of stock" : "Нет в наличии"?></div>
				    			<?php }?>
				    		</div>
				    		<h6 class="mt-3"><?=( $language == 'eng' ) ? get_field('название_на_английском',$post) : $post->name?></h6>
				    		<span class="mt-2"><?=get_field('цена',$post);?></span>
				    		<a class="btn mt-3" href="/<?=$post->slug;?>/"><?=( $language == 'eng' ) ? "More details" : "Подробнее"?></a>
				    	</div>
				    </div>
				<?php }  ?>
    		</div>
    	</div>
    </section>
    <?php
		$third_section = get_field('третья_секция');
	?>
    <section id="third_section" class="mt-5">    	
    	<div class="section_banner d-flex align-items-center" style="background-image: url(<?=$third_section['общий_баннер']['url'];?>);">
    		<div class="container"><h4 class="text-center text-white"><?=( $language == 'eng' ) ? "About us" : "О компании"?></h4></div>
    	</div>
    	<div class="container">
    		<?php
    			foreach( $third_section['параметры_блока'] as $elem ){ ?>
    				<div class="row ms-0 me-0 mt-3">
		    			<?php
		    				if( $elem['изображение_слева'] == 1 ){ ?>
		    					<div class="col-12 col-md-5">
				    				<img src="<?=$elem['изображение']['url'];?>" alt="">
				    			</div>
				    			<div class="col-12 col-md-7">
				    				<?=( $language == 'eng' ) ? $elem['описание_на_английском'] : $elem['описание']?>
				    			</div>
		    				<?php
		    				}
		    				else{ ?>
				    			<div class="col-12 col-md-7">
                                    <?=( $language == 'eng' ) ? $elem['описание_на_английском'] : $elem['описание']?>
                                </div>
				    			<div class="col-12 col-md-5">
				    				<img src="<?=$elem['изображение']['url'];?>" alt="">
				    			</div>
		    				<?php }
		    			?>		    			
		    		</div>
    			<?php }
    		?>    		
    	</div>
    </section>
    <?php
    	$footer = wp_get_nav_menu_object(get_nav_menu_locations()['footer']);
		  $footer_data_about_us = get_field('о_компании', $footer);
		?>
		<section id="section_about" class="col-12 mt-5 mb-5">
		  <div class="container">
		    <div class="row ms-0 me-0">
		      <div class="col-12 col-md-7" style="border-right: 3px solid orange">
		          <h4 style="font-size: 16px;"><?=( $language == 'eng' ) ? $footer_data_about_us['заголовок_на_английском'] : $footer_data_about_us['заголовок'] ?></h4>
		          <?php
		            foreach ($footer_data_about_us['блоки'] as $data) { ?>
		              <div class="col-12">
		                <h5><?=( $language == 'eng' ) ? $data['заголовок_на_английском'] : $data['заголовок'] ?></h5>
		                <p><?=( $language == 'eng' ) ? $data['описание_на_английском'] : $data['описание'] ?></p> 
		              </div>
		           <?php }
		          ?>              
		      </div>          
		      <div class="col-12 col-md-5 mt-4 mt-md-0">
		        <?php
		            foreach ($footer_data_about_us['правый_блок'] as $data) { ?>
		              <div class="right_column col-12 d-flex flex-row ms-md-4 align-items-center">
		                <span><?=( $language == 'eng' ) ? $data['цифра_на_английском'] : $data['цифра'] ?></span>
		                <p><?=( $language == 'eng' ) ? $data['описание_на_английском'] : $data['описание'] ?></p> 
		              </div>
		           <?php }
		          ?>
		      </div>
		    </div>
		  </div>    
		</section>
    <div id="news_list" class="mt-3">
        <div class="section_banner d-flex align-items-center" style="background-image: url(<?=$third_section['общий_баннер']['url'];?>);">
            <div class="container"><h4 class="text-center text-white"><?=( $language == 'eng' ) ? "News" : "Новости" ?></h4></div>
        </div>
      <div class="container" style="max-width: 1200px;">
        <?php
            $news = get_posts( array(
              'numberposts' => 15,
              'orderby'     => 'date',
              'order'       => 'ASC',
              'post_type'   => 'news',
              'suppress_filters' => true,
            ) ); ?>
            <div class="owl-carousel owl-theme mt-5">
            <?php foreach( $news as $news_elem ){  setup_postdata($news_elem); ?>              
                <div class="news_slide">
                  <div class="news_slide_image">
                    <?=get_the_post_thumbnail($news_elem->ID,'full');?>
                  </div>
                  <div class="news_slide_content d-flex flex-column align-items-center">
                    <div class="news_list_data">
                    	<h6 class="text-center mt-3"><?=( $language == 'eng' ) ? get_field('название_на_английском',$news_elem->ID) : $news_elem->post_title ?></h6>
	                    <div class="news_slide_description">
	                      <p><?=get_the_excerpt($news_elem->ID);?></p>
	                    </div>
                    </div>                    
                    <a href="/news/<?=$news_elem->post_name?>" class="btn mt-3"><?=( $language == 'eng' ) ? "More details" : "Подробнее"?></a>
                  </div>
                </div>              
            <?php } wp_reset_postdata(); ?>
            </div>
      </div>
    </div>
    <script>
      $(document).ready(function(){
          const slider = $("#news_list .owl-carousel").owlCarousel({
              loop:true,
              margin:10,
              nav:false,
              dots:true,
              responsive:{
                  0:{
                      items:1
                  },
                  600:{
                      items:2
                  },
                  991:{
                      items:3
                  }
              }
          });
      });
    </script>
<?php
    get_footer();
?>