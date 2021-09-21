<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();



$description = get_the_archive_description();

$url_zapros = urldecode($_SERVER['REQUEST_URI']);
$categories = get_terms('katalog'); $news_list = get_terms('news');

$archive_object = get_queried_object();
if( explode('Архивы:',get_the_archive_title())[1] != '' ) $archive_object = get_terms('news')[0];
?>
<?php
	$language = 'rus';
	if (isset($_COOKIE["language"])) $language = $_COOKIE["language"];

?>
<?php query_posts($query_string . "&order=ASC&orderby=menu_order"); ?>
<?php if ( have_posts() ) : ?>

	<div id="catalog_page_template" class="bh">
		<?php
			$catalog_banner = get_field('баннер',$archive_object);
			$catalog_tags = get_field('набор_меток_товара',$archive_object );
			//$catalog_title = get_field('первая_секция')['левая_колонка']['загловок'];
		?>
		<div id="catalog_header" class="d-flex align-items-center" style="background-image: url(<?=$catalog_banner['url'];?>)">
			<div class="container">
				<h1 style="border:0;"><?php
						if ( $language == 'eng' ){
							echo get_field('название_на_английском',$archive_object);
						}
						else{
							if( explode('Архивы:',get_the_archive_title())[1] != '' ) {
								echo explode('Архивы:',get_the_archive_title())[1];
							}
							else{
								echo explode('Категория:',get_the_archive_title())[1];
							}
						}
					?> </h1>
				<div id="breadcrumbs"> <?php true_breadcrumbs(); ?> </div>
				<?php if( $archive_object->name != 'Новости' ){ ?>
					<p class="mt-3" style="color: white;"><?=( $language == 'eng' ) ? get_field('описание_в_баннере',$archive_object)['описание_на_английском'] : get_field('описание_в_баннере',$archive_object)['описание'] ?></p>
				<?php } ?>				
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
		<div id="categorie_posts">
			<div class="container">
				<div class="row ms-0 me-0">
					<?php while ( have_posts() ) : ?>
						<?php the_post(); $id = get_the_ID(); ?>
						<div class="wow fadeInUp catalog_item col-12 mt-3 col-md-6 col-lg-4 p-0 text-center <?=(get_field('затемнять_картинку') == 'Да') ? 'grayscale_me' : '' ?>">
					    	<div class="col-11 mx-auto p-0 d-flex flex-column align-items-center justify-content-between h-100">
					    		<div class="image_block">
					    			<?php echo get_the_post_thumbnail( get_the_ID(), 'full', array('class' => '') ); ?>

					    			<?php 
					    				if( get_field('наличие') == 'В наличии' ){ ?>
					    					<div class="image_badge green"><?=( $language == 'eng' ) ? "In stock" : "В наличии"?></div>
					    			<?php }?>
					    			<?php 
					    				if( get_field('наличие') == 'Нет в наличии' ){ ?>
					    					<div class="image_badge red"><?=( $language == 'eng' ) ? "Out of stock" : "Нет в наличии"?></div>
					    			<?php }?>
					    		</div>
					    		<div class="product_data w-100 d-flex flex-column align-items-center">
					    			<h6 class="mt-3"><?=( $language == 'eng' ) ? get_field('название_на_английском',$post) : get_the_title() ?></h6>
						    		<span class="mt-2"><?=get_field('цена');?></span>
						    		<?php
						    			$custom_url = '';
						    			if( explode('Архивы:',get_the_archive_title())[1] != '' ) {
											foreach( $news_list as $news ){ 
												$equal = true;
												$to_check1 = preg_split("//u", $url_zapros , -1, PREG_SPLIT_NO_EMPTY);
												$to_check2 = preg_split("//u",  '/'.urldecode($news->slug).'/' , -1, PREG_SPLIT_NO_EMPTY);				
												if( count( $to_check1 ) == count( $to_check2 ) ){
													for( $i = 0; $i < count( $to_check1 );$i++ ){
														if( $to_check1[$i] != $to_check2[$i] ){
															$equal = false;
															break;
														}
													}
												}		
												else $equal = false;
												if( $equal ){
													$custom_url = '/'.urldecode($news->slug).'/'.get_post_field( 'post_name', get_post() ).'/';
												}
											}
										}
										else{
											foreach( $categories as $categorie ){ 
												$equal = true;
												$to_check1 = preg_split("//u", $url_zapros , -1, PREG_SPLIT_NO_EMPTY);
												$to_check2 = preg_split("//u",  '/'.urldecode($categorie->slug).'/' , -1, PREG_SPLIT_NO_EMPTY);				
												if( count( $to_check1 ) == count( $to_check2 ) ){
													for( $i = 0; $i < count( $to_check1 );$i++ ){
														if( $to_check1[$i] != $to_check2[$i] ){
															$equal = false;
															break;
														}
													}
												}		
												else $equal = false;
												if( $equal ){
													$custom_url = '/'.urldecode($categorie->slug).'/'.get_post_field( 'post_name', get_post() ).'/';
												}
											}
										}										

						    		?>
						    		<a class="btn mt-3 w-100" href="<?=$custom_url;?>"><?=( $language == 'eng' ) ? "More details" : "Подробнее"?></a>
					    		</div>					    		
					    	</div>
					    </div>
					<?php endwhile; ?>
				</div>				
			</div>			
		</div>
		<div id="categorie_description" class="mt-5">
			<div class="container">
				<?=( $language == 'eng' ) ? get_field('описание_на_английском',$archive_object) : $description ?>
			</div>
		</div>
	</div>

<?php else : ?>
	<?php get_template_part( 'template-parts/content/content-none' ); ?>
<?php endif; ?>

<?php get_footer(); ?>
