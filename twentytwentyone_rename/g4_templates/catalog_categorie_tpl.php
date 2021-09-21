<?php
    get_header();
?>	
	<div id="catalog_page_template">
		<?php
			$catalog_banner = get_field('баннер');
			$catalog_title = get_field('первая_секция')['левая_колонка']['загловок'];
		?>
		<div id="catalog_header" class="d-flex align-items-center" style="background-image: url(<?=$catalog_banner['url'];?>)">
			<div class="container">
				<h1><?=( $language == 'eng' ) ? get_field('название_на_английском') : get_the_title()?></h1>
				<div id="breadcrumbs"> <?php true_breadcrumbs(); ?> </div>
				<p class="mt-3">Весь представленный товар не содержит глютен и гипоаллергенен</p>
			</div>
		</div>
		<div id="fast_links" class="pt-4 pb-4">
			<div class="container">
				<div class="row ms-0 me-0">
					<div class="col-12"> <a class="btn bg-transparent" href="../#catalog">Вернуться в каталог →</a> </div>
				</div>
			</div>
		</div>
		<section id="catalog_second_section" class="bh mt-5">
			<div class="container">
				<div class="col-12 col-md-5 col-lg-4">
					<?php twenty_twenty_one_post_thumbnail(); ?>
				</div>
			</div>
		</section>
	</div>

<?php
    get_footer();
?>