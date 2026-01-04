<?php get_header(); ?>
	<main>
		<section class="error">
			<div class="container">
				<div class="error__container">
						<img src="<?= HEADGROUP_THEME_DIRECTORY ?>assets/images/error.png" alt="<?= __('На жаль, сторінку, яку ви шукаєте, не вдалося знайти. Можливо, вона більше не існує або її адреса була змінена.' , 'headgroup') ?>">
						<a href="<?= get_home_url(); ?>" class="btn"><?= __('на головну' , 'headgroup') ?></a>
						<p><?= __('На жаль, сторінку, яку ви шукаєте, не вдалося знайти. Можливо, вона більше не існує або її адреса була змінена.' , 'headgroup') ?></p>
				</div>
			</div>
		</section>
	</main>
<?php get_footer(); ?>